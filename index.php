<?php

define('_ROOT_PATH', str_replace('\\', '/', dirname(__FILE__)));
define('CONN_PATH', str_replace('\\', '/', dirname(__FILE__)) . '/conf/connDB.php');
define('VIDEO_CLASS_PATH', str_replace('\\', '/', dirname(__FILE__)) . '/class/Video.php');
define('USER_CLASS_PATH', str_replace('\\', '/', dirname(__FILE__)) . '/class/Users.php');

define('TAGS_CLASS_PATH', str_replace('\\', '/', dirname(__FILE__)) . '/class/Tags.php');
define('_STYLES', str_replace('\\', '/', dirname(__FILE__)) . '/styles/');
define('_SCRIPTS', str_replace('\\', '/', dirname(__FILE__)) . '/scripts/');
define('_JQUERY', str_replace('\\', '/', dirname(__FILE__)) . '/scripts/jquery-3.6.3.js');


// require_once CONN_PATH;
// require_once USER_CLASS_PATH;
// require_once VIDEO_CLASS_PATH;



session_start();

//ale fajne

#trzeba bedzie zaprojektowac strone glowna tzn. zeby bylo do wybrania logowanie/rejestracja 
#mozna w sumie podzielic ta strone dwa segmenty po lewej opis platformy  a po prawej formularz logowanie lub rejestracji
#moze da sie zrobic tak jak w formsach tzn. to boxa ładujemy kontrolke ktora zmienia sie po nacisnieciu przycisku

$actions = array('messages','videosAdministration','userChannel','userChatPage','wyloguj', 'user','admin', 'StartPage', 'logowanie','pageNotFound','zarzadzanieUzytkownikami', 'addvideo', 'test', 'edytuj' , 'newUser', 'watchVideo', 'watch', 'userRequests', 'search', 'tickets','reports','ustawienia');



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
				
				include("./views/admin.php");
                include("./actions/admin.php");
				
			}
		else if( $_SESSION["user_type"] == 2)
			{
				
				
				include("./views/user.php");
				
			}
        else if($_SESSION["user_type"] == 3)
        {

            include("./views/editor.php");
        }
        else if($_SESSION["user_type"] == 4){
            include("./views/user.php");
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
    .'views'.DIRECTORY_SEPARATOR.$_SESSION['action'].'.php');
	


?>