<?php
    include("aperturaSessioni.php");
    if(isset($_REQUEST["email"]) && isset($_REQUEST["pswrd"])){
        $email = trim($_REQUEST["email"]);
        $password_utente = trim($_REQUEST["pswrd"]);
        $nome_server = $_SERVER["SERVER_ADDR"];
        $nome_utente = "uReadWrite";
        /*la password viene presa dal file contentente lo script sql per creare il database, 
        si farà la stessa cosa anche per l'utente privilegiato*/ 
        $password = "SuperPippo!!!";
        $nome_database = "tickets_online";

        $conn = mysqli_connect($nome_server, $nome_utente, $password, $nome_database); 
        mysqli_set_charset($conn, "utf8mb4");
        //controllo che non ci siano errori nella connessione
        if(mysqli_connect_errno()){
            echo "<p>Errore connessione al DBMS: ".mysqli_connect_error()."</p>\n";
            //faccio in modo che stampi solo questo e segnali l'errore, non deve essere stampata la parte relativa alla registrazione
        }else{
                $query = "SELECT * FROM utenti WHERE email=?";
                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, "s", $email);
                if(!mysqli_stmt_execute($stmt)){
                    echo "<p>Errore query fallita, ricontrollare quale può essere il problema</p>";
                }
                //qui associo ad ogni valore una variabile, poi controllo che corrisponda alla password che si vuole
                mysqli_stmt_bind_result($stmt, $fetched_email, $fetched_password);
                $_SESSION["errore"] = false;
                while($row = mysqli_stmt_fetch($stmt)){
                    if($password_utente == $fetched_password){
                        $_SESSION["no_errore"] = true;
                        $_SESSION["entrato"] = true;
                        $_SESSION["nome_utente"] = $email;
                        setcookie('ultimo_accesso', $email, time() + 57600, '/');
                        if(!mysqli_close($conn)){
                            echo "<p>La connessione non si riesce a chiudere, errore.</p>";
                            exit();
                        } 
                        header("Location: acquisto.php");
                        exit();
                    }
                }
                
                if(isset($_SESSION["no_errore"]) == false){
                    /*creo una variabile globale che è true, per indicare che è presente un errore generico sull'interimento*/
                    $_SESSION["errore"] = "errore nell'eseguire l'accesso";
                }   
                mysqli_stmt_close($stmt);                    
                if(!mysqli_close($conn)){
                            echo "<p>La connessione non si riesce a chiudere, errore.</p>";
                } 
        }      
    }   
?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <title>Interfaccia Utente ESP1</title>
        <meta name="author" content="Paolo Aimar">
        <link rel="stylesheet" href="../css/Login_ESP1_CSS.css">
        <meta name="keywords" lang="it" content="html">
        <!--in questo caso fornisco una breve descrizione della pagina nella parte di header, in modo da informare le persone 
        sulle operazioni che vengono svolte nella pagina-->
        <meta name="description" content="Pagina per registrarsi al sito">
        <meta http-equiv="refresh" content="60">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="../javascript/javascript_ESP1.js"></script>
    </head>
    <body>
        <div class="contenitore">
            <h1>Inserisci i dati per effettuare il login</h1>
            <form action="login.php" id="contactForm" name="contactForm" method="get" onsubmit="return validateForm('contactForm');">
            <?php
                if(isset($_SESSION["successo"])){
                    $messaggio = $_SESSION["successo"];
                    echo "<div class=\"successo\">$messaggio</div>";
                    unset($_SESSION["successo"]);
                }elseif(isset($_SESSION["errore"])){
                    $messaggio = $_SESSION["errore"];
                    echo "<div class=\"errore\">$messaggio</div>";
                    unset($_SESSION["errore"]);
                }
            ?>
                <p>
                    <!--Creo delle label per ogni singolo input text in modo che si chiarifichi meglio come andare ad inserire le informazioni-->
                    <label for="email">email:</label>
                    <input type="email" id="email" name="email" placeholder="Inserire email" required>
                </p>
                <p>
                    <label for="password">password:</label>
                    <input type="password" name="pswrd" id="pswrd" placeholder="Inserire la password" required>
                </p>
                <p>
                    <!--manca l'opzione recupera password-->
                    <input type="submit" id="sottometti" name="sottometti" value="Accedi">
                    <input type="button" id="registrazione" onclick="openSubscription();" value="Registrati Adesso">
                    <input type="reset" id="clear" name="clear" value="Cancella">
                </p>
            </form>
        </div>
    </body>
</html>
