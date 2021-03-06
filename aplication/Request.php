<?php
/**
 * clase Request
 * 
 * clase para sanear url y definir controlador y metodos a ejecutar
 * 
 * @author  Jorge Rivera <yo.jrivera@gmail.com>
 * @version  1.0 Primera versión estable
 * @package  framework
 * @copyright  2015
 * 
 */

class Request{
	private $_controlador;
	private $_metodo;
	private $_argumentos;

	public function __construct(){
		if (isset($_GET['url'])) {
			$url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
			$url = explode('/', $url);
			$url = array_filter($url);

			$this->_controlador = strtolower(array_shift($url));
			$this->_metodo = strtolower(array_shift($url));
			$this->_argumentos = $url;
		}

		if (!$this->_controlador) {
			$this->_controlador = DEFAULT_CONTROLLER;
		}

		if (!$this->_metodo) {
			$this->_metodo = 'index';
		}

		if (!$this->_argumentos) {
			$this->_argumentos = array();
		}

	}

	/**
	 * getControlador define controlador
	 * @return objeto _controlador contiene el controlador a invocar 
	 */
	public function getControlador(){
		return $this->_controlador;
	}

	/**
	 * getMetodo define el metodo
	 * @return objeto _metodo contiene el metodo a invocar
	 */
	public function getMetodo(){
		return $this->_metodo;
	}

	/**
	 * getArgs define los argumentos
	 * @return  _argumentos contiene los argumentos a invocar
	 */
	public function getArgs(){
		return $this->_argumentos;
	}


}
