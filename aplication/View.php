<?php
/**
 * clase View
 * 
 * clase que contiene los elementos necesarios para cargar las vistas
 * 
 * @author  Jorge Rivera <yo.jrivera@gmail.com>
 * @version  1.0 Primera versión estable
 * @package  framework
 * @copyright  2015
 * 
 */
class View
{
	private $_controlador;
	private $_metodo;

	public function __construct(Request $peticion){
		$this->_controlador = $peticion->getControlador();
		$this->_metodo = $peticion->getMetodo();
	}

	/**
	 * renderizar funcion que contiene los elementos de la vista
	 * @param  string $vista contiene nombre de la vista
	 * @return void
	 */
	public function renderizar($vista){
		$_layoutParams = array(
				'ruta_css'=> APP_URL.'views/layouts/'.DEFAULT_LAYOUT.'/css/',
				'ruta_img'=> APP_URL.'views/layouts/'.DEFAULT_LAYOUT.'/img/',
				'ruta_js'=> APP_URL.'views/layouts/'.DEFAULT_LAYOUT.'/js/'
			);

		$rutaView = ROOT.'views'.DS.$this->_controlador.DS.$vista.'.phtml';

		if ($this->_metodo=='login') {
			$layout = 'login';
		}else{
			$layout = DEFAULT_LAYOUT;
		}

		//comprobar que esta ruta pueda leerse y su codigo interno no tenga ningun error
		if(is_readable($rutaView)){
			include_once ROOT.'views'.DS.'layouts'.DS.$layout.DS.'header.php';
			include_once $rutaView;
			include_once ROOT.'views'.DS.'layouts'.DS.$layout.DS.'footer.php';
		}else{
			throw new Exception("Error de vista");
		}
	}
}