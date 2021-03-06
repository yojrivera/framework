<?php
/**
 * @author  Jorge Rivera <yo.jrivera@gmail.com>
 * @version  1.0 Primera versión estable
 * @package  framework
 * @copyright  2015
 * 
 * 
 * 
 * 
 *
*/
/**
 * clase Appcontroller para renderizar vistas y redireccionar
 * @param  string $_view atributo protegido de la clase
 * @param  string $db objeto de la clase PDO 
 */
abstract class Appcontroller
{
	protected $_view;
	protected $db;

	abstract public function index();

	public function __construct(){
		$this->_view = new View(new Request);
		$this->db = new classPDO();
	}

	/**
	 * redirect redireccion de archivos
	 * @param   array $url contiene parametros para redirección
	 * @var  string $path variable que almacena ruta completa de la redirección
	 * **/
	protected function redirect($url = array()){
		$path = "";

		if ($url['controller']) {
			$path .= $url['controller'];
		}
		if ($url['action']) {
			$path .= "/".$url['action'];
		}
		header("location: ".APP_URL.$path);

	}

}
