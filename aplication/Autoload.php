<?php
/**
 * @author  Jorge Rivera <yo.jrivera@gmail.com>
 * @version  1.0 Primera versión estable
 * @package  framework
 * @copyright  2015
 * 
 * 
 * __autoload Metodo para cargar automaticamente las librerias contenidas en libs
 * 
 * */

	/**
	 * __autoload Metodo para cargar automaticamente las librerias contenidas en libs
	 * @param  string $name contiene nombre de la libreria
	 * @return  void
	 */
	function __autoload($name){
		require_once(ROOT."libs".DS.$name.".php");
	}
?>