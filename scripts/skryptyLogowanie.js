
let register = 0;

function reg() {
    register = 1;
    document.getElementById("log").value = "";
    document.getElementById("passw").value = "";
    document.getElementById("em").value = "";
    document.getElementById("LoginButton").style.display = "none"; // pobranie z dokumentu elementu o ID LoginButton i zmiana jego wyświetlania na none
    document.getElementById("RegisterButton").style.display = "none"; // pobranie z dokumentu elementu o ID RegisterButton i zmiana jego wyświetlania na none

    document.getElementById("login").style.display = "block"; // pobranie z dokumentu elementu o ID login i zmiana jego wyświetlania z none na block
    document.getElementById("pass").style.display = "block"; // pobranie z dokumentu elementu o ID pass i zmiana jego wyświetlania z none na block
    document.getElementById("email").style.display = "block"; // pobranie z dokumentu elementu o ID email i zmiana jego wyświetlania z none na block
    document.getElementById("subButton").style.display = "block";
    document.getElementById("description").style.display = "none";
    document.getElementById("typkonta").style.display = "block";

    document.getElementById("subButton").value = "Zarejestruj";

    document.getElementById("acc").style.display = "block";
    document.getElementById("noacc").style.display = "none";
}

function passwordcheck() {

    if(register == 1){
        let regex = /^(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/; // wzór mówiący o tym że hasło musi zawierać dużą literę, cyfrę i być conajmniej 8 znakowe
        // /^ i $/ to poczatek i koniec "funkcji" regex
        // ?= oznacza że taki znak musi wystapic w hasle
        // (?=.*[A-Z]) oznacza że musi zawierać dużą literę
        // (?=.*\d) oznacza że musi zawierać liczbę
        // [A-Za-z\d] mozna wpisac cokolwiek czyli i litery male i duze i liczbe
        // {8,} musi miec conajmniej 8 znakow mozna dac ze minimum 8 znakow max 16 wtedy byloby {8,16}
        let password = document.getElementById("passw").value;

        if(regex.test(password)) {

            document.getElementById("blad").style.display = "none";
            document.getElementById("subButton").style.pointerEvents = "auto";
            document.getElementById("description").style.display = "none";

        }else if(password == ""){

            document.getElementById("subButton").style.pointerEvents = "none";
            document.getElementById("blad").style.display = "none";
            document.getElementById("description").style.display = "none";
        }else {

            document.getElementById("subButton").style.pointerEvents = "none";
            document.getElementById("blad").style.display = "block";
            document.getElementById("description").style.display = "block";

        }
    }

}

function emailcheck() {
    if(register == 1) {
        let regex = /^\S+@\S+\.\S+$/;
        let regex2 = /^[A-Za-z\d_.+-]\S+@?[a-zA-Z0-9-]\S+\.[a-zA-Z0-9-.]\S+$/
        let regex3 = /^[^,?!%#$&*()]*$/;
        ///^[^abc]*$/
        // \S sprawdza czy sa spacje, taby itp

        let email = document.getElementById("em").value;


        console.log(regex3.test(email));
        if(regex2.test(email) && regex3.test(email)) {

            document.getElementById("blademail").style.display = "none";
            document.getElementById("subButton").style.pointerEvents = "auto";

        }else if(email == ""){

            document.getElementById("subButton").style.pointerEvents = "none";
            document.getElementById("blademail").style.display = "none";
        }else {

            document.getElementById("subButton").style.pointerEvents = "none";
            document.getElementById("blademail").style.display = "block";

        }
    }


}

function log() {
    register = 0;
    document.getElementById("log").value = "";
    document.getElementById("passw").value = "";
    document.getElementById("subButton").style.pointerEvents = "auto";
    document.getElementById("blademail").style.display = "none";
    document.getElementById("blad").style.display = "none";
    document.getElementById("description").style.display = "none";
    document.getElementById("LoginButton").style.display = "none"; // pobranie z dokumentu elementu o ID LoginButton i zmiana jego wyświetlania na none
    document.getElementById("RegisterButton").style.display = "none"; // pobranie z dokumentu elementu o ID RegisterButton i zmiana jego wyświetlania na none
    document.getElementById("typkonta").style.display = "none";

    document.getElementById("login").style.display = "block"; // pobranie z dokumentu elementu o ID login i zmiana jego wyświetlania z none na block
    document.getElementById("pass").style.display = "block"; // pobranie z dokumentu elementu o ID pass i zmiana jego wyświetlania z none na block
    document.getElementById("email").style.display = "none"; // pobranie z dokumentu elementu o ID email i zmiana jego wyświetlania na none
    document.getElementById("subButton").style.display = "block";
    document.getElementById("description").style.display = "none";
    document.getElementById("subButton").value = "Zaloguj";

    document.getElementById("acc").style.display = "none";
    document.getElementById("noacc").style.display = "block";

}