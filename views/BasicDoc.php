<?php

	require_once "./views/HtmlDoc.php";
	
class BasicDoc extends HtmlDoc {
	protected $model;
	
	public function __construct($model) {
		$this -> model = $model;		
	}
	
	public function showTitle() {
		echo '<title>';
		$this->showPageHeader();
		echo '</title>';
	}
	
	public function showCssLinks() {
		echo '<link rel="stylesheet" href="./css/style.css">';
	}

	protected function showHeadContent() {
        $this->showTitle();
		$this->showCssLinks();
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
			echo '<a href="index.php?page=home">Home</a>';
		if (isset($_SESSION['user'])) {
			echo '<a href="index.php?page=Shop">Shop</a>';
			echo '<a href="index.php?page=mycart">My cart</a>';
			echo '<a href="index.php?page=orderhistory">Order history</a>';
			echo '<a href="index.php?page=logout">Logout</a>';
		} else {
			echo '<a href="index.php?page=login">Login</a>';
			echo '<a href="index.php?page=register">Register</a>';
		}
			echo '<a href="index.php?page=contact">Contact</a>';
			echo '<a class="special">The webshop where you can buy anything you want</a>';
			echo '</nav>';
	}
	//can make this nicer too by putting a full nav bar in both the if and else statements
	
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