<?php

namespace xbanners\src\Managers;

use Propel\Runtime\Exception\PropelException;
use xbanners\models\BannerImageI18nQuery;
use xbanners\models\BannerImageQuery;
use xbanners\models\Base\Banners;
use CI;
use DirectoryIterator;
use Exception;
use MY_Controller;
use Propel\Runtime\ActiveQuery\Criteria;

/**
 * User: mark
 * Date: 19.03.15
 * Time: 15:46
 */
class ImagesManager
{

    /**
     * Path name for origins images folder without uploads path
     */
    const IMAGES_ORIGIN_DIR_PATH = '/uploads/images/bimages/';

    /**
     * Path name for origins images folder without uploads path
     */
    const IMAGES_TUNED_DIR_PATH = '/uploads/banners/tuned/';

    /**
     * Image file input name
     */
    const IMAGE_FILE_FIELD = 'file-image';

    /**
     * Image upload file allowed types
     */
    const IMAGES_UPLOAD_ALLOWED_TYPES = 'jpg|gif|png|jpeg';

    /**
     * Image file max size
     */
    const IMAGE_MAX_SIZE = '51200';

    /**
     * @var ImagesManager instance
     */
    private static $instance = NULL;

    private function __construct() {

    }

    /**
     * Get ImagesManager instance
     * @return ImagesManager instance
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Delete images if they not used
     * @deprecated
     */
    public function deleteNotExistingImages() {
        $images = BannerImageI18nQuery::create()->find();

        $imagesSrc = [];
        foreach ($images as $image) {
            $imagesSrc[$image->getSrc()] = $image;
        }

        foreach (new DirectoryIterator('.' . self::IMAGES_ORIGIN_DIR_PATH) as $imageFile) {
            if (!$imageFile->isDot() && $imageFile->isFile()) {
                if (!$imagesSrc[$imageFile->getFilename()]) {
                    $this->deleteImageFile('.' . self::IMAGES_ORIGIN_DIR_PATH . $imageFile->getFilename());
                }
            }
        }
    }

    /** Get tuned image path
     * @param string $image_name - banner image name
     * @return string
     */
    public function getImageOriginPath($image_name = NULL) {

        if ($image_name) {

            $path1 = ltrim(self::IMAGES_ORIGIN_DIR_PATH, '/') . $image_name;
            $fullPath1 = FCPATH . $path1;

            if (file_exists($fullPath1)) {
                return '/' . $path1;
            }

            $path2 = 'uploads/banners/origins/' . $image_name;
            $fullPath2 = FCPATH . $path2;
            if (file_exists($fullPath2)) {
                return '/' . $path2;
            }
            return $image_name ? self::IMAGES_ORIGIN_DIR_PATH . $image_name : NULL;
        }

    }

    /** Get origin image path
     * @param string $image_name - banner image name
     * @return string
     */
    public function getImageTunedPath($image_name = NULL) {
        return $image_name ? self::IMAGES_TUNED_DIR_PATH . $image_name : NULL;
    }

    /**
     * Delete image files: origin image and tuned image from uploads
     * @param int $imageId
     * @param null|string $locale
     * @return bool
     * @throws PropelException
     */
    public function delete($imageId, $locale = NULL) {
        if (!$imageId) {
            return FALSE;
        }

        $images = BannerImageQuery::create()
            ->_if($locale)
            ->joinWithI18n($locale)
            ->_endif()
            ->findPk($imageId);

        if (!$images) {
            return FALSE;
        }

        foreach ($images->getBannerImageI18ns() as $image) {
            $image_path = '.' . self::IMAGES_ORIGIN_DIR_PATH . $image->getSrc();
            $image->setSrc(NULL);
            $image->save();

            $this->deleteImageFile($image_path);
        }

        return TRUE;
    }

    /**
     * Delete image file
     * @param string $image_path - path to image file
     * @return bool
     */
    private function deleteImageFile($image_path) {
        if (file_exists($image_path) && is_file($image_path)) {
            chmod($image_path, 0777);
            return unlink($image_path);
        }
        return FALSE;
    }

    /**
     * @param string $path
     */
    protected function buildImagePath($path) {
        $buildPath = '';
        foreach (explode('/', $path) as $part) {
            if ($part != '') {
                $buildPath .= $part . '/';
                file_exists($buildPath) || mkdir($buildPath) && chmod($buildPath, 0777);
            }
        }
    }

    /**
     * Save image file
     * @param $imageId
     * @param $locale
     * @return string
     * @throws Exception
     */
    public function saveImage($imageId = NULL, $locale = NULL) {

        if (!file_exists(self::IMAGES_ORIGIN_DIR_PATH)) {
            $this->buildImagePath(self::IMAGES_ORIGIN_DIR_PATH);
        }

        $config['upload_path'] = rtrim(PUBPATH, '/') . self::IMAGES_ORIGIN_DIR_PATH;
        $config['allowed_types'] = self::IMAGES_UPLOAD_ALLOWED_TYPES;
        $config['max_size'] = self::IMAGE_MAX_SIZE;

        CI::$APP->load->library('upload', $config);

        if (!CI::$APP->upload->do_upload(self::IMAGE_FILE_FIELD)) {
            throw new Exception(strip_tags(CI::$APP->upload->display_errors()));
        } else {
            if ($imageId && $locale) {
                $this->delete($imageId, $locale);
            }

            $data = CI::$APP->upload->data();

            $imageFileName = time() . $data['file_ext'];
            $imageFilePath = $data['file_path'] . $imageFileName;
            chmod($data['full_path'], 0777);
            copy($data['full_path'], $imageFilePath);
            chmod($imageFilePath, 0777);
            unlink($data['full_path']);

            return $imageFileName;
        }
    }

    /**
     * Upload image
     * @throws \Exception
     */
    public function uploadImage() {
        $_POST['maximumSize'] = self::IMAGE_MAX_SIZE;

        if ($this->checkImageUploadErrors()) {
            try {
                $pictureCut = \PictureCut::createSingleton();

                if ($pictureCut->upload()) {
                    echo $pictureCut->toJson();
                } else {
                    echo $pictureCut->exceptionsToJson();
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }

    /**
     * Check on errors exists while upload file
     * @return bool
     */
    private function checkImageUploadErrors() {
        $file = $_FILES[self::IMAGE_FILE_FIELD];
        $fileSize = round($file['size'] / 1024);

        if (!strstr($file['type'], self::IMAGES_UPLOAD_ALLOWED_TYPES)) {
            $error_message = lang('You can upload only images', 'xbanners');
        }

        if ($fileSize > self::IMAGE_MAX_SIZE) {
            $error_message = lang('You can not upload file with size more than:', 'xbanners') . ' ' . self::IMAGE_MAX_SIZE . 'KB';
        }

        if ($error_message) {
            echo json_encode(
                [
                 'status'       => false,
                 'errorMessage' => $error_message,
                ]
            );

            return FALSE;
        }

        return TRUE;
    }

    /**
     * Get images ordered by page types
     * @param Banners $banner - banner object
     * @param string $locale - locale name
     * @return array
     */
    public function getImagesByPageType($banner, $locale) {
        $pages = BannerPageTypesManager::getInstance()->getPages($banner->getPageType(), $locale);

        $orderCriteria = new Criteria();
        $orderCriteria->addDescendingOrderByColumn('Position');

        $images = $banner->getBannerImages($orderCriteria);

        if ($pages === null && count($images)) {
            $pagesGroupName = lang('Images', 'xbanners');
            $resultImages[$pagesGroupName]['images'] = [];

            foreach ($images as $image) {
                $image->setLocale($locale);
                if ($image->getActive()) {
                    $resultImages[$pagesGroupName]['images'][] = $image;
                }
            }

            foreach ($images as $image) {
                $image->setLocale($locale);
                if (!$image->getActive()) {
                    array_push($resultImages[$pagesGroupName]['images'], $image);
                }
            }
            return $resultImages;
        }

        $resultImages = [];
        foreach ($images as $image) {
            $image->setLocale($locale);
            $imagePage = $pages[$image->getAllowedPage()];
            $pagesGroupName = $imagePage['name'] ? $imagePage['name'] : lang('Images without relation', 'xbanners');
            $resultImages[$pagesGroupName]['images'] = $resultImages[$pagesGroupName]['images'] ? $resultImages[$pagesGroupName]['images'] : [];

            if ($image->getActive()) {
                $resultImages[$pagesGroupName]['images'][] = $image;
            }
        }

        foreach ($images as $image) {
            $image->setLocale($locale);
            $imagePage = $pages[$image->getAllowedPage()];
            $pagesGroupName = $imagePage['name'] ? $imagePage['name'] : lang('Images without relation', 'xbanners');

            if (!$image->getActive()) {
                array_push($resultImages[$pagesGroupName]['images'], $image);
            }
        }

        return $resultImages;
    }

    /**
     * Prepare banner image data for save into DB
     * @param array $data - image data array
     * @param $bannerId - banner id
     * @param $locale - locale name
     * @return array
     */
    public function prepareImageData(array $data, $bannerId, $locale) {
        $host = CI::$APP->input->server('HTTP_HOST');

        $data['url'] = (false === strpos($data['url'], $host)) ? $data['url'] : preg_replace("/^(https?:\/\/)?$host\/?/i", '/', $data['url']);
        $data['url'] = strstr($data['url'], 'http') || $data['url'][0] === '/' ? $data['url'] : '' . $data['url'];

        $data['allowed_page'] = !$data['allowed_page_all'] && $data['allowed_page'] ? (int) $data['allowed_page'] : 0;
        $data['target'] = $data['target'] ? 1 : 0;
        $data['permanent'] = $data['permanent'] ? 1 : 0;
        $data['active'] = isset($data['active']) ? 1 : 0;
        $data['active_from'] = $data['active_from'] && !$data['permanent'] ? strtotime($data['active_from']) : NULL;
        //        $data['active_from'] = $data['active_to'] && !$data['active_from'] ? time() : $data['active_from'];
        $data['active_to'] = $data['active_to'] && !$data['permanent'] ? strtotime($data['active_to']) : NULL;

        if (($data['active_from'] > $data['active_to'] && ($data['active_from'] && $data['active_to']))
            || ((time() > $data['active_to']) && $data['active_to'])
        ) {
            $data['active'] = 0;
        }
        $data['banner_id'] = $bannerId;
        $data['locale'] = $locale ? $locale : MY_Controller::defaultLocale();
        $data['src'] = $data['src'] ? $data['src'] : NULL;
        $data['clicks'] = $data['clicks'] ? (int) $data['clicks'] : 0;

        return $data;
    }

    /**
     * Make inactive banner images that has time out active_to date
     */
    public function setInactiveOnTimeOut() {
        return BannerImageQuery::create()
            ->filterByActive(1)
            ->where('BannerImage.ActiveTo < ?', time())
            ->update(['Active' => 0]);
    }

}