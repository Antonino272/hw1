//funzione che controlla se tutte le credenziali sono inserite 
function controlloCredenziali(event){
    if(form.user.value==="" || form.password.value===""){
        alert("INSERIRE TUTTE LE CREDENZIALI CORRETTAMENTE");
        event.preventDefault();
    }
}

// chiamo la funzione 
const form=document.querySelector("#form");
form.addEventListener("submit",controlloCredenziali);