<?php

require_once CONN_PATH;
require_once USER_CLASS_PATH;



$database = new Database();
$db = $database->getConnection();
$user = new User($db);



try {
        //logowanie

        if(isset($_POST["login"])  && isset($_POST["passwd"]) && ($_POST["email"])== '')
        {	
            $user = new User($db);
            $user->login = $_POST["login"];
            $user->passwd= $_POST["passwd"];
            if($user->login()) 
            {

                if($_SESSION["user_type"] == 1)
                {
                    header('Location: index.php?action=zarzadzanieUzytkownikami');
                }

                else if ($_SESSION["user_type"] == 2)

                {
                    header('Location: index.php?action=StartPage');
                }

                else if ($_SESSION["user_type"] == 3)
                {
                    header('Location: index.php?action=StartPage');
                }
                else if( $_SESSION["session_name"] == 4)
                {
                    include("./strony/newUser.php");
                }
               //todo jesli inne role



            } else {
                
                  // alert can't login
                echo "<script>alert('Nie udało się zalogować');</script>";
                  

            }
        }

        //rejestracja i logowanie
        else if(isset($_POST["login"])  && isset($_POST["passwd"])&& $_POST["email"] != '')
        {
            $user = new User($db);
            $user->login = $_POST["login"];
            $user->id_priv= $_POST["id_priv"];
            $user->passwd= $_POST["passwd"];
            $user->email= $_POST["email"];

           if( $user -> addUser())
           {
            $_SESSION["action"] = "newUser";
               
            $_SESSION["user_type"] = $user->id_priv;
            header('Location: index.php?action=newUser.php');
           }
              else
              {
                echo "<script>alert('Nie udało się zarejestrować');</script>";
              }
                
            
            
        }

 
        

       
        
        
       

    } catch (PDOException $e)
    {
        die("Connection failed: " . $e->getMessage());
        echo"blad";
    }



?>