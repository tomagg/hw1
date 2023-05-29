function OnJsonCarrello(json)
{
    console.log("Json carrello ottenuto");
    console.log(json);
}
function ResponseCarrello(response)
{
    return response.json();
}
function AggiungiCarrello(event)
{
    console.log("Listener ricevuto\n");
    //preparo i dati da mandare al server
    const div= event.currentTarget.parentNode;
    const formData=new FormData();
    formData.append('id',div.dataset.id);
    formData.append('img',div.dataset.img);
    formData.append('descrizione',div.dataset.descrizione);
    formData.append('tipologia',div.dataset.tipologia);
    formData.append('prezzo',div.dataset.prezzo);
    fetch("AggiungiCarrello.php",{method:'post',body: formData}).then(ResponseCarrello).then(OnJsonCarrello);
    event.stopPropagation();
}

function OnJson(json)
{
    console.log(json);
    const lista=document.querySelector('#lista');
    for(let i=0;i<json.length;i++)
    {
        const div = document.createElement("div");
        div.dataset.id=json[i].id;
        div.dataset.img=json[i].img;
        div.dataset.descrizione=json[i].descrizione;
        div.dataset.tipologia=json[i].tipologia;
        div.dataset.prezzo=json[i].prezzo;
        
        const img = document.createElement("img");
        const descrizione = document.createElement("h1");
        const prezzo = document.createElement("p");
        const tasto=document.createElement("a");
       
        
        
        
        img.src=json[i].img;
        descrizione.textContent=json[i].descrizione;
        prezzo.textContent=json[i].tipologia+":"+json[i].prezzo+"€";
        tasto.textContent="Aggiungi al carrello";
        //poi aggiungere ad event listener alla funzione aggiungicarrello
        tasto.addEventListener("click",AggiungiCarrello);
        
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
    return response.json();
}


//eseguiamo subito la fetch per caricare gli elementi dinamicamente
fetch("CaricaProdotti.php").then(OnResponse).then(OnJson);