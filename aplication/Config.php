<?php
/**
 * @author  Jorge Rivera <yo.jrivera@gmail.com>
 * @version  1.0 Primera versión estable
 * @package  framework
 * @copyright  2015
 * 
 * Config.php archivo para definir controlador y metodo por default y ruta de la aplicacion
 * */

define('DEFAULT_CONTROLLER', 'tareas');
define('DEFAULT_LAYOUT', 'default');

define('APP_FOLDER', 'framework');
define('APP_URL', 'http://'.$_SERVER['SERVER_NAME'].'/'.APP_FOLDER.'/');
