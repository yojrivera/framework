<?php
/**
 * clase usuariosController
 * 
 * controlador de usuarios
 * 
 * @author  Jorge Rivera <yo.jrivera@gmail.com>
 * @version  1.0 Primera versión estable
 * @package  framework
 * @copyright  2015
 * 
 */
class usuariosController extends Appcontroller
{
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->_view->usuarios = 'Listado de usuarios';
		$this->_view->usuarios = $this->db->find('usuarios', 'all');
		$this->_view->renderizar('index');

	}

	/**
	 * add funcion para agregar usuarios
	 * @return  void
	 */
	public function add(){

		if ($_POST){
			$pass = new Password();

			$_POST['password'] = $pass->getPassword($_POST['password']);

			if ($this->db->save("usuarios", $_POST)) {
				$this->redirect(array('controller'=>'usuarios', 'action'=>'index'));
			}else{
				$this->redirect(array('controller'=>'usuarios', 'action'=>'add'));
			}
		}else{
			$this->_view->titulo = "Agregar usuario";
			$this->_view->renderizar('add');
		}

		
	}

	/**
	 * edit funcion para editar usuario
	 * @param  string $id contiene id de la fila
	 * @return void
	 */
	public function edit($id = null){
		if ($_POST){
			if (!empty($_POST['pass'])) {
				$pass = new Password();
				$_POST['password'] = $pass->getPassword($_POST['pass']);;
			}
			if ($this->db->update("usuarios", $_POST)) {
				$this->redirect(array('controller'=>'usuarios', 'action'=>'index'));
			}else{
				$this->redirect(array('controller'=>'usuarios', 'action'=>'edit'));
			}
		}else{
			$this->_view->titulo = "Editar usuario";
			$this->_view->usuario = $this->db->find('usuarios', 'first', array('conditions'=>'id='.$id));
			$this->_view->renderizar('edit');
		}	
		
	}


	/**
	 * delete funcion para eliminar usuarios
	 * @param  string $id contiene el id de la fila
	 * @return void
	 */
	public function delete($id){
		$conditions = "id=".$id;
		if ($this->db->delete('usuarios', $conditions)) {
			$this->redirect(array('controller'=>'usuarios'));
		}
		
	}

	/**
	 * login funcion para login de usuario
	 * @return void
	 */
	public function login(){
		if ($_POST) {
			$pass = new Password();
			$filter = new Validations();
			$auth = new Authorization();

			$username = $filter->sanitizeText($_POST['username']);
			$password = $filter->sanitizeText($_POST['password']);

			$options = array('conditions' => "username = '$username'");
			$usuario = $this->db->find('usuarios', 'first', $options);

			if ($pass->isValid($password, $usuario['password'])) {
				$auth->login($usuario);
				$this->redirect(array('controller' =>'tareas'));
			}else{
				echo "Usuario no valido";
			}
		}
		$this->_view->renderizar('login');
	}

	/**
	 * logout funcion para cerrar sesión
	 * @return void
	 */
	public function logout(){
		$auth = new Authorization();
		$auth->logout();
	}


}