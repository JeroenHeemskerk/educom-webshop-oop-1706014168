<?php

	require_once "../views/HtmlDoc.php";

class BasicDoc extends HtmlDoc {
	//protected properties here
	
	public function __construct($myData) {
		$this -> data = $myData;
		showTitle();
		showCssLinks();
		showBodyContent();
		showHeader();
		showMenu();
		showContent();
		showFooter();
	}
	
	public function showTitle() {
		echo '<title>Webshop</title>';
	}
	
	public function showCssLinks() {
		
	}
	
	public function showBodyContent() {
		$this->showHeader();
		$this->showMenu();
		$this->showContent();
		$this->showFooter();
	}
	
	public function showHeader() {
		
	}
	
	public function showMenu() {
		
	}
	
	public function showContent() {
		
	}
	
	public function showFooter() {
		
	}
	
	
}

//die overerft van de HtmlDoc en de gemeenschappelijke zaken
//neerzet zoals header, menu en footer.

?>