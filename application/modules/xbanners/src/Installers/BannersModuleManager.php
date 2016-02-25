<?php

namespace xbanners\src\Installers;

/**
 * @author Crayd
 */
final class BannersModuleManager
{

    /**
     * @var string
     */
    protected $sqlFile;

    /**
     * @var string
     */
    protected $sqlContent;

    /**
     * @var \CI_DB_active_record
     */
    protected $db;

    /**
     * @var name of module folder
     * used in self::setAutoload()
     */
    protected $moduleName = 'xbanners';

    /**
     * @var string
     */
    protected $bannerImagesFolder;

    /**
     * @var string
     */
    protected $currentTemplate;

    /**
     * Regular expression for selecting all CREATE queries from sql string
     */
    const DROP_PATTERN = '/DROP TABLE IF EXISTS \`[0-9a-z\_]+\`\;/i';

    /**
     * Regular expression for selecting all DROP queries from sql string
     */
    const CREATE_EXPRESSION = '/CREATE TABLE \`[0-9a-z\_]+\`[\s\S]+?\;/i';

    public function __construct() {
        $this->db = \CI::$APP->db;
        $this->sqlFile = realpath(__DIR__ . '/../../models/Shop.sql');
        $this->bannerImagesFolder = UPLOADSPATH . 'images/bimages';
        //        $this->bannerImagesFolder = UPLOADSPATH . 'banners/origins';
        $this->sqlContent = $this->getSqlFile();
    }

    /**
     * Create all tebles used in module
     *
     * @return boolean
     */
    public function install() {
        $this->deinstall();
        $this->setEnabled(TRUE);
        $this->makeBannersDirectory();
        return $this->executeQueries($this->getCreateQueries()) && $this->setAutoload(TRUE);
    }

    /**
     * Drop all tebles used in module
     *
     * @return boolean
     */
    public function deinstall() {
        $this->removeBannersDirectory();
        return $this->executeQueries($this->getDropQueries());
    }

    /**
     * @param boolean $bool
     */
    public function setAutoload($bool) {
        $state = $bool ? 1 : 0;

        return $this->db
            ->where(['name' => $this->moduleName])
            ->update('components', ['autoload' => $state]);
    }

    /**
     * @param boolean $bool
     */
    public function setEnabled($bool) {
        $state = $bool ? 1 : 0;

        return $this->db
            ->where(['name' => $this->moduleName])
            ->update('components', ['enabled' => $state]);
    }

    /**
     * Drop module row from components
     *
     * @return boolean
     */
    public function dropModuleFromComponents() {
        return $this->db->delete('components', ['name' => $this->moduleName]);
    }

    /**
     * Write places from "template_places.php" to db
     */
    public function installTemplatePlaces() {
        (new TemplatePlacesInstaller)->install();
    }

    public function updateTemplatePlaces() {
        (new TemplatePlacesInstaller)->update();
    }

    /**
     * @return boolean
     */
    protected function makeBannersDirectory() {
        mkdir(dirname($this->bannerImagesFolder), 0777, true);
        chmod(dirname($this->bannerImagesFolder), 0777);

        return mkdir($this->bannerImagesFolder, 0777, true) &&
                chmod($this->bannerImagesFolder, 0777);
    }

    protected function removeBannersDirectory() {
        return rmdir($this->bannerImagesFolder);
    }

    /**
     * Get content of sql file
     *
     * @return string
     */
    protected function getSqlFile() {

        return file_get_contents($this->sqlFile);
    }

    /**
     * Run self::getQueries() with DROP_PATTERN
     *
     * @return array
     */
    protected function getDropQueries() {

        return array_reverse($this->getQueries(self::DROP_PATTERN));
    }

    /**
     * Run self::getQueries() with CREATE_EXPRESSION
     *
     * @return array
     */
    protected function getCreateQueries() {

        return $this->getQueries(self::CREATE_EXPRESSION);
    }

    /**
     * Search all queries by passed pattern
     *
     * @param string $pattern
     * @return boolean|array
     */
    protected function getQueries($pattern) {
        $matches = [];
        if (preg_match_all($pattern, $this->sqlContent, $matches)) {

            return $matches[0];
        }

        return FALSE;
    }

    /**
     * Execute array of queries (DROP OR CREATE)
     *
     * @param array $queries
     * @return bool Returns true only if all queries are successfull
     * @throws \Exception
     */
    protected function executeQueries(array $queries) {
        $allQueriesResult = true;
        foreach ($queries as $query) {
            $currentResult = $this->db->query($query);
            $allQueriesResult = $allQueriesResult && $currentResult;
            if (($error = $this->db->_error_message())) {
                throw new \Exception($error);
            }
        }

        return $allQueriesResult;
    }

}