<?php

require_once "./models/PageModel.php";
require_once "./models/ModelFactory.php";
require_once "./models/CrudFactory.php";

class pageController { //assumption: are not in the hierarchy of inheritance, so all functions public
	private $modelFactory; //to store modelFactory instance
	private $model;
	private $crudFactory;
	private $userCrud;

	private $sessionManager; //why does it also work without a sessionmanager property defined
	
	public function __construct(ModelFactory $modelFactory, CrudFactory $crudFactory) {
		$this->modelFactory = $modelFactory;
		$this->model = $this->modelFactory->createModel(null, 'PageModel');
		$this->crudFactory = $crudFactory;
		$this->userCrud = $this->crudFactory->createCrud('user');
	}
	
	public function handleRequest() {
		$this->accessSessionManager();
		$this->getRequest();
		$this->processRequest();
		$this->showResponse();
	}

	private function accessSessionManager() {
		$this->sessionManager = $this->model->getSessionManager();
	}
	
	private function getRequest() {
		$this->model->getRequestedPage();
	}
	
	//Business flow code
	
	//refactor so that creation Usermodel goes through ModelFactory

	private function processRequest() {
		switch($this->model->page) {
			case "login":
			    $this->model = $this->modelFactory->createModel($this->model, 'UserModel');
				$this->model->validateLogin();
				if($this->model->valid) {
					$this->model->doLoginUser();
					$this->model->setPage("home");
					$_SESSION['user_id'] = $this->model->getUserId();
				}
				break;
			case "logout":
				$this->model = $this->modelFactory->createModel($this->model, 'UserModel');
				$this->handleLogout();
				$this->model->setPage("home");
				break;
			case "register":
				$this->model = $this->modelFactory->createModel($this->model, 'UserModel');
				$this->model->validateRegistration();
				if($this->model->valid) {
					$this->model->saveUser();
					$this->model->setPage("login");
				}
				break;
			case "contact":
				$this->model = $this->modelFactory->createModel($this->model, 'UserModel');
				$this->model->validateMessage(); //unnecessary
				if($this->model->valid) {
					//$this->model->saveMessage(); //non-existent and unnecessary. Unless it will still be created
					$this->model->setPage("contact");
				}
				break;
			case "Shop":
				//to handle form submissions:
					if (isset($_POST['addToCart'])) {
						echo "it is working";
						$itemId = $_POST['addToCart'];
						$amount = $_POST['amount'][$itemId];
						$this->handleAddToCart($itemId, $amount);
					}
				include_once "./models/ShopModel.php";
				$this->model = new ShopModel($this->model);
				$this->model->prepareWebshopData();
				$this->model->prepareOrderData();
				break;
			case "mycart":
				include_once "./models/ShopModel.php";
				$this->model = new ShopModel($this->model);
				$this->model->prepareWebshopData();

				if (isset($_POST['placeOrder'])) {
					$this->handlePlaceOrder();
				}
				if (isset($_POST['clearCart'])) { //this button does not work
					$this->handleClearCart();
				}
				break;
			case "orderhistory":
				include_once "./models/ShopModel.php";
				$this->model = new ShopModel($this->model);
				$this->model->prepareOrderData();
				break;
		}
	}

	private function handleAddToCart($itemId, $amount) {
		$userId = $_SESSION['user_id'];
		include_once "./models/ShopModel.php";
		$this->model = new ShopModel($this->model);
		$itemDetails = $this->model->cartSpecificItemDetails($itemId);
		$this->model->addToCart($_SESSION['user_id'], $itemId, $amount, $itemDetails); //Implement addToCart method in ShopModel
	}

	private function handlePlaceOrder() {
		$userId = $_SESSION['user_id'];
		include_once "./models/ShopModel.php";
		$this->model = new ShopModel($this->model);
		$this->model->placeOrder($_SESSION['user_id'], $_SESSION['user']); // Implement placeOrder method in ShopModel
	}

	private function handleClearCart() {
			$this->sessionManager->clearCart();
	}

	private function handleLogout() {
			$this->sessionManager->logoutUser();
	}
	
	//to presentation layer

	
	
	private function showResponse() {
		$this->model->createMenu();
	
		switch($this->model->page) {
			case "home":
				require_once("views/homeDoc.php");
				$page = new HomeDoc($this->model);
				break;
			case 'Shop':
				include_once "./views/WebshopDoc.php";
                $page = new WebshopDoc($this->model);
                break;
			case 'mycart':
				include_once "./views/ShoppingCartDoc.php";
				$page = new ShoppingCartDoc($this->model);
				break;
			case 'orderhistory':
				include_once "./views/OrderhistoryDoc.php";
				$page = new OrderhistoryDoc($this->model);
				break;
            case 'login':
				include_once "./views/LoginForm.php";
                $page = new LoginForm($this->model);
                break;
			case 'logout':
				include_once "./views/LogoutForm.php";
				$page = new LogoutForm($this->model);
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