<?php

//Maak in de folder /views een class file HtmlDoc aan, die een kale HTML pagina kan genereren, 
//met maar 1 publieke methode show() die alleen maar private en protected methoden aanroept.

class HtmlDoc {
	
	
	public function show() {
		//call a bunch of private and protected methods
		showHtmlStart();
		showHeaderStart();
		showHeaderContent();
		showHeaderEnd();
		showBodyStart();
		showBodyContent();
		showBodyEnd();
		showHtmlEnd();
		
	}
}

?>