function EliminaRecensione(event)
{
    const newform= new FormData();
    newform.append('id',event.currentTarget.dataset.id_recensione);
   fetch ("EliminaRecensione.php", { method: 'post', body: newform }).then(AggiornaListaRecensioni);
}
function ResponseAggiunta(response)
{
  console.log("Evento aggiunto");
  AggiornaListaRecensioni();
}
function AggiungiRecensione(event)
{
    
    const form = event.currentTarget;
    const form_data = {method: 'post', body: new FormData(form)};
    fetch("AggiungiRecensione.php", form_data).then(ResponseAggiunta);
    event.preventDefault();
}
function ONJson(json)
{
   console.log("Json get ricevuto");
   console.log(json);
   const lista=document.querySelector("#lista_recensioni");
   lista.innerHTML="";
   for(let i=0;i<json.length;i++)
   {
    const div=document.createElement("div");
    const commento=document.createElement("h2");
    const recensione=document.createElement("p");
    commento.textContent="L'UTENTE CON ID:"+json[i].id_utente
    recensione.textContent="SCRIVE:"+json[i].descrizione;
    const elimina=document.createElement("a");
    elimina.href='#';
    elimina.dataset.id_recensione=json[i].id_recenisone;
    elimina.textContent="DELETE";
    elimina.addEventListener("click",EliminaRecensione);

    div.classList.add("container");
    commento.classList.add("introduzione");
    recensione.classList.add("descrizione");

    lista.appendChild(div);
    div.appendChild(commento);
    div.appendChild(recensione);
    div.appendChild(elimina);

   }
}

function ResponseGet (response)
{
  return response.json();
}
function AggiornaListaRecensioni()
{
    fetch("GetRecensione.php").then(ResponseGet).then(ONJson)
}


AggiornaListaRecensioni();

document.querySelector("form").addEventListener("submit",AggiungiRecensione);
