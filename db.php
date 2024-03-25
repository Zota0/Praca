
<?php
    //! UWAGA TEN SKRYPT DZIAŁA TYLKO DO `MYSQL` -> NIE DZIAŁA DO INNYCH BAZ DANYCH ZE WZGLĘDU NA POLECENIE --> `mysqli` !
    // * Konfiguracja danych do połączenia
    $dbhost = 'localhost'; //! <--- TUTAJ WPISUJEMY ADRES HOSTA <-- standardowy to `localhost`
    $dbname = 'piabd2';  //! <--- TUTAJ NALEŻY WPISAĆ NAZWĘ BAZY DANYCH DO KTÓREJ SIĘ POŁĄCZY (ważne, żeby utworzyć/zaimportować bazę wcześniej!)
    $dbuser = 'root'; //! <--- TUTAJ NALEŻY WPISAĆ UŻYTKOWNIKA Z PHPMYADMIN (`root` jest domyślny) 
    $dbpass = ''; //! <--- TUTAJ EWENTUALNE HASŁO DO UŻYTKOWNIKA W PHPMYADMIN (standardowo profil 'root' nie ma owego hasła, więc zostawić puste)
    $dbport = 3306; //! <--- TUTAJ NALEŻY WPISAĆ PORT, KTÓRY MOŻNA ZNALEŹĆ W XAMPP'IE POD 'port(s)'

    // Robimy tablicę/szereg z danych powyżej
    $dbData = [
        $dbhost,
        $dbuser,
        $dbpass,
        $dbname,
        $dbport
    ];

    // Robimy funkcję dla wygody <- służy ona do połączenia z bazą
    function Connect($DATABASE_DATA) {
        $conn = new mysqli(
            $DATABASE_DATA[0],
            $DATABASE_DATA[1],
            $DATABASE_DATA[2],
            $DATABASE_DATA[3],
            $DATABASE_DATA[4]
        );
        if($conn->connect_error) {
            echo "<span class='error'>CONNECTION FAILED: <span class='message'>".$conn->connect_error."</span></span>";
        }

        return $conn;
    }

    function Execute($CONNECTION, $SQL) {
        $result = $CONNECTION->query($SQL);

        if(!$result) {
            echo "<span class='error'>ERROR: <span class='message'>"."Executing query".$CONNECTION->error_get_last."</span></span>";
        }
    }

    function Disconn($CONNECTION) {
        $CONNECTION->close();
    }
?> 
