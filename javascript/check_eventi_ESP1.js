"use strict";
function controllaDataEventi() {
    //in questo modo mi prendo la data di oggi, utilizzando l'array/oggetto  Date()
    let oggi = new Date();

    //mi seleziona gli eventi dichiarati nella classe evento (mi crea un array)
    let eventi = document.getElementsByClassName("evento");
    /*console.log("l'evento preso in considerazione è: "+eventi);
    for (var i = 0; i < eventi.length; i++) {
        console.log(eventi[i])
    }*/
    //creo un ciclo for per controllare ogni singolo evento, eliminando quelli che sono già "scaduti"
    for (let i = 0; i < eventi.length; i++) {
        //Funzione che prende il valore utilizzato nel tag, e successivamente mi prende il valore dell'attributo "datetime" 
        //presente nel tage time.
        /*
        console.log("valore preso in considerazione: "+eventi[i].getElementsByTagName("datetime")[0])
        */
        let dataEventoString = eventi[i].getElementsByTagName("time")[0].getAttribute("datetime");
 
        let dataEvento = new Date(dataEventoString); //--> mi trasformo l'evento nella stringa per poterlo confrontare con la data di oggi 

        if (dataEvento < oggi) {
            // Se la data dell'evento è passata, nascondo l'evento
            //avessi utilizzato display = hidden lo spazio sarebbe ancora occupato nella pagina, in questo caso invece non viene occupato
            eventi[i].style.display = "none";
        }
    }
}
function incrementValue(f1, idCounter, valore, totalId){
    const fo1 = document.getElementById(f1);
    /*console.log(idCounter);*/
    let counterElem = document.getElementById(idCounter);
    let counter = parseInt(counterElem.value);
    counterElem.value = counter + 1;
    let increment = parseFloat(valore);
    let totalOutput = document.getElementById(totalId);
    //uso la funzione toFixed() per arrotondare il valore ed evitare che mi dia risultati con troppe cifre decimali
    totalOutput.value = parseFloat(parseFloat(counterElem.value) * parseFloat(increment)).toFixed(2);
    
}
function decrementValue(f1, idCounter, valore, totalId){
    /*inserisco il controllo che decremento solo se il numero è maggiore di uno, in quanto non avrebbe comprare -1 biglietti...*/ 
    if(document.getElementById(idCounter).value == 0){
        /*volendo si può aggiungere un avvertimento all'utente*/
        /*window.alert("non puoi rimuovere altri biglietti in quanto il valore non può essere negativo") */
        return
    }
    /*utilizzo le variabili dichiarate come let in quanto più consistenti rispetto alle var*/
    let counter = document.getElementById(idCounter).value;
    /*
    console.log(document.getElementById(idCounter).value);
    */
    document.getElementById(idCounter).value = parseInt(counter) - 1;
    let decrement = parseFloat(valore);
    let totalOutput = document.getElementById(totalId);
    totalOutput.value = (parseFloat(document.getElementById(idCounter).value) * (-1) * decrement).toFixed(2);
}

function validateForm(f1){
    const form = document.getElementById(f1);
    let somma = 0;
    /*utilizzo la grandezza di eventi per capire quanti ne sono stati creati, in questo modo posso creare un contatore*/
    let eventi = document.getElementsByClassName("evento");
    //creo un contatore che mi guarda quanti biglietti ha acquistato il cliente, se questa è uguale a zero mando il messaggio di errore 
    //dicendo che deve selezionare almeno un biglietto da acquistare
    for(let i=1; i<eventi.length; i++){
        somma += parseInt(document.getElementById("counter"+i).value);
    }
    /*console.log(somma);*/
    if(somma == 0){
        window.alert("Bisogna selezionare almeno un articolo");
        return false;
    }else{
        return true;
    }
}
