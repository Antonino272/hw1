

fetch("ApiHome.php")
.then(onResponse).then(onJson);



function onResponse(response) {
    console.log(response);
    return response.json();
}

    function onJson (json) {
        console.log(json);
        const elenco_champ = document.querySelector('#mostra_champ');
        elenco_champ.innerHTML = "";
        //selezione casualmente 9 champ dal json
        const randomChamp=getRandomChamps(json,9);

        for (let result of randomChamp) {
            const container = document.createElement('div');
            const containerTesto = document.createElement('div');
            const img = document.createElement('img');
            const nome = document.createElement('h1');
            const titolo = document.createElement('p');

            nome.textContent = result.Nome;
            img.src = result.Copertina;
            titolo.textContent=result.Titolo;

            container.appendChild(img);
            containerTesto.appendChild(titolo);
            containerTesto.appendChild(nome);
            container.appendChild(containerTesto);

            const preferiti=document.createElement("button");
            preferiti.classList.add("preferiti"); 
    
            if(result.preferiti==true){
                preferiti.textContent="Rimuovi dai preferiti";
                preferiti .addEventListener('click',rimuoviPreferiti);
    
            }else{
                preferiti.textContent="Aggiungi ai preferiti";
                preferiti .addEventListener('click',aggiungiPreferiti);
            }
    
            container.appendChild(preferiti);

            

            elenco_champ.appendChild(container);
        }
    }
    //funzione per selezionare casualmente un numero specifico di campioni
    function getRandomChamps(arr,count){
        const shuffled=arr.sort(() => 0.5 - Math.random());
        return shuffled.slice(0,count);
    }
    
    





  
 
                                                                               