//ricevo l'id del form e controllo che i dati inseriti siano corretti, ad esempio che il nome non sia troppo corto, 
//che la mail sia valida (anche se un primo controllo dovrebbe esser
// già stato effettuato da input type email) ... 
"use strict";
function validateForm(f1){
    let email = document.getElementById(f1).email.value;
    let password = document.getElementById(f1).pwrd.value;
    if (email != "" && pswrd != ""){
        console.log("valori inseriti correttamente, necessario solo controllare che l'email rispetti lo stile");
        let regexp_email = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if(regexp_email.test(email)){
            console.log("anche l'email è stata inserita corretamente ed è: ", email);
            return true;
        }else{
            window.alert("i valori inseriti nel campo email non sono corretti!");
            return false;
        }
    }else{
        // Se un campo obbligatorio non è stato compilato, visualizza un messaggio di errore distinto per ogni tipo di "errore"
        if (pswrd === "") {
            window.alert("Per favore, inserisci la password.");
        } else if (email === "") {
            window.alert("Per favore, inserisci la tua email.");
        }
        return false;
    }
}
function openSubscription(){
    //utilizzo questo comando per reindirizzare la pagina HTML dalla pagina accedi alla pagina di registrazione
    window.location.href = 'registrazione.php';
}