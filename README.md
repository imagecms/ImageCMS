# ImageCMS
Open source php CMS based on CodeIgniter

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/d1f4928d-7cce-4aad-937f-2aa5d91ebf14/mini.png)](https://insight.sensiolabs.com/projects/d1f4928d-7cce-4aad-937f-2aa5d91ebf14)
[![Code Climate](https://codeclimate.com/github/imagecms/ImageCMS/badges/gpa.svg)](https://codeclimate.com/github/imagecms/ImageCMS)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/imagecms/ImageCMS/badges/quality-score.png?b=development)](https://scrutinizer-ci.com/g/imagecms/ImageCMS/?branch=development)
[![Build Status](https://scrutinizer-ci.com/g/imagecms/ImageCMS/badges/build.png?b=development)](https://scrutinizer-ci.com/g/imagecms/ImageCMS/build-status/development)
[![Codacy Badge](https://api.codacy.com/project/badge/b309dceef5634272a6d6bdf65db28468)](https://www.codacy.com/app/info_26/ImageCMS)

##Installation
###Database
- create new database in phpmyadmin
- goto \application\modules\install
- import sqlPre or sqlPro into phpmyadmin
- make a copy of \application\config database.sample.php file and rename it to database.php
- write your database access config in this file

###Files
- Make a copy of uploads_site folder and rename it to “uploads”
- create empty folders:
  * /system/cache/
  * /captcha
  * /application/backups

###Composer packages
- open openserver terminal - http://prntscr.com/833pmi
- cd to project folder
- run “composer_update.bat”. Note: if you’ll see this http://prntscr.com/833tvj kind of message while installing just ignore it and push enter