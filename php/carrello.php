<?php
    include("aperturaSessioni.php");
    if(isset($_SESSION["entrato"])){
        $email = $_SESSION["nome_utente"];
        ?>
        <!DOCTYPE html>
        <html lang="it">
    <head>
        <meta charset="UTF-8">
        <title>Carrello per gli acquisti</title>
        <meta name="author" content="Paolo Aimar">
        <meta name="keywords" lang="it" content="html">
        <meta name="description" content="Pagina di acquisto dei biglietti">
        <meta http-equiv="refresh" content="600">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/Acquisto_ESP1.css">
        <script src="../javascript/check_eventi_ESP1.js"></script>
    </head>
    <body>
    <div class="navbar">
            <a href="home.html">Home</a>
            <a href="acquisto.php">Acquista un biglietto</a>
            <a href="logout.php">Logout</a>
            <a href="carrello.php">Carrello Acquisti</a>
    </div>
    <?php
// Creo un carrello caratterizzato dalle seguenti caratteristiche --> email, cod. prodotto, quantità e costo del singolo biglietto
// Quando si conferma l'ordine la quantità di tutti i prodotti viene impostata a 0

$costi_biglietto = [59.9, 39.9, 40.9, 57.9, 87.0, 230.0];
// Fingo che in questo caso il numero massimo di biglietti sia 6 
$email = trim($_SESSION["nome_utente"]);
$nome_server = $_SERVER["SERVER_ADDR"];
$nome_utente = "uReadWrite";
$password = "SuperPippo!!!";
$nome_database = "tickets_online";
$conn = mysqli_connect($nome_server, $nome_utente, $password, $nome_database); 
mysqli_set_charset($conn, "utf8mb4");

if(mysqli_connect_errno()){
    echo "<p>Errore connessione al DBMS: " . mysqli_connect_error() . "</p>\n";
    exit();
}

// Ciclo per aggiornare il carrello con i nuovi acquisti
for ($i = 1; $i <= 6; $i++) {
    $quantita_acquistata = isset($_REQUEST["counter$i"]) ? trim($_REQUEST["counter$i"]) : 0;

    $query = "SELECT quantita FROM carrello WHERE email = ? AND codice = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $email, $i);

    if(!mysqli_stmt_execute($stmt)){
        echo "<p>Errore query fallita, ricontrollare quale può essere il problema</p>";
        continue; // Salta alla prossima iterazione in caso di errore
    }

    mysqli_stmt_bind_result($stmt, $fetched_quantita);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt); // Chiudiamo lo statement

    if ($fetched_quantita !== null) {
        // Aggiorna la quantità esistente
        $nuova_quantita = $quantita_acquistata + $fetched_quantita;
        $query_inserimento = "UPDATE carrello SET quantita = ? WHERE email = ? AND codice = ?";
        $stmt = mysqli_prepare($conn, $query_inserimento);
        mysqli_stmt_bind_param($stmt, "isi", $nuova_quantita, $email, $i);
    } else {
        // Inserisci nuovo elemento nel carrello
        if ($quantita_acquistata > 0) { // Solo se la quantità è maggiore di zero
            $query_inserimento = "INSERT INTO carrello (email, codice, quantita, costo) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query_inserimento);
            mysqli_stmt_bind_param($stmt, "siid", $email, $i, $quantita_acquistata, $costi_biglietto[$i-1]);
        }
    }

    if (!mysqli_stmt_execute($stmt)) {
        echo "<p>Errore nell'esecuzione della query di inserimento/aggiornamento</p>";
        continue;
    }
    
    mysqli_stmt_close($stmt);
}

// Stampa della tabella con tutti i biglietti dell'utente
echo "<h1>Carrello dell'utente $email</h1>";
echo "<table border='1'>";
echo "<tr><th>Codice Prodotto</th><th>Quantità</th><th>Costo per Unità</th><th>Costo Totale</th></tr>";

for ($i = 1; $i <= 6; $i++) {
    $fetched_quantita = 0;
    $query = "SELECT quantita, costo FROM carrello WHERE email = ? AND codice = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $email, $i);

    if(!mysqli_stmt_execute($stmt)){
        echo "<p>Errore query fallita, ricontrollare quale può essere il problema</p>";
        continue; // Salta alla prossima iterazione in caso di errore
    }
    mysqli_stmt_bind_result($stmt, $fetched_quantita, $fetched_costo);
    echo $fetched_quantita;
    echo $i;
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt); // Chiudiamo lo statement
    if ($fetched_quantita == 0) {
        $fetched_quantita = 0;
        $fetched_costo = $costi_biglietto[$i-1];
    }

    // Calcola il costo totale del biglietto mostrando all'utente quanto dovrebbe poi pagare
    $costo_totale_biglietto = $fetched_quantita * $costi_biglietto[$i-1];
    $costo_totale += $costo_totale_biglietto;
    // Stampa la riga della tabella
    echo "<tr>
            <td>$i</td>
            <td>$fetched_quantita</td>
            <td>" . number_format($costi_biglietto[$i-1], 2) . " €</td>
            <td>" . number_format($costo_totale_biglietto, 2) . " €</td>
          </tr>";
}

echo "</table>";

echo "<div class=\"check\">Checkout: ".$costo_totale."</div>";

mysqli_close($conn);
?>
    <form action="acquistoEffettuato.php" method="get" id="form3" name="form3">
        <!--in questo caso uso questo pulsante anche per azzerare i valori dato che il pulsante acquista non funziona effettivamente per acquistare-->
        <input class="bottoniFinali" id="colora" type="submit" value="Acquista">
    </form>
    </body>
    </html>
    <?php
    }else{
    ?>
    <!DOCTYPE html>
        <html lang="it">
    <head>
        <meta charset="UTF-8">
        <title>Carrello per gli acquisti</title>
        <meta name="author" content="Paolo Aimar">
        <meta name="keywords" lang="it" content="html">
        <meta name="description" content="Pagina di acquisto dei biglietti">
        <meta http-equiv="refresh" content="600">
        <link rel="stylesheet" href="../css/Acquisto_ESP1.css">
        <script src="check_eventi_ESP1.js"></script>
    </head>
    <body>
        <div>Errore nel login, prova di nuovo ad eseguirlo <a href="login.php">>>Login</a></div>
    </body>
    </html>
    <?php
    }
        ?>
