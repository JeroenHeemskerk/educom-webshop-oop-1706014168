<?php

	require_once "../views/HtmlDoc.php";

class BasicDoc extends HtmlDoc {
	//protected properties here
	protected $data;
	
	public function __construct($myData) {
		$this -> data = $myData;		
	}
	
	public function showTitle() {
		echo '<title>';
		$this->showPageHeader();
		echo '</title>';
	}
	
	public function showCssLinks() {
		echo '<link rel="stylesheet" href="../css/style.css">';
	}

	protected function showHeadContent() {
        $this->showTitle();
		$this->showCssLinks();
    }
	
	public function showResponsePage($data) {
        switch ($data) {
            case 'Home':
                $page = new HomeDoc($this->data);
                break;
            case 'Browse shop':
                $page = new WebshopDoc($this->data);
                break;
            case 'Login':
                $page = new LoginDoc($this->data);
                break;
            case 'Register':
                $page = new RegisterDoc($this->data);
                break;
			case 'Contact':
                $page = new ContactForm($this->data);
                break;
            default:
                $page = new BasicDoc($this->data);
                break;
        }

        $page->show(); //call show() method to show page
    }

	
	// Override van de functie in HtmlDoc
	protected function showBodyContent() {
		$this->showHeader();
		$this->showMenu();
		$this->showContent();
		$this->showFooter();
	}
	
	private function showHeader() {
		echo '<header><h1>';
		$this->showPageHeader();
		echo '</h1></header>';
	}

	protected function showPageHeader() {
		echo "Basic pagina";
	}
	
	private function showMenu() {
		echo '<nav>';
		echo '<a href="../tests/test_home_doc.php">Home</a>';
		echo '<a href="index.php?page=WebshopDoc">Browse shop</a>';
		echo '<a href="../tests/test_login_form.php">Login</a>';
		echo '<a href="../tests/test_registration_form.php">Register</a>';
		echo '<a href="../tests/test_contact_form.php">Contact</a>';
		echo '<a class="special">The webshop where you can buy anything you want</a>';
		echo '</nav>';
	}
	
	protected function showContent() {
		echo "inhoud van de basic pagina";
	}
	
	private function showFooter() {
		echo '<footer>
           &copy; Patrick Lubbers
		</footer>';
	}
	
	
}

//die overerft van de HtmlDoc en de gemeenschappelijke zaken
//neerzet zoals header, menu en footer.

?>