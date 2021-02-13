<?php
$dbms = 'phpbb\\db\\driver\\mysqli';
$dbhost = '10.137.0.254';
$dbport = '3306';
$dbname = 'phpbb';
$dbuser = 'phpbb';
$dbpasswd = file_get_contents("/secrets/dbpassword.secret");
$table_prefix = 'phpbb_';
$phpbb_adm_relative_path = 'adm/';
$acm_type = 'phpbb\\cache\\driver\\file';

@define('PHPBB_INSTALLED', true);
@define('PHPBB_DISPLAY_LOAD_TIME', true);
@define('PHPBB_ENVIRONMENT', 'production');
// @define('DEBUG_CONTAINER', true);
