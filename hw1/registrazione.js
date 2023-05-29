function JsonEmail(json)
{
    if(formStatus.email = !json.exists)
    {
    document.querySelector("#emailBox").classList.remove("errorj");
    document.querySelector("#submit").disabled = true;
    }
    else
    {
        document.querySelector("#emailBox .error").textContent ="Email già utilizzata";
        document.querySelector("#emailBox").classList.add("errorj");
    }
   checkForm();
}
function checkEmail(event)
{
    const emailInput = event.currentTarget;
    if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(emailInput.value).toLowerCase())) {
        emailInput.parentNode.querySelector('#emailBox .error').textContent = "Email non valida";
        emailInput.parentNode.classList.add('errorj');
        formStatus.email = false;

    } else
     {
        fetch("Checkemail.php?q="+encodeURIComponent(String(emailInput.value).toLowerCase())).then(fetchReponse).then(JsonEmail);
    }
}
function JsonUsername(json)
{
    if(formStatus.username = !json.exists)
    {
    document.querySelector("#userBox").classList.remove("errorj");
    document.querySelector("#submit").disabled = true;
    }
    else
    {
        document.querySelector("#userBox .error").textContent ="Username già utilizzato";
       document.querySelector("#userBox").classList.add("errorj");
    }
   checkForm();
}
function fetchReponse(response)
{
        if (!response.ok) return null;
        return response.json();
}

function checkUsername(event)
{
    const input=event.currentTarget;
    if(!/^[a-zA-Z0-9_]{5,15}$/.test(input.value))
    {
        input.parentNode.querySelector("#userBox .error").textContent=
        "Sono ammesse lettere,numeri e underscore,minimo 15";
        input.parentNode.classList.add("errorj");
        formStatus.username=false;
        checkForm();
    }
    else
    {
        fetch("Checkusername.php?q="+encodeURIComponent(input.value)).then(fetchReponse).then(JsonUsername);
    }
}
function checkPassword(event)
{
    const input= event.currentTarget;
    const pattern=/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[_.\-()?#;:!@])[0-9A-Za-z_.\-()?#;:!@]{8,20}$/;
    if(!pattern.test(input.value))
    {
        input.parentNode.querySelector("#passBox .error").textContent="Inserisci una password valida";
        input.parentNode.classList.add("errorj");
        formStatus.pass=false;
    }
    else
    {
        formStatus.pass=true;
        input.parentNode.classList.remove("errorj");
    }
    checkForm();
}
function checkName(event)
{
    const input= event.currentTarget;
    if(input.value.length == 0)
    {
        input.parentNode.querySelector("#nameBox .error").textContent="Inserisci un nome";
        input.parentNode.classList.add("errorj");
        formStatus.nome=false;

    }else
    {
        formStatus.nome=true;
        input.parentNode.classList.remove("errorj");
    }
checkForm();
}
function checkCognome(event)
{
    const input= event.currentTarget;
    if(input.value.length == 0)
    {
        input.parentNode.querySelector("#surnameBox .error").textContent="Inserisci un cognome";
        input.parentNode.classList.add("errorj");
        formStatus.cognome=false;

    }else
    {
        formStatus.cognome=true;
        input.parentNode.classList.remove("errorj");
    } 
checkForm();
}
function checkForm() {
    console.log(formStatus);
    // Controlla che tutti i campi siano pieni
    if (
      Object.keys(formStatus).length === 5 &&
      !Object.values(formStatus).includes(false)
    ) {
      document.querySelector("#submit").disabled = false;
    } else {
      document.querySelector("#submit").disabled = true;
    }
  }

const formStatus = {};
document.querySelector(".inputBox #nome").addEventListener("blur",checkName);
document.querySelector(".inputBox #cognome").addEventListener("blur",checkCognome);
document.querySelector(".inputBox #pass").addEventListener("blur",checkPassword);
document.querySelector(".inputBox #username").addEventListener("blur",checkUsername);
document.querySelector(".inputBox #email").addEventListener("blur",checkEmail);
