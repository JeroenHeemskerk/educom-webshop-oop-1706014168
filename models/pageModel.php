<?php

//require_once "..views/pageController.php";
include_once "datalayer.php";
require_once "SessionManager.php";

class PageModel {
	public $page;
	protected $isPost = false;
	public $menu;
	public $errors = array();
	public $genericErr = "";
	protected $sessionManager;
	protected $connection;
	
	public function __construct($copy) {
		if (empty($copy)) {
			// first instance pagemodel
			$this->sessionManager = new SessionManager();
			$this->connection = connect_to_database();
		} else {
			//Called from constructor of extender class
			$this->page = $copy->page;
			$this->isPost = $copy->isPost;
			$this->menu = $copy->menu;
			$this->genericErr = $copy->genericErr;
			$this->sessionManager = $copy->sessionManager;
			$this->connection = $copy->connection;
		}
	}
	
	public function getRequestedPage() {
		$this->isPost = ($_SERVER['REQUEST_METHOD'] == 'POST');
		
		if ($this->isPost) {
			$this->setPage($this->getPostVar("page", "home")); //static method
		} else {
			$this->setPage($this->getUrlVar("page","home"));
		}
		$this->createMenu();
	}
	
	public function setPage($newPage) { //it only seems to work when public
		$this->page = $newPage;
	}
	
	protected function getUrlVar($key, $default = "") {
		return isset($_GET[$key]) ? $_GET[$key] : $default; 
	}
	
	protected function getPostVar($key, $default = "") {
		return isset($_POST[$key]) ? $_POST[$key] : $default; 
	}
	
	public function createMenu() {
		/*$this->menu['home'] = new MenuItem('home', 'HOME');
		
		//insert code here
		
		if ($this->sessionManager->isUserLoggedIn()) {
			$this-> menu['logout'] = new MenuItem('logout', 'LOGOUT');
				$this->sessionManager->getLoggedInUser()['name'];
		}
		*/
	}
}

//this class interacts with $_SESSIONS etc..

?>