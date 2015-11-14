<?php

$application = __DIR__;
$modules = __DIR__.'/../kohana/modules';
$system = __DIR__.'/../kohana/system';

define('APPPATH', realpath($application).DIRECTORY_SEPARATOR); 
define('MODPATH', realpath($modules).DIRECTORY_SEPARATOR);
define('SYSPATH', realpath($system).DIRECTORY_SEPARATOR);
unset($application, $modules, $system);

require SYSPATH.'classes/Kohana.php';

date_default_timezone_set('Asia/Shanghai');
setlocale(LC_ALL,"chs");

spl_autoload_register(array('Kohana', 'auto_load'));
ini_set('unserialize_callback_func', 'spl_autoload_call');

//error_reporting(E_ALL ^ E_NOTICE ^ E_STRICT);
error_reporting(E_ALL | E_STRICT);
//ini_set('display_errors', TRUE);

Kohana::init(array(
	'base_url' => '/',
	'index_file' => false,
	'profile'    => true,
));

Kohana::modules(array(
	'database'   => MODPATH.'database',
	'helper'     => MODPATH.'helper',
	'image'      => MODPATH.'image',
	'imagefly'   => MODPATH.'imagefly',
	'captcha'    => MODPATH.'captcha',
	'admin'      => MODPATH.'admin',
	'devtools'   => MODPATH.'devtools',
	'logreader'  => MODPATH.'logreader',
	'myadmin'    => MODPATH.'myadmin',
	'media'      => MODPATH.'media',
));
Kohana::$log->attach(new Log_File(APPPATH.'logs'));

Route::set('default', '(<controller>(/<action>))')->defaults(array('controller' => 'home'));
Route::set('catch_all', '<path>', array('path' => '.+'))->defaults(array('controller' => 'Error','action' => '404'));

if (!defined('KOHANA_START_TIME')) {
    define('KOHANA_START_TIME', microtime(TRUE));
}

if (!defined('KOHANA_START_MEMORY')) {
    define('KOHANA_START_MEMORY', memory_get_usage());
}

echo Request::instance()->execute();
//try {echo Request::instance()->execute();} catch(Exception $e) {}
