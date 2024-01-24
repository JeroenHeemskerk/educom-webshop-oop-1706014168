<?php

//Maak in de folder /views een class file HtmlDoc aan, die een kale HTML pagina kan genereren, 
//met maar 1 publieke methode show() die alleen maar private en protected methoden aanroept.

class HtmlDoc {
	
	
	public function show() {
		//call a bunch of private and protected methods
		$this->showHtmlStart();
		$this->showHeaderStart();
		$this->showHeaderContent();
		$this->showHeaderEnd();
		$this->showBodyStart();
		$this->showBodyContent();
		$this->showBodyEnd();
		$this->showHtmlEnd();
	}
	
	public function showHtmlStart() {
        echo '<!DOCTYPE html>';
		echo '<html>';
    }

    public function showHeaderStart() {
        echo '<head>';
    }

    public function showHeaderContent() {
        echo '<title>Webshop</title>';
		//Perhaps should be added with other things like stylesheets
    }

    public function showHeaderEnd() {
        echo '</head>';
    }

    public function showBodyStart() {
        echo '<body>';
    }

    public function showBodyContent() {
         echo '<h1>Hello, OOP world!</h1>';
    }

    public function showBodyEnd() {
        echo '</body>';
    }

    public function showHtmlEnd() {
        echo '</html>';
    }
}

?>