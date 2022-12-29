<?php

define('_ROOT_PATH', dirname(__FILE__));

session_start();

//ale fajne

#trzeba bedzie zaprojektowac strone glowna tzn. zeby bylo do wybrania logowanie/rejestracja 
#mozna w sumie podzielic ta strone dwa segmenty po lewej opis platformy  a po prawej formularz logowanie lub rejestracji
#moze da sie zrobic tak jak w formsach tzn. to boxa ładujemy kontrolke ktora zmienia sie po nacisnieciu przycisku

$actions = array('wyloguj', 'user','admin', 'StartPage', 'logowanie','pageNotFound','zarzadzanieUzytkownikami', 'addvideo', 'test', 'edytuj' , 'newUser', 'watchVideo', 'watch', 'userRequests', 'search', 'tickets');



if (array_key_exists('action', $_GET))
{

    if($_GET['action'] == 'wyloguj') {
        $_SESSION = array();
        $_GET['action'] = 'logowanie';
        $_SESSION['action'] = 'logowanie';

    }

    if (in_array($_GET['action'] , $actions)) {
        $_SESSION['action'] = $_GET['action'];
    }

    //    else 
    //	$action = 'pageNotFound';

}


		
	if(isset($_SESSION["user_type"])) 
    {
	
		if($_SESSION["user_type"] == 1)
			{
				
				include("./views/admin.html");
                include("./actions/admin.php");
				
			}
		else if( $_SESSION["user_type"] == 2)
			{
				
				
				include("./views/user.html");
				
			}
        else if($_SESSION["user_type"] == 3)
        {

            include("./views/editor.html");
        }
        else if($_SESSION["user_type"] == 4){
            include("./views/user.html");
        }
        //todo jesli inne typy konta

		
	}
	else
	{
		$_SESSION['action'] = 'logowanie';
	}



include(_ROOT_PATH.DIRECTORY_SEPARATOR
    .'actions'.DIRECTORY_SEPARATOR.$_SESSION['action'].'.php');
include(_ROOT_PATH.DIRECTORY_SEPARATOR
    .'views'.DIRECTORY_SEPARATOR.$_SESSION['action'].'.html');
	
$scripts = _ROOT_PATH.DIRECTORY_SEPARATOR .'scripts'.DIRECTORY_SEPARATOR.$_SESSION['action'].'.js';
if(file_exists($scripts)){
    include($scripts);
}
  

?>