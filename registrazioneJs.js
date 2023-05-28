
const errore={
    "nome":false,
    "cognome":false,
    "email":false,
    "userId":false,
    "password":false,
    "Confermapassword":false
};

// funzione che controlla che i campi del form siano riempiti

function controlloValori(event){

    if(form.nome.value===""||form.cognome.value===""||form.email.value===""||form.IDuser.value===""||form.password.value===""||form.ConfermaPassword.value===""){
        alert(" COMPILA TUTTI I CAMPI");
        event.preventDefault();
    }else{
        var erroreValori=false;
        for(let element in errore){
            if(errore[element]===true){
                erroreValori=true;
            }
        }
        if(erroreValori===true){
            event.preventDefault();
        }
    }
}

//funzione che controlla che l'username ha solo caratteri e numeri
function checkUserId(event){
    
    if(!/^[a-zA-Z0-9_]{1,15}$/.test(inputID.value)){
        const erroreUser=document.querySelector("#erroreUser");
        erroreUser.textContent="Sono ammessi solo caratteri e numeri";
        erroreUser.classList.add("errore");
        inputID.classList.add("erroreInput");
        errore["userId"]=true;
    }
    else{
        //se non ci sono errori nella digitazione, controllo che l'username non è gia in uso, con la fetch al database
        errore.userId=false;
      fetch("controllo_username.php?q="+encodeURIComponent(inputID.value)).then(onResponse).then(checkUserJson); 
    }

}

function onResponse(response){
    return response.json();
}

//funzione in cui verifico che effettivamente non sia in uso l'username e quindi 'presente'=>true, altrimenti faccio apparire gli errori, prima che l'utente passi a compilare un altro campo
function checkUserJson(json){
    
    const erroreUser=document.querySelector("#erroreUser");
    if(json.presente!= false){
        
        erroreUser.textContent="username gia in uso";
        erroreUser.classList.add("errore");
        inputID.classList.add("erroreInput");
        errore.userId=true;
    }
    else{
        errore.userId=false;
        erroreUser.textContent="";
        erroreUser.classList.remove("errore");
        inputID.classList.remove("erroreInput");
    }
}

//stesso discorso di prima per l'username, ma stavolta per l'email

function checkEmail(event){
    if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(inputEmail.value)){
        const erroreEmail=document.querySelector("#erroreEmail");
        erroreEmail.textContent="formato email non valido";
        erroreEmail.classList.add("errore");
        inputEmail.classList.add("erroreInput");
        errore.email=true;

    }
    else{
        errore.email=false;
        fetch("controllo_email.php?q="+encodeURIComponent(inputEmail.value)).then(onResponse).then(checkEmailJson);
      }


}
// se è gia in uso, anche qui faccio apparire subito l'errore prima che si arrivi al submit del form
function checkEmailJson(json){
    
    const erroreEmail=document.querySelector("#erroreEmail");

    if(json.presente!= false){
        errore.email=true;
        erroreEmail.textContent=" email  gia in uso";
        erroreEmail.classList.add("errore");
        inputEmail.classList.add("erroreInput");
    }
    else{
        errore.email=false;
        erroreEmail.textContent="";
        erroreEmail.classList.remove("errore");
        inputEmail.classList.remove("erroreInput");
    }
}

//funzione che controlla l'inserimento del nome correttamente, e se si prova a passare avanti nella compilazione, ci avvisa che il campo è obbligatorio immediatamente
function checkNome(event){
    const erroreNome=document.querySelector("#erroreNome");
    if(inputNome.value==""){
        erroreNome.textContent="Campo obbligatorio";
        erroreNome.classList.add("errore");
        inputNome.classList.add("erroreInput");
        errore.nome=true;
    }
    else if(!/^[a-zA-Z ]*$/.test(inputNome.value)){
        const erroreNome=document.querySelector("#erroreNome");
        erroreNome.textContent="inserire solo lettere";
        erroreNome.classList.add("errore");
        inputNome.classList.add("erroreInput");
        errore.nome=true;
    }
    else{
        errore.nome=false;
        erroreNome.textContent="";
        erroreNome.classList.remove("errore");
        inputNome.classList.remove("erroreInput");
    }
}

//idem per il cognome

function checkCognome(event){
    const erroreCognome=document.querySelector("#erroreCognome");
    if(inputCognome.value==""){
        erroreCognome.textContent="Campo obbligatorio";
        erroreCognome.classList.add("errore");
        inputCognome.classList.add("erroreInput");
        errore.cognome=true;
    }
    else if(!/^[a-zA-Z ]*$/.test(inputCognome.value)){
        const erroreCognome=document.querySelector("#erroreCognome");
        erroreCognome.textContent="inserire solo lettere";
        erroreCognome.classList.add("errore");
        inputCognome.classList.add("erroreInput");
        errore.cognome=true;
    }
    else{
        errore.cognome=false;
        erroreCognome.textContent="";
        erroreCognome.classList.remove("errore");
        inputCognome.classList.remove("erroreInput");
    }
}


function checkPassword(event){
    const errorePassword=document.querySelector("#errorePassword");
    
    if(inputPassword.value==""){
        errorePassword.textContent="Campo obbligatorio";
        errorePassword.classList.add("errore");
        inputPassword.classList.add("erroreInput");
        errore.password=true;
    }
    else if(inputPassword.value.length <8){
        errorePassword.textContent="la lunghezza minima è di almeno 8 caratteri";
        errorePassword.classList.add("errore");
        inputPassword.classList.add("erroreInput");
        errore.password=true;
    }
    //se i controlli vanno bene posso procedere con il controllo su 'ConfermaPassword'
    else{
        errorePassword.textContent="";
        errorePassword.classList.remove("errore");
        inputPassword.classList.remove("erroreInput");
        errore.password=false;;
        checkConfermaPass();
        
    }
}


function checkConfermaPass(event){
    const erroreConferma=document.querySelector("#erroreConferma");
    
    if(inputConferma.value==""){
        errore.Confermapassword=true;
        
    }
    //controllo che la password inserita e confermata siano uguali, altrimenti do l'errore subito
    else if(inputPassword.value!=inputConferma.value){
        errore.Confermapassword=true;
        erroreConferma.textContent="Le password non coincidono";
        erroreConferma.classList.add("errore");
        inputConferma.classList.add("erroreInput");
    }
    else{
        errore.Confermapassword=false;
        erroreConferma.textContent="";
        erroreConferma.classList.remove("errore");
        inputConferma.classList.remove("erroreInput");
    }
}

//richiamo le funzioni agli eventi
const form=document.querySelector("#form");
form.addEventListener("submit",controlloValori);

const inputID=document.querySelector("#inputID");
inputID.addEventListener('blur',checkUserId);
const inputEmail=document.querySelector("#inputEmail");
inputEmail.addEventListener('blur',checkEmail);
const inputNome=document.querySelector("#inputNome");
inputNome.addEventListener('blur',checkNome);
const inputCognome=document.querySelector("#inputCognome");
inputCognome.addEventListener('blur',checkCognome);
const inputPassword=document.querySelector("#inputPassword");
inputPassword.addEventListener('blur',checkPassword);
const inputConferma=document.querySelector("#inputConfermaPass");
inputConferma.addEventListener('blur',checkConfermaPass);












