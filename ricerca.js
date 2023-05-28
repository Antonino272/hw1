document.addEventListener("DOMContentLoaded", function() {
  document.querySelector("form").addEventListener("submit", function(event) {
    event.preventDefault();
    const searchTerm = document.querySelector(".searchBar").value;
    searchItem(searchTerm);
  });
});

function onResponse(response) {
  console.log(response);
  return response.json();
}

function searchItem(searchTerm) {
  const risultatiDiv = document.getElementById("results");
  risultatiDiv.innerHTML = "";

  if (searchTerm.trim() === "") {
    const noResultsElement = document.createElement("p");
    noResultsElement.setAttribute("id", "no-results-message");
    noResultsElement.textContent = "Non hai cercato nessun campione.";
    risultatiDiv.appendChild(noResultsElement);
    return;
  }

  function onJson(json) {
    const results = json.filter(function(item) {
      return (
        item.Nome.toLowerCase().includes(searchTerm.toLowerCase()) ||
        item.Titolo.toLowerCase().includes(searchTerm.toLowerCase())
      );
    });

    if (results.length > 0) {
      results.forEach(function(item) {
        const container = document.createElement("div");
        container.classList.add("risultato");

        const nome = document.createElement("h1");
        nome.textContent = item.Nome;

        const titolo = document.createElement("p");
        titolo.textContent = item.Titolo;

        const img = document.createElement("img");
        img.src = item.Copertina;
      
        container.appendChild(img);
        container.appendChild(nome);
        container.appendChild(titolo);

        const preferiti = document.createElement("button");
        preferiti.classList.add("preferiti");

        if (item.preferiti === true) {
          preferiti.textContent = "Rimuovi dai preferiti";
          preferiti.addEventListener('click', rimuoviPreferiti);
        } else {
          preferiti.textContent = "Aggiungi ai preferiti";
          preferiti.addEventListener('click', aggiungiPreferiti);
        }

        container.appendChild(preferiti);
        risultatiDiv.appendChild(container);
      });
    } else {
      const noResultsElement = document.createElement("p");
      noResultsElement.setAttribute("id", "no-results-message");
      noResultsElement.textContent = "Nessun Campione trovato.";
      risultatiDiv.appendChild(noResultsElement);
    }
  }

  fetch("apihome.php")
    .then(onResponse)
    .then(onJson);
}


