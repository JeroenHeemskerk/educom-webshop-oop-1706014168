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
	
	protected function showBodyContent() {
		$this->showHeader();
		$this->showMenu();
		$this->showContent();
		$this->showFooter();
	}
	
	
}

//die overerft van de HtmlDoc en de gemeenschappelijke zaken
//neerzet zoals header, menu en footer.

?>