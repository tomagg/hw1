function RimuoviCarrello(event)
{
    const e=event.currentTarget
    const box=e.parentNode;
    const newform= new FormData();
    newform.append('id',event.currentTarget.dataset.id);
   fetch ("EliminaAcquisti.php", { method: 'post', body: newform }).then(EliminaImmagine(box));
}
function EliminaImmagine(box)
{
    box.remove("div");
}

function OnJson(json)
{
    console.log("Json ottenuto del carica acquisti");
    console.log(json);
    const lista=document.querySelector("#lista_carrello");
    for(let i=0;i<json.length;i++)
    {
        const div = document.createElement("div");
        const img = document.createElement("img");
        const descrizione = document.createElement("h1");
        const prezzo = document.createElement("p");
        const tasto=document.createElement("a");
       
        
        
        
        img.src=json[i].content.img;
        descrizione.textContent=json[i].content.descrizione;
        prezzo.textContent=json[i].content.tipologia+":"+json[i].content.prezzo+"€";
        tasto.dataset.id=json[i].codice_acquisto;
        tasto.textContent="Rimuovi dal carrello";
        tasto.addEventListener("click",RimuoviCarrello);
        
        div.classList.add("container");
        tasto.classList.add("bottone");
        prezzo.classList.add("prezzo");
        descrizione.classList.add("titolo");

        lista.appendChild(div);
        div.appendChild(img);
        div.appendChild(descrizione);
        div.appendChild(prezzo);
        div.appendChild(tasto);

    }
}
function OnResponse(response)
{
    console.log("Response per caricamento carrello ottenuto")
    return response.json();
}
//facciamo la fetch per caricare gli elementi pesenti nel carrello dinamicamente


    fetch("CaricaAcquisti.php").then(OnResponse).then(OnJson);


