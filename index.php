<!DOCTYPE html>
<html lang="pl">
<head>
    <?php $timestamp = date("YmdHis"); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=<?php echo $timestamp; ?>">
    <title>FORMULARZ + MYSQL</title>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js'></script>
    <link rel="stylesheet" href="jquery-ui.structure.min.css">
    <link rel="stylesheet" href="jquery-ui.theme.min.css">
</head>
<body class='layout'>
        <div class='form-container'>
            <?php
                if(true) {
                    include('db.php');
                    if(isset($_POST['firstname']) && $_POST['lastname'] && $_POST['birthdate']) {
                        $birthdate = $_POST['birthdate'];
                        $birthdate_formated = date('Y-m-d',strtotime($birthdate));

                        $DataToSend = [
                            "FirstName" =>$_POST['firstname'],
                            "LastName" => $_POST['lastname'],
                            "BirthDate" => $birthdate_formated
                        ];
                    
                        $sql = "
                            INSERT INTO users (FIRSTNAME, LASTNAME, BIRTHDATE)
                            VALUES
                            ('$DataToSend[FirstName]', '$DataToSend[LastName]', '$DataToSend[BirthDate]')
                        "; 
                    }
                    if(isset($DataToSend)) {
                        $sended = false;
                        if($sended == true) {
                            unset($sql);
                            unset($date);
                            unset($DataToSend);
                            unset($_POST['firstname']);
                            unset($_POST['lastname']);
                            unset($_POST['birthdate']);
                            if($connection) {
                                Disconn($connection);
                            }
                            $_POST = [];
                        }
                        if($sended == false) {
                            for($i=0;$i<=2;$i++) {
                                if($i==0) {
                                    $connection = Connect($dbData);
                                }
                                if($i==1) {
                                    Execute($connection,$sql);
                                }
                                if($i==2) {
                                    Disconn($connection);
                                    unset($connection);
                                    unset($sql);
                                    unset($date);
                                    unset($DataToSend);
                                    $sended = true;
                                    $_POST = [];
                                    unset($_POST['firstname']);
                                    unset($_POST['lastname']);
                                    unset($_POST['birthdate']);
                                    break;
                                }            
                            }
                        }
                    }
                }
            ?>
            <form onsubmit="document.getElementById('send-form').disabled = true;" method="post">
                <h3 class='form-title'>Zapisz się!</h3>
                <div class='form-row'>
                    <label for="firstname">Imię</label>
                    <input required placeholder='Wpisz swoje imię.' type="text" name="firstname" id="firstname">
                </div>
                <div class='form-row'>
                    <label for="lastname">Nazwisko</label>
                    <input required placeholder='Wpisz swoje nazwisko.' type="text" name="lastname" id="lastname">
                </div>
                <div class='form-row'>
                    <label for="birthdate">Data urodzenia</label>
                    <input required placeholder='Wpisz swoją datę urodzenia' type="text" name="birthdate" id="birthdate">
                    <script>
                        $(document).ready(function() {
                            $("#birthdate").datepicker({
                                changeMonth: true,
                                changeYear: true,
                                showButtomPanel: true,
                                yearRange: "-180:+0"
                            });
                        })
                    </script>
                </div>
                <div class="form-row">
                    <label for="pesel">Pesel</label>
                    <input required placeholder="Wpisz swój pesel." min="11" type="number" name="pesel" id="pesel" max="11">
                </div>
                <br>
                <div class='form-row'>
                    <button class='form-submit' type="submit" name='send' value='1' id='send-form'>ZAPISZ</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>