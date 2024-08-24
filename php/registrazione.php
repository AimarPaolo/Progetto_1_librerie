<?php
    include("aperturaSessioni.php");
    if(isset($_REQUEST["email"]) && isset($_REQUEST["pswrd"])){
        $nome_utente = trim($_REQUEST["email"]);
        $password = trim($_REQUEST["pswrd"]);
        /*$utente = array("nome" => $utente, "password" => $password);
        setcookie("utente", $utente, time() + 57600, "/");*/
        //il metodo che utilizza i cookie non è sufficientemente sicuro. Preferisco utilizzare il database in quanto risulta più sicuro per 
        //salvare i dati privati
        $nome_server = $_SERVER["SERVER_ADDR"];
        $username = "uReadWrite";
        $password_accesso = "SuperPippo!!!";
        $nome_database = "tickets_online";

        $conn = mysqli_connect($nome_server, $username, $password_accesso, $nome_database); 
        mysqli_set_charset($conn, "utf8mb4");
        if (!$conn) {
            die("Connessione fallita: " . mysqli_connect_error());
        }
        $query = "SELECT utenti.email FROM utenti WHERE email = ?";
        /*controllo che la mail non sia già stata utilizzata */
        $stmt = mysqli_prepare($conn, $query);
        /*con questo comando associo la connessione alla query*/ 
        mysqli_stmt_bind_param($stmt, "s", $nome_utente);
        mysqli_stmt_bind_result($stmt, $fetched_username);
        while($row = mysqli_stmt_fetch($stmt)){
            /*Se entra nel ciclo vuol dire che il numero di righe è diverso da 0 (in questo caso può solo essere 1) e quindi mando
            il messaggio di errore dicendo che il nome utente inserito è già utilizzato*/
            /*volevo anche aggiungere un modo per salvare i dati e non dover reinserire tutti i campi ma solo lo username, quando viene ripetuto.*/
            $_SESSION["messaggio_di_errore"] = "Il nome utente da lei scelto è già utilizzato, selezionarne un altro.";
            header("Location: registrazione.php");
            exit();
        }
        $query_inserimento = "INSERT INTO utenti (email, pwd) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $query_inserimento);
        mysqli_stmt_bind_param($stmt, "ss", $nome_utente, $password);
        $result = mysqli_stmt_execute($stmt);
        if(!$result){
                $_SESSION["messaggio_di_errore"] =  "<p>Errore query fallita: ".mysqli_error($conn)."</p>\n";
                header("Location: registrazione.php");
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                header("Location: registrazione.php");
                exit();
        }else{
            $_SESSION["nome_utente"] = $nome_utente;
            $_SESSION["successo"] = "registrazione effettuata con successo";
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: login.php");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <title>Registrazione Utente</title>
        <meta name="author" content="Paolo Aimar">
        <link rel="stylesheet" href="../css/Registrazione_ESP1.css">
        <meta name="keywords" lang="it" content="html">
        <meta name="description" content="Pagina per registrarsi al sito">
        <meta http-equiv="refresh" content="3000">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="../javascript/check_registrazione.js"></script>
    </head>
    <body>
        <div class="contenitore">
            <h1>Registrati</h1>
            <form action="registrazione.php" id="contactForm" name="contactForm" method="get" onsubmit="return validateForm('contactForm');">
                <?php
                    if(isset($_SESSION["messaggio_di_errore"])){
                        $messaggio = $_SESSION["messaggio_di_errore"];
                        echo "<div>$messaggio</div>";
                        unset($_SESSION["messaggio_di_errore"]);
                    }
                ?>
                <p>
                    <label for="email">email:</label>
                    <input type="email" id="email" name="email" placeholder="Inserire l'email" required>
                </p>
                <p>
                    <label for="password">password:</label>
                    <input type="password" name="pswrd" id="pswrd" placeholder="Inserire la password" required>
                    <a class="link" href="login.php">Torna alla pagina di login</a>
                </p>
                <div>
                    Per la password inserire almeno 8 caratteri incluse lettere (maiuscole e minuscole), numeri e caratteri speciali.
                </div>
                <p>
                    <button type="submit" id="reg" name="reg">Crea utente</button>
                    <button type="reset" id="clear" name="clear">Cancella</button>
                </p>
            </form>
        </div>
    </body>
</html>
