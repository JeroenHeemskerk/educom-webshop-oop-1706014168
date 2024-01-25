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
		echo '<ul>';
		echo '<li><a href="index.php?page=home">Home</a></li>';
		echo '<li><a href="index.php?page=contact">Contact</a></li>';
		echo '<li><a href="index.php?page=shopping">Shop</a></li>';
		echo '<li><a href="index.php?page=login">Login</a></li>';
		echo '<li><a href="index.php?page=register">Register</a></li>';
		echo '</ul>';
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