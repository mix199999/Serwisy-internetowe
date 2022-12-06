<?php

define('_ROOT_PATH', dirname(__FILE__));

session_start();



#trzeba bedzie zaprojektowac strone glowna tzn. zeby bylo do wybrania logowanie/rejestracja 
#mozna w sumie podzielic ta strone dwa segmenty po lewej opis platformy  a po prawej formularz logowanie lub rejestracji
#moze da sie zrobic tak jak w formsach tzn. to boxa ładujemy kontrolke ktora zmienia sie po nacisnieciu przycisku

	$actions = array('wyloguj', 'user','admin', 'welcome_page', 'logowanie','pageNotFound' );
    $action;

	if (array_key_exists('action', $_GET)) 
	{
	
		if($_GET['action'] == 'wyloguj') {
			$_SESSION = array();
			$_GET['action'] = 'logowanie';
			$action = 'logowanie';
			
		}
		
		if (in_array($_GET['action'] , $actions)) {
			$action = $_GET['action'];
		} 
        
        else 
			$action = 'pageNotFound';
	
	}

		
	if(isset($_SESSION["session_name"])) 
    {
	
		if($_SESSION["session_name"] ==	 'admin')
			{
				
				include("./views/admin.html");
				
			}
		else if( $_SESSION["session_name"] == 'user')
			{
				
				
				include("./views/user.html");
				
			}
		
	}
	else
	{
		$action = 'logowanie';
	}

	
	

	include(_ROOT_PATH.DIRECTORY_SEPARATOR
	.'actions'.DIRECTORY_SEPARATOR.$action.'.php');
	include(_ROOT_PATH.DIRECTORY_SEPARATOR
	.'views'.DIRECTORY_SEPARATOR.$action.'.html');
	
	

  

?>