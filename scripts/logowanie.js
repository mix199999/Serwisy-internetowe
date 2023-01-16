
let register = 0;

function reg() {
    register = 1;
    document.getElementById("log").value = ""; //wyczyszczenie inputa o id log
    document.getElementById("passw").value = ""; //wyczyszczenie inputa o id passw
    document.getElementById("em").value = ""; //wyczyszczenie inputa o id em
    document.getElementById("LoginButton").style.display = "none"; // pobranie z dokumentu elementu o ID LoginButton i zmiana jego wyświetlania na none
    document.getElementById("RegisterButton").style.display = "none"; // pobranie z dokumentu elementu o ID RegisterButton i zmiana jego wyświetlania na none

    document.getElementById("login").style.display = "block"; // pobranie z dokumentu elementu o ID login i zmiana jego wyświetlania z none na block
    document.getElementById("pass").style.display = "block"; // pobranie z dokumentu elementu o ID pass i zmiana jego wyświetlania z none na block
    document.getElementById("email").style.display = "block"; // pobranie z dokumentu elementu o ID email i zmiana jego wyświetlania z none na block
    document.getElementById("subButton").style.display = "block"; // pobranie z dokumentu elementu o ID subButton i zmiana jego wyświetlania z none na block
    document.getElementById("description").style.display = "none"; // pobranie z dokumentu elementu o ID description i zmiana jego wyświetlania na none
    document.getElementById("typkonta").style.display = "block"; // pobranie z dokumentu elementu o ID typkonta i zmiana jego wyświetlania z none na block

    document.getElementById("subButton").value = "Zarejestruj"; // zmiana wartości elementu o ID subButton na Zarejestruj

    document.getElementById("acc").style.display = "block"; // pobranie z dokumentu elementu o ID acc i zmiana jego wyświetlania z none na block
    document.getElementById("noacc").style.display = "none"; // pobranie z dokumentu elementu o ID noacc i zmiana jego wyświetlania z block na none
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
        let password = document.getElementById("passw").value; // zapisanie do zmiennej wartości elementu o ID passw

        if(regex.test(password)) { //sprawdzenie poprawności wpisanego hasła

            document.getElementById("blad").style.display = "none"; // pobranie z dokumentu elementu o ID blad i zmiana jego wyświetlania na none
            document.getElementById("subButton").style.pointerEvents = "auto"; // pobranie z dokumentu elementu o ID subButton i przywrócenie możliwości wciśnięcia
            document.getElementById("description").style.display = "none"; // pobranie z dokumentu elementu o ID description i zmiana jego wyświetlania na none

        }else if(password == ""){

            document.getElementById("subButton").style.pointerEvents = "none"; // pobranie z dokumentu elementu o ID subButton i wyłączenie możliwości wciśnięcia
            document.getElementById("blad").style.display = "none"; // pobranie z dokumentu elementu o ID blad i zmiana jego wyświetlania na none
            document.getElementById("description").style.display = "none"; // pobranie z dokumentu elementu o ID description i zmiana jego wyświetlania na none
        }else {

            document.getElementById("subButton").style.pointerEvents = "none"; // pobranie z dokumentu elementu o ID subButton i wyłączenie możliwości wciśnięcia
            document.getElementById("blad").style.display = "block"; // pobranie z dokumentu elementu o ID blad i zmiana jego wyświetlania na none
            document.getElementById("description").style.display = "block"; // pobranie z dokumentu elementu o ID description i zmiana jego wyświetlania na block

        }
    }

}

function emailcheck() {
    if(register == 1) {
        let regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;// wzór sprawdzający poprawność wpisywanego emaila
        //(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+")) sprawdza czy w podawanym emailu są nielegalne znaki
        //((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,})) sprawdza czy wpisałeś poprawne znaki
        // \S sprawdza czy sa spacje, taby itp

        let email = document.getElementById("em").value; // pobranie wartości z dokumentu o ID em

        if(regex.test(email)) { //sprawdzenie poprawności wpisanego emaila

            document.getElementById("blademail").style.display = "none"; // pobranie z dokumentu elementu o ID blademail i zmiana jego wyświetlania na none
            document.getElementById("subButton").style.pointerEvents = "auto"; // pobranie z dokumentu elementu o ID subButton i włączenie możliwości wciśnięcia

        }else if(email == ""){

            document.getElementById("subButton").style.pointerEvents = "none"; // pobranie z dokumentu elementu o ID subButton i wyłączenie możliwości wciśnięcia
            document.getElementById("blademail").style.display = "none"; // pobranie z dokumentu elementu o ID blademail i zmiana jego wyświetlania na none
        }else {

            document.getElementById("subButton").style.pointerEvents = "none"; // pobranie z dokumentu elementu o ID subButton i wyłączenie możliwości wciśnięcia
            document.getElementById("blademail").style.display = "block"; // pobranie z dokumentu elementu o ID blad i zmiana jego wyświetlania na block

        }
    }


}

function log() {
    register = 0;
    document.getElementById("log").value = ""; //wyczyszczenie inputa o id log
    document.getElementById("passw").value = ""; //wyczyszczenie inputa o id passw
    document.getElementById("subButton").style.pointerEvents = "auto"; // pobranie z dokumentu elementu o ID subButton i włączenie możliwości wciśnięcia
    document.getElementById("blademail").style.display = "none"; // pobranie z dokumentu elementu o ID blademail i zmiana jego wyświetlania na none
    document.getElementById("blad").style.display = "none"; // pobranie z dokumentu elementu o ID blad i zmiana jego wyświetlania na none
    document.getElementById("description").style.display = "none"; // pobranie z dokumentu elementu o ID description i zmiana jego wyświetlania na none
    document.getElementById("LoginButton").style.display = "none"; // pobranie z dokumentu elementu o ID LoginButton i zmiana jego wyświetlania na none
    document.getElementById("RegisterButton").style.display = "none"; // pobranie z dokumentu elementu o ID RegisterButton i zmiana jego wyświetlania na none
    document.getElementById("typkonta").style.display = "none";  // pobranie z dokumentu elementu o ID typkonta i zmiana jego wyświetlania na none

    document.getElementById("login").style.display = "block"; // pobranie z dokumentu elementu o ID login i zmiana jego wyświetlania z none na block
    document.getElementById("pass").style.display = "block"; // pobranie z dokumentu elementu o ID pass i zmiana jego wyświetlania z none na block
    document.getElementById("email").style.display = "none"; // pobranie z dokumentu elementu o ID email i zmiana jego wyświetlania na none
    document.getElementById("subButton").style.display = "block"; // pobranie z dokumentu elementu o ID subButton i zmiana jego wyświetlania z none na block
    document.getElementById("description").style.display = "none"; // pobranie z dokumentu elementu o ID description i zmiana jego wyświetlania na none
    document.getElementById("subButton").value = "Zaloguj"; // zmiana wartości elementu o ID subButton na Zaloguj

    document.getElementById("acc").style.display = "none"; // pobranie z dokumentu elementu o ID acc i zmiana jego wyświetlania z block na none
    document.getElementById("noacc").style.display = "block";  // pobranie z dokumentu elementu o ID noacc i zmiana jego wyświetlania z none na block

}