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
		echo '<a href="index.php?page=browse_shop">Browse shop</a>';
		echo '<a href="index.php?page=login">Login</a>';
		echo '<a href="index.php?page=register">Register</a>';
		echo '<a href="index.php?page=contact">Contact</a>';
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