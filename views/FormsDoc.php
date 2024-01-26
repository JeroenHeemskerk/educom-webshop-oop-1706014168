<?php

	require_once "./views/BasicDoc.php";

abstract class FormsDoc extends BasicDoc {
	protected $user;
	
	
}	

/* TODO LIST:

Maak in de folder /views twee abstracte class files FormsDoc en ProductDoc aan, die overerfen van de BasicDoc en de functies bevatten die de classen die hiervan overerven gemeenschappelijk hebben.

Maak classen aan voor het contact-, inlog- en registratieformulier die overerven van de class FormsDoc.
Maak hier ook test php files voor aan in de folder /tests.

Maak de classen aan voor de overige paginas in je webshop inclusief test php files.

TODO: Pas de functie showResponsePage($data) aan zodat deze een grote switch-case heeft waarin de juiste pagina wordt geïnstancieerd en tenslote de show methode hierop wordt aangeroepen.

Commit regelmatig je code naar je lokale repository
push je commits naar GitHub


*/

?>