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
	
	private function showHtmlStart() {
        echo '<!DOCTYPE html>';
		echo '<html>';
    }

    private function showHeaderStart() {
        echo '<head>';
    }

    protected function showHeadContent() {
        echo '<title>HtmlDoc</title>';
    }

    private function showHeaderEnd() {
        echo '</head>';
    }

    private function showBodyStart() {
        echo '<body>';
    }

    protected function showBodyContent() {
         echo '<h1>Hello, OOP world!</h1>';
    }

    private function showBodyEnd() {
        echo '</body>';
    }

    private function showHtmlEnd() {
        echo '</html>';
    }
}

?>