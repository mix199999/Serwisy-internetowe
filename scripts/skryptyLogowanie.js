

function reg() {

    document.getElementById("LoginButton").style.display = "none"; // pobranie z dokumentu elementu o ID LoginButton i zmiana jego wyświetlania na none
    document.getElementById("RegisterButton").style.display = "none"; // pobranie z dokumentu elementu o ID RegisterButton i zmiana jego wyświetlania na none

    document.getElementById("login").style.display = "block"; // pobranie z dokumentu elementu o ID login i zmiana jego wyświetlania z none na block
    document.getElementById("pass").style.display = "block"; // pobranie z dokumentu elementu o ID pass i zmiana jego wyświetlania z none na block
    document.getElementById("email").style.display = "block"; // pobranie z dokumentu elementu o ID email i zmiana jego wyświetlania z none na block
    document.getElementById("subButton").style.display = "block";
    document.getElementById("subButton").value = "Zarejestruj";


    document.getElementById("acc").style.display = "block";
    document.getElementById("noacc").style.display = "none";
}

function log() {

    document.getElementById("LoginButton").style.display = "none"; // pobranie z dokumentu elementu o ID LoginButton i zmiana jego wyświetlania na none
    document.getElementById("RegisterButton").style.display = "none"; // pobranie z dokumentu elementu o ID RegisterButton i zmiana jego wyświetlania na none

    document.getElementById("login").style.display = "block"; // pobranie z dokumentu elementu o ID login i zmiana jego wyświetlania z none na block
    document.getElementById("pass").style.display = "block"; // pobranie z dokumentu elementu o ID pass i zmiana jego wyświetlania z none na block
    document.getElementById("email").style.display = "none"; // pobranie z dokumentu elementu o ID email i zmiana jego wyświetlania na none
    document.getElementById("subButton").style.display = "block";
    document.getElementById("subButton").value = "Zaloguj";

    document.getElementById("acc").style.display = "none";
    document.getElementById("noacc").style.display = "block";

}