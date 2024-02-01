<?php

require_once "./models/PageModel.php";

class pageController { //assumption: are not in the hierarchy of inheritance, so all functions public
	private $model;
	private $db;
	
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
		var_dump($_SESSION['user_id']);
		var_dump($_SESSION['cart']);
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
					$this->userId = $this->model->getUserId();
					$_SESSION['user_id'] = $this->userId;
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
			case "browse_shop";
				//to handle form submissions:
				if ($_SERVER["REQUEST_METHOD"] === "POST") {
					if (isset($_POST['addToCart'])) {
						echo "it is working";
						$itemId = $_POST['addToCart'];
						$amount = $_POST['amount'][$itemId];
						$this->handleAddToCart($itemId, $amount);
					}

					if (isset($_POST['placeOrder'])) {
						$this->handlePlaceOrder();
					}
					if (isset($_POST['clearCart'])) { //this button does not work
						$this->handleClearCart();
					}
				}

				include_once "./models/ShopModel.php";
				$this->model = new ShopModel($this->model);
				$this->model->prepareWebshopData();
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
		echo "Clear Cart function called.";
    if (isset($_SESSION['cart'])) {
        //Clear the cart session
        unset($_SESSION['cart']);
        echo "Cart cleared successfully!";
    } else {
        echo "Your cart is already empty.";
    }
}
	
	//to presentation layer
	
	private function showResponse() { //change this so that when if(!empty($_SESSION['user'])) - it doesnt show login/register but logout/cart
		$this->model->createMenu();
	
		switch($this->model->page) {
			case "home":
				require_once("views/homeDoc.php");
				$page = new HomeDoc($this->model);
				break;
			case 'browse_shop':
				include_once "./views/WebshopDoc.php";
                $page = new WebshopDoc($this->model);
                break;
			case 'cart':
				include_once  "./views/ShoppingCartDoc.php";
				$page = new ShoppingCartDoc($this->model);

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