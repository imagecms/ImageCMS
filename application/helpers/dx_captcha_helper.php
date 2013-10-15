<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2006, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */
// ------------------------------------------------------------------------

/*
  Instructions:

  Load the plugin using:

  $this->load->helper('captcha');

  Once loaded you can generate a captcha like this:

  $vals = array(
  'word'		 => 'Random word',
  'img_path'	 => './captcha/',
  'img_url'	 => 'http://www.your-site.com/captcha/',
  'font_path'	 => './system/texb.ttf',
  'img_width'	 => rand(500, 600),
  'img_height' => rand(80, 120),
  'expiration' => 7200
  );

  $cap = create_captcha($vals);
  echo $cap['image'];


  NOTES:

  The captcha function requires the GD image library.

  Only the img_path and img_url are required.

  If a "word" is not supplied, the function will generate a random
  ASCII string.  You might put together your own word library that
  you can draw randomly from.

  If you do not specify a path to a TRUE TYPE font, the native ugly GD
  font will be used.

  The "captcha" folder must be writable (666, or 777)

  The "expiration" (in seconds) signifies how long an image will
  remain in the captcha folder before it will be deleted.  The default
  is two hours.

  RETURNED DATA

  The create_captcha() function returns an associative array with this data:

  [array]
  (
  'image' => IMAGE TAG
  'time'	=> TIMESTAMP (in microtime)
  'word'	=> CAPTCHA WORD
  )

  The "image" is the actual image tag:
  <img src="http://your-site.com/captcha/12345.jpg" width="140" height="50" />

  The "time" is the micro timestamp used as the image name without the file
  extension.  It will be a number like this:  1139612155.3422

  The "word" is the word that appears in the captcha image, which if not
  supplied to the function, will be a random string.


  ADDING A DATABASE

  In order for the captcha function to prevent someone from posting, you will need
  to add the information returned from create_captcha() function to your database.
  Then, when the data from the form is submitted by the user you will need to verify
  that the data exists in the database and has not expired.

  Here is a table prototype:

  CREATE TABLE captcha (
  captcha_id bigint(13) unsigned NOT NULL auto_increment,
  captcha_time int(10) unsigned NOT NULL,
  ip_address varchar(16) default '0' NOT NULL,
  word varchar(20) NOT NULL,
  PRIMARY KEY (captcha_id),
  KEY (word)
  )


  Here is an example of usage with a DB.

  On the page where the captcha will be shown you'll have something like this:

  $this->load->helper('captcha');
  $vals = array(
  'img_path'	 => './captcha/',
  'img_url'	 => 'http://www.your-site.com/captcha/'
  );

  $cap = create_captcha($vals);

  $data = array(
  'captcha_id'	=> '',
  'captcha_time'	=> $cap['time'],
  'ip_address'	=> $this->input->ip_address(),
  'word'			=> $cap['word']
  );

  $query = $this->db->insert_string('captcha', $data);
  $this->db->query($query);

  echo 'Submit the word you see below:';
  echo $cap['image'];
  echo '<input type="text" name="captcha" value="" />';


  Then, on the page that accepts the submission you'll have something like this:

  // First, delete old captchas
  $expiration = time()-7200; // Two hour limit
  $DB->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);

  // Then see if a captcha exists:
  $sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND date > ?";
  $binds = array($_POST['captcha'], $this->input->ip_address(), $expiration);
  $query = $this->db->query($sql, $binds);
  $row = $query->row();

  if ($row->count == 0)
  {
  echo "You must submit the word that appears in the image";
  }

 */

/**
  |==========================================================
  | Create Captcha
  |==========================================================
  |
 */
if (!function_exists('create_captcha')) {

    function create_captcha($data = '', $img_path = '', $img_url = '', $font_path = '') {
        /**
         * Function to create a random color
         * Note: We aren't using this outside this function so we will sit it inside
         * @auteur mastercode.nl
         * @param $type string Mode for the color
         * @return int
         * */
        if (!function_exists('color')) {

            function color($type) {
                switch ($type) {
                    case "bg":
                        //$color = rand(224,255);
                        $color = 255;
                        break;
                    case "text":
                        $color = rand(0, 127);
                        break;
                    case "grid":
                        $color = rand(200, 224);
                        break;
                    default:
                        $color = rand(0, 255);
                        break;
                }
                return $color;
            }

        }

        $defaults = array('word' => '', 'img_path' => '', 'img_url' => '', 'img_width' => '150', 'img_height' => '30', 'font_size' => '', 'font_path' => '', 'show_grid' => true, 'skew' => true, 'expiration' => 7200);

        foreach ($defaults as $key => $val) {
            if (!is_array($data)) {
                if (!isset($$key) OR $$key == '') {
                    $$key = $val;
                }
            } else {
                $$key = (!isset($data[$key])) ? $val : $data[$key];
            }
        }

        if ($img_path == '' OR $img_url == '') {

            return FALSE;
        }

        if (!@is_dir($img_path)) {
            return FALSE;
        }

        if (!is_really_writable($img_path)) {
            return FALSE;
        }

        if (!extension_loaded('gd')) {
            return FALSE;
        }

        // -----------------------------------
        // Select random Font from folder
        // -----------------------------------

        if (is_dir($font_path)) {
            $handle = opendir($font_path);

            while (($file = @readdir($handle)) !== false) {
                if (!in_array($file, array('.', '..')) && substr($file, strlen($file) - 4, 4) == '.ttf') {
                    $fonts[] = $file;
                }
            }

            $font_file = $font_path . DIRECTORY_SEPARATOR . $fonts[array_rand($fonts)];
        } else {
            $font_file = $font_path;
        }

        // -----------------------------------
        // Remove old images
        // -----------------------------------

        list($usec, $sec) = explode(" ", microtime());
        $now = ((float) $usec + (float) $sec);

        $current_dir = @opendir($img_path);

        while ($filename = @readdir($current_dir)) {
            if ($filename != "." and $filename != ".." and $filename != "index.html") {
                $name = str_replace(".png", "", $filename);

                if (($name + $expiration) < $now) {
                    @unlink($img_path . $filename);
                }
            }
        }

        @closedir($current_dir);

        // -----------------------------------
        // Do we have a "word" yet?
        // -----------------------------------

        if ($word == '') {
            // No Zero (for user clarity);
            $pool = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

            $str = '';
            for ($i = 0; $i < 6; $i++) {
                $str .= substr($pool, mt_rand(0, strlen($pool) - 1), 1);
            }

            $word = strtoupper($str);
        }

        // -----------------------------------
        // Length of Word
        // -----------------------------------

        $length = strlen($word);

        // -----------------------------------
        // Create image
        // -----------------------------------

        $im = ImageCreateTruecolor($img_width, $img_height);

        // -----------------------------------
        //  Assign colors
        // -----------------------------------

        $bg_color = imagecolorallocatealpha($im, color('bg'), color('bg'), color('bg'), 0);
        $border_color = imagecolorallocate($im, 255, 255, 255);
        $text_color = imagecolorallocate($im, color('text'), color('text'), color('text'));
        $grid_color[] = imagecolorallocate($im, color('grid'), color('grid'), color('grid'));
        $grid_color[] = $grid_color[0] + 150;
        $grid_color[] = $grid_color[0] + 180;
        $grid_color[] = $grid_color[0] + 210;
        $shadow_color = imagecolorallocate($im, 255, 240, 240);

        // -----------------------------------
        //  Create the rectangle
        // -----------------------------------

        ImageFilledRectangle($im, 0, 0, $img_width, $img_height, $bg_color);

        if ($show_grid == TRUE) {
            // X grid
            $grid = rand(20, 25);
            for ($x = 0; $x < $img_width; $x += mt_rand($grid - 2, $grid + 2)) {
                $current_colour = $grid_color[array_rand($grid_color)];
                imagedashedline($im, mt_rand($x - 3, $x + 3), mt_rand(0, 4), mt_rand($x - 3, $x + 3), mt_rand($img_height - 5, $img_height), $current_colour);
            }

            // Y grid
            for ($y = 0; $y < $img_height; $y += mt_rand($grid - 2, $grid + 2)) {
                $current_colour = $grid_color[array_rand($grid_color)];
                imageline($im, mt_rand(0, 4), mt_rand($y - 3, $y), mt_rand($img_width - 5, $img_width), mt_rand($y - 3, $y), $current_colour);
            }
        }

        // -----------------------------------
        //  Write the text
        // -----------------------------------

        $use_font = ($font_file != '' AND file_exists($font_file) AND function_exists('imagettftext')) ? TRUE : FALSE;

        if ($use_font == FALSE) {
            $font_size = 5;
            $x = rand(2, $img_width / ($length / 3));
            // y isnt used here
        } else {
            // Make font proportional to the image size
            $font_size = !empty($font_size) ? $font_size : mt_rand(18, 25);
            $x = rand(4, $img_width - (($font_size + ($font_size >> 1)) * $length));
            // y isnt used here
        }

        for ($i = 0; $i < strlen($word); $i++) {
            if ($use_font == FALSE) {
                $y = rand(0, $img_height / 2);
                imagestring($im, $font_size, $x, $y, substr($word, $i, 1), $text_color);
                $x += ($font_size * 2);
            } else {
                $letter = substr($word, $i, 1);
                $less_rotate = array('c', 'N', 'U', 'Z', '7', '6', '9'); //letters that we don't want rotated too much...

                $angle = $skew == TRUE ? (in_array($letter, $less_rotate)) ? rand(-5, 5) : rand(-15, 15)  : 0;
                $y = $img_height / 2 + ($font_size >> 1) + ($skew == TRUE ? rand(-9, 9) : 0);
                $x += ($font_size >> 2);
                imagettftext($im, $font_size, $angle, $x, $y, $text_color, $font_file, $letter);
                $x += $font_size + ($font_size >> 2);
            }
        }


        // -----------------------------------
        //  Create the border
        // -----------------------------------

        imagerectangle($im, 0, 0, $img_width - 1, $img_height - 1, $border_color);

        // -----------------------------------
        //  Generate the image
        // -----------------------------------

        $img_name = $now . '.png';

        ImagePNG($im, $img_path . $img_name);

        $img = "<img src=\"$img_url$img_name\" width=\"$img_width\" height=\"$img_height\" style=\"border:0;\" alt=\" \" />";

        ImageDestroy($im);

        return array('word' => $word, 'time' => $now, 'image' => $img);
    }

}

