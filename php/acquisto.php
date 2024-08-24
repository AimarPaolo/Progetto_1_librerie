<?php
    include("aperturaSessioni.php");
    if(!isset($_SESSION["entrato"])){
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
                <script src="../javascript/javascript_ESP1.js"></script>
            </head>
            <body>
                <div>Errore nel login, prova di nuovo ad eseguirlo <a href="login.php">>>Login</a></div>
            </body>
        </html>
        <?php
    }else{
?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <title>Pagina per acquistare i biglietti</title>
        <meta name="author" content="Paolo Aimar">
        <meta name="keywords" lang="it" content="html">
        <meta name="description" content="Pagina di acquisto dei biglietti">
        <!--in questo caso la pagina viene aggiornata ogni 10 minuti, in quanto magari ci vuole qualche secondo in più per scegliere gli eventi
        e quindi non sarebbe corretto aggiornarla ogni 60 secondi (l'utente non avrebbe il tempo di scegliere i biglietti per l'evento)-->
        <meta http-equiv="refresh" content="600">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/Acquisto_ESP1.css">
        <script src="../javascript/check_eventi_ESP1.js"></script>
    </head>
    <body>
        <div class="navbar">
            <!--In questo caso dichiaro una classe attiva in modo da cambiare ogni volta il colore e far capire in modo più chiaro all'utente
            in quale pagina si trova-->
            <!--utilizzo un menù per collegare le pagine, volendo si potevano anche utilizzare altri bottoni ma l'utente potrebbe rimanere 
            leggermente confuso. Meglio utilizzare oggetti più intuitivi che aiutino il cliente a capire come spostarsi-->
            <a href="home.html">Home</a>
            <a href="acquisto.php">Acquista un biglietto</a>
            <!--permetto all'utente di effettuare un logout nel caso in cui voglia acquistare i biglietti utilizzando un'altra email-->
            <a href="logout.php">Logout</a>
            <a href="carrello.php">Carrello Acquisti</a>
        </div>
        <?php
        if(isset($_SESSION["acquisto"])){
            $messaggio = "Il carrello è stato svuotato e i prodotti sono stati acquistati correttamente!!";
            echo "<p class=\"successo\">".$messaggio."</p>";
            unset($_SESSION["acquisto"]);
        }
        ?>
        <div class="messaggio">Accesso eseguito come: <?php echo $_SESSION["nome_utente"];?></div>
        <form action="carrello.php" method="get" id="form1" name="form1" onsubmit="return validateForm('form1');">
            <!--per controllare che la pagina contenga solo gli eventi che non sono già passati posso utilizzare javascript, utilizzo un file js
            dove controllo la data che ho inserito manualmente e la confronto con quella attuale (guardo la data presente nel server utilizzando
            l'array Date())-->
            <div class="contenitore">
                <h1>Eventi disponibili per l'acquisto</h1>
                <!--ho creato una cartella che contiene tutte le immagini del sito, utilizzando la notazione ./immagini passo dalla 
                casella padre a quella immagini, dentro alla casella immagini vado poi a cercare l'immagine che voglio inserire-->
                <div class="evento">
                    <!--utilizzo h2 per creare il nuovo titolo (non posso usare h3 o h4 etc...)--> <!--non mi fa aggiungere h2, non me lo contiene dentro altrimenti-->
                    <h2>AC/DC Power Up Festival</h2>
                    <img src="./immagini/evento_1.png" alt="Evento 1, caricamento immagine">
                    <span class="descrizione">In data 25 maggio 2024 si terrà un concerto degli AC/DC, una band leggendaria nel panorama 
                        del rock internazionale. L'evento promette di essere un'esperienza emozionante per i fan della band e gli amanti
                        della musica rock in generale. Durante il concerto, la band eseguirà una selezione dei suoi brani più iconici, 
                        offrendo agli spettatori un'esperienza musicale memorabile. La combinazione della potente voce del cantante, il ritmo
                        incalzante delle chitarre e la batteria energica creerà un'atmosfera coinvolgente e carica di energia. Gli spettatori
                        avranno l'opportunità di immergersi nell'universo sonoro degli AC/DC e di godere di un'esperienza live
                        indimenticabile.</span>
                        <span class="contatore">
                            <input type = "button" id="decrementa1" class="contatore" value="-" onclick="decrementValue('form1', -59.9, 'tot1');">
                            <input type="text" id="counter1" name="counter1" value="0" readonly>
                            <input type = "button" id="incrementa1" class="contatore" value="+" onclick="incrementValue('form1', 59.9, 'tot1');">
                            <span class="costoBiglietto">Costo del biglietto: 59.90€</span>
                        </span>
                        <div class="costoTotale">Il costo totale dei biglietti selezionati per questo evento &egrave;: <output id="tot1" name="tot1">0</output> €</div>     
                        <!--inserisco la data dei biglietti facendola visualizzare all'utente, la vendita del biglietto chiude però in un altro orario-->         
                        <time datetime="2024-05-25T12:00" class="scadenza">Data concerto: 2024-05-25 18:00</time>
                    </div>
                <div class="evento">
                    <h2>Max Forever, Fanta Event</h2>
                    <img src="./immagini/evento_2.jpg" alt="Evento 2, caricamento immagine">
                    <span class="descrizione">
                        Max Pezzali sta per regalare un'esperienza unica ai suoi fan con un concerto solista imperdibile in un'arena cittadina!
                        Preparati a vivere un'emozione senza pari, mentre Max si esibisce sul palco da solo, senza alcun filtro, 
                        mostrando tutta la sua autenticità e il suo incredibile talento. Sarà un'opportunità unica per ascoltare i 
                        suoi successi più amati in un contesto intimo e coinvolgente, con la voce potente di Max che ti avvolgerà e 
                        ti emozionerà come mai prima d'ora. Non perdere l'occasione di essere parte di questo evento indimenticabile! 
                        Acquista subito il tuo biglietto e preparati a vivere una serata che rimarrà impressa nella tua memoria per sempre!
                    </span>
                    <span class="contatore">
                        <input type = "button" name="decrementa2" class="contatore" value="-" onclick="decrementValue('form1','counter2', -39.9 , 'tot2');">
                        <input type="text" id="counter2" name="counter2" value="0" readonly>
                        <input type = "button" name="incrementa2" class="contatore" value="+" onclick="incrementValue('form1','counter2', 39.9 , 'tot2');">
                        <span class="costoBiglietto">Costo del biglietto: 39.90€</span>
                    </span>
                    <div class="costoTotale">Il costo totale dei biglietti selezionati per questo evento &egrave;: <output id="tot2" name="tot2">0</output> €</div>
                    <time datetime="2024-07-18T12:00" class="scadenza">Data concerto: 18 luglio 2024, ore: 21:00</time>
                </div>
                <div class="evento">
                    <h2>Hello World, Pinguini Tattici Nucleari</h2>
                    <img src="./immagini/evento_3.jpg" alt="Evento 3, caricamento immagine">
                    <span class="descrizione">
                        Questo attesissimo evento porterà la combinazione unica di sonorità elettroniche, orchestrali e influenze da videogiochi 
                        che solo i Pinguini Tattici sanno offrire. Con un mix di emozioni avventurose e atmosfere futuristiche, il concerto 
                        promette di trasportare il pubblico in un viaggio sonoro indimenticabile. Alle 20:00 in punto, le luci si abbasseranno 
                        e la musica prenderà il sopravvento, dando il via a un'esperienza straordinaria. I Pinguini Tattici si esibiranno in 
                        una selezione dei loro brani più celebri, accompagnati da uno spettacolo visivo mozzafiato e luci dinamiche che 
                        trasformeranno Piazza del Popolo in un ambiente magico e surreale. Ma il momento più atteso della serata sarà 
                        sicuramente l'esclusiva presentazione del loro nuovo singolo, "Hello World". Con il suo ritmo coinvolgente e le melodie 
                        accattivanti, questa canzone promette di essere il punto culminante del concerto, scatenando l'entusiasmo dei fan e 
                        conquistando nuovi seguaci con la sua freschezza e originalità.
                    </span>
                    <span class="contatore">
                        <input type = "button" name="decrementa3" class="contatore" value="-" onclick="decrementValue('form1','counter3', -40.9 , 'tot3');">
                        <input type="text" id="counter3" name="counter3" value="0" readonly>
                        <input type = "button" name="incrementa3" class="contatore" value="+" onclick="incrementValue('form1','counter3', 40.9, 'tot3');">
                        <span class="costoBiglietto">Costo del biglietto: 40.90€</span>
                    </span>
                    <div class="costoTotale">Il costo totale dei biglietti selezionati per questo evento &egrave;: <output id="tot3" name="tot3">0</output> €</div>
                    <time datetime="2024-12-30T12:00" class="scadenza">Data concerto: 30 dicembre 2024, ore: 20:00</time>
                </div>
                <div class="evento">
                    <h2>THE SAVIORS TOUR, Green Days</h2>
                    <img src="./immagini/evento_4.jpg" alt="Evento 4, caricamento immagine">
                    <span class="descrizione">
                        Lo spirito ribelle dei Green Days prenderà vita sul palco mentre la band eseguirà una selezione dei loro più grandi 
                        successi, da "American Idiot" a "Revolution Radio", infiammando il pubblico con le loro potenti liriche e le loro melodie 
                        coinvolgenti. Ma non si tratta solo di musica: "Green Days Live" sarà un'occasione per unire le persone e promuovere il cambiamento 
                        positivo. Gli stand saranno allestiti con organizzazioni attiviste e associazioni che condivideranno informazioni sulle questioni 
                        sociali e ambientali, invitando il pubblico a prendere parte alla rivoluzione per un mondo migliore.
                    </span>
                    <span class="contatore">
                        <input type = "button" id="decrementa4" class="contatore" value="-" onclick="decrementValue('form1','counter4', -57.9, 'tot4');">
                        <input type="text" id="counter4" name="counter4" value="0" readonly>
                        <input type = "button" id="incrementa4" class="contatore" value="+" onclick="incrementValue('form1','counter4', 57.9 , 'tot4');">
                        <span class="costoBiglietto">Costo del biglietto: 57.90€</span>
                    </span>
                    <div class="costoTotale">Il costo totale dei biglietti selezionati per questo evento &egrave;: <output id="tot4" name="tot4">0</output> €</div>
                    <time datetime="2024-06-16T12:00" class="scadenza">Data concerto: 16 giugno 2024, ore: 15:00</time>


                </div>

                <div class="evento">
                    <h2>The Dark Side of The Moon, Pink Floyd</h2>
                    <img src="./immagini/evento_5.jpg" alt="Evento 5, caricamento immagine">
                    <span class="descrizione">
                        Dopo anni di attesa e speculazioni, i membri originali dei Pink Floyd annunciano una reunion 
                        per un evento unico nel suo genere: "Echoes Revived". L'evento vedrà la partecipazione di Roger Waters, David Gilmour, 
                        Nick Mason e Richard Wright (attraverso l'uso di tecnologie avanzate per ricreare la sua presenza), riuniti sullo 
                        stesso palco per la prima volta dopo molti anni. Questa sarà un'occasione straordinaria per i fan di tutte le 
                        generazioni di vivere l'esperienza unica dei Pink Floyd. Il concerto sarà un viaggio attraverso i più grandi successi 
                        della band, con particolare enfasi sull'album "The Dark Side of the Moon", "Wish You Were Here", "Animals" e, 
                        naturalmente, "The Wall". La performance sarà arricchita da spettacolari effetti visivi, proiezioni mozzafiato e luci 
                        psichedeliche, tutto ciò che ha reso i Pink Floyd famosi per le loro straordinarie esibizioni dal vivo.
                        Inoltre, l'evento includerà collaborazioni speciali con artisti ospiti che si esibiranno insieme alla band, rendendo 
                        questa reunion ancora più memorabile.
                    </span>
                    <span class="contatore">
                        <input type = "button" id="decrementa5" class="contatore" value="-" onclick="decrementValue('form1', 'counter5', -87, 'tot5');">
                        <input type="text" id="counter5" name="counter5" value="0" readonly>
                        <input type = "button" id="incrementa5" class="contatore" value="+" onclick="incrementValue('form1', 'counter5', 87 , 'tot5');">
                        <span class="costoBiglietto">Costo del biglietto: 87.00€</span>
                        <!--in questo caso utilizzo una casella di testo div, quando invece 
                        farò il prossimo progetto posso provare con output--> <!--per prendere il valore in php penso funzioni solamente con output-->
                    </span>
                    <div class="costoTotale">Il costo totale dei biglietti selezionati per questo evento &egrave;: <output id="tot5" name="tot5">0</output> €</div>
                    <time datetime="2025-01-24T12:00" class="scadenza">Data concerto: 24 gennaio 2025, ore 12:00</time>
                </div>
                <!--usare questo evento per testare se è già scaduto la visualizzazione. Inserire quindi un evento passato e confrontare poi la
                data con la data del server-->
                <div class="evento">
                    <img src="./immagini/evento_6.jpeg" alt="Evento 6, caricamento immagine">
                    <span class="descrizione">
                        Il concerto inizia con un'esplosione di fuochi d'artificio nel cielo notturno, mentre sul palco compare Katy Perry, 
                        circondata da ballerini e un'orchestra dal vivo. Indossa un abito scintillante che brilla di luce propria. La sua 
                        performance è un mix travolgente di hit pop che tutti conoscono e adorano. Dai classici come "Firework" e "Roar" alle 
                        nuove canzoni che fanno ballare tutti. Ogni canzone è accompagnata da coreografie mozzafiato e cambi di costume 
                        sorprendenti.
                    </span>
                    <span class="contatore">
                        <input type = "button" id="decrementa6" class="contatore"  value="-" onclick="decrementValue('form1', 'counter6', -230 , 'tot6');">
                        <input type="text" id="counter6" name="counter6" value="0" readonly>
                        <input type = "button" id="incrementa6" class="contatore" value="+" onclick="incrementValue('form1', 'counter6', 230, 'tot6');">
                        <span class="costoBiglietto">Costo del biglietto: 230.00€</span>
                    </span>
                    <div class="costoTotale">Il costo totale dei biglietti selezionati per questo evento &egrave;: <output id="tot6" name="tot6">0</output> €</div>
                    <time datetime="2020-06-02T12:00" class="scadenza">Data concerto: 2020-06-02 12:00</time>
                </div>
                <!--si poteva anche utilizzare il comando onload di javascript (quando la pagina è caricata mi lancia la funzione controllaDataEventi)
                ma questo metodo mi sembra anche corretto-->
                <script>controllaDataEventi();</script>
            </div>
            <!--Controllo che nel carrello venga inserito almento un oggetto, altrimenti avvisa l'utente di 
            aggiungere almeno un elemento al carrello all'acquisto-->
            <div class="bottoniFinali">
                <input type="submit" name="carrello" id="carrello" value="aggiungi al carrello">
                <input type="reset" name="cancella" id="cancella" value="cancella">
            </div>
        </form>
    </body>
</html>
<?php
    }
?>
