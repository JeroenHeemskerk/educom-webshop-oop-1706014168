<?php

require_once "./models/PageModel.php";

class pageController { //assumption: are not in the hierarchy of inheritance, so all functions public
	private $model;
	
	public function __construct() {
		$this->model = new PageModel(NULL);
	}
	
	public function handleRequest() {
		$this->getRequest();
		$this->processRequest();
		$this->showResponse();
	}
	
	private function getRequest() {
		$this->model->getRequestedPage();
	}
	
	//Business flow code
	
	private function processRequest() {
		switch($this->model->page) {
			case "login";
				include_once "./models/UserModel.php";
				$this->model = new UserModel ($this->model);
				$this->model->validateLogin();
				if($this->model->valid) {
					$this->model->doLoginUser();
					$this->model->setPage("home");
				}
				break;
			case "register";
				include_once "./models/UserModel.php";
				$this->model = new UserModel ($this->model);
				$this->model->validateRegistration();
				if($this->model->valid) {
					$this->model->saveUser();
					$this->model->setPage("login");
				}
				break;
			case "contact";
				include_once "./models/UserModel.php";
				$this->model = new UserModel($this->model);
				$this->model->validateMessage(); //non-existent and unnecessary
				if($this->model->valid) {
					$this->model->saveMessage();
					$this->model->setPage("contact");
				}
				break;
		}
	}
	
	//to presentation layer
	
	private function showResponse() {
		$this->model->createMenu();
		
		var_dump($this->model->page);
		switch($this->model->page) {
			case "home":
				require_once("views/homeDoc.php");
				$page = new HomeDoc($this->model);
				break;
			case 'browse_shop':
				include_once "./views/WebshopDoc.php";
                $page = new WebshopDoc($this->model);
                break;
            case 'login':
				include_once "./views/LoginForm.php";
                $page = new LoginForm($this->model);
                break;
            case 'register':
				include_once "./views/RegistrationForm.php";
                $page = new RegistrationForm($this->model);
                break;
			case 'contact':
				include_once "./views/ContactForm.php";
                $page = new ContactForm($this->model);
                break;
            default:
				include_once "./views/BasicDoc.php"; //should be error/404 page
                $page = new BasicDoc($this->model);
                break;	
		}
		$page->show();
	}
}


?>