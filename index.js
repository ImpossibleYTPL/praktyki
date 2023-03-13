var error = true;

const hiddens = document.querySelectorAll("input[type=hidden]");
const data = new Date();

hiddens[0].value = data.getDate() + "-" + (data.getMonth() + 1) + "-" + data.getFullYear();
hiddens[1].value = data.getHours() + ":" + data.getMinutes() + ":" + data.getSeconds();

const switchElement = document.getElementById("flexSwitchCheckDefaultKandydat");
const switchElementMatki = document.getElementById("flexSwitchCheckDefaultMatka");
const switchElementOjca = document.getElementById("flexSwitchCheckDefaultOjca");
const switchElementOpiekuna = document.getElementById("flexSwitchCheckDefaultOpiekuna");

const nazwisko = document.querySelector("input[name=Nazwisko]");
const imie = document.querySelector("input[name=Imie]");
const drugieImie = document.querySelector("input[name=DrugieImie]");
const dataUrodzenia = document.querySelector("input[name=DataUrodzenia]");
const MiejsceUrodzenia = document.querySelector("input[name=MiejsceUrodzenia]");
const pesel = document.querySelector("input[name=Pesel]");
const numerTelefonu = document.querySelector("input[name=NumerTelefonu]");
const mail = document.querySelector("input[name=Mail]");

const nazwiskoMatki = document.querySelector("input[name=NazwiskoMatki]");
const imieMatki = document.querySelector("input[name=ImieMatki]");
const numerTelefonuMatki = document.querySelector("input[name=NumerTelefonuMatki]");
const mailMatki = document.querySelector("input[name=MailMatki]");

const nazwiskoOjca = document.querySelector("input[name=NazwiskoOjca]");
const imieOjca = document.querySelector("input[name=ImieOjca]");
const numerTelefonuOjca = document.querySelector("input[name=NumerTelefonuOjca]");
const mailOjca = document.querySelector("input[name=MailOjca]");

const nazwiskoOpiekuna = document.querySelector("input[name=NazwiskoOpiekuna]");
const imieOpiekuna = document.querySelector("input[name=ImieOpiekuna]");
const numerTelefonuOpiekuna = document.querySelector("input[name=NumerTelefonuOpiekuna]");
const mailOpiekuna = document.querySelector("input[name=MailOpiekuna]");

const adresMiejscowosc = document.getElementById("floatingInputAdresMiejscowosc");
const adresUlica = document.getElementById("floatingInputAdresUlica");
const adresKod = document.getElementById("floatingInputAdresKod");
const adresGmina = document.getElementById("floatingInputAdresGmina");
const adresPoczta = document.getElementById("floatingInputAdresPoczta");

const zameldowanieMiejscowosc = document.getElementById("floatingInputZameldowanieMiejscowosc");
const zameldowanieUlica = document.getElementById("floatingInputZameldowanieUlica");
const zameldowanieKod = document.getElementById("floatingInputZameldowanieKod");
const zameldowanieGmina = document.getElementById("floatingInputZameldowanieGmina");
const zameldowaniePoczta = document.getElementById("floatingInputZameldowaniePoczta");

const matkaMiejscowosc = document.getElementById("floatingMiejscowoscMatki");
const matkaUlica = document.getElementById("floatingUlicaMatki");
const matkaKod = document.getElementById("floatingKodMatki");

const ojciecMiejscowosc = document.getElementById("floatingMiejscowoscOjca");
const ojciecUlica = document.getElementById("floatingUlicaOjca");
const ojciecKod = document.getElementById("floatingKodOjca");

const opiekunMiejscowosc = document.getElementById("floatingMiejscowoscOpiekuna");
const opiekunUlica = document.getElementById("floatingUlicaOpiekuna");
const opiekunKod = document.getElementById("floatingKodOpiekuna");

console.log(adresMiejscowosc);
switchElement.addEventListener('change', ()=>adres());
switchElementMatki.addEventListener('change', ()=>adres());
switchElementOjca.addEventListener('change', ()=>adres());
switchElementOpiekuna.addEventListener('change', ()=>adres());

adresMiejscowosc.addEventListener('input', ()=>adres());
adresUlica.addEventListener("input", ()=>adres());
adresKod.addEventListener("input", ()=>adres());
adresGmina.addEventListener("input", ()=>adres());
adresPoczta.addEventListener("input", ()=>adres());

function adres() {
    if(switchElement.checked) {
        zameldowanieMiejscowosc.setAttribute("disabled", "");
        zameldowanieUlica.setAttribute("disabled", "");
        zameldowanieKod.setAttribute("disabled", "");
        zameldowanieGmina.setAttribute("disabled", "");
        zameldowaniePoczta.setAttribute("disabled", "");

        zameldowanieMiejscowosc.value = adresMiejscowosc.value;
        zameldowanieUlica.value = adresUlica.value;
        zameldowanieKod.value = adresKod.value;
        zameldowanieGmina.value = adresGmina.value;
        zameldowaniePoczta.value = adresPoczta.value;
    } else {
        zameldowanieMiejscowosc.removeAttribute("disabled");
        zameldowanieUlica.removeAttribute("disabled");
        zameldowanieKod.removeAttribute("disabled");
        zameldowanieGmina.removeAttribute("disabled");
        zameldowaniePoczta.removeAttribute("disabled");
    }

    if(switchElementMatki.checked) {
        matkaMiejscowosc.setAttribute("disabled", "");
        matkaUlica.setAttribute("disabled", "");
        matkaKod.setAttribute("disabled", "");

        matkaMiejscowosc.value = adresMiejscowosc.value;
        matkaUlica.value = adresUlica.value;
        matkaKod.value = adresKod.value;
    } else {
        matkaMiejscowosc.removeAttribute("disabled");
        matkaUlica.removeAttribute("disabled");
        matkaKod.removeAttribute("disabled");
    }

    if(switchElementOjca.checked) {
        ojciecMiejscowosc.setAttribute("disabled", "");
        ojciecUlica.setAttribute("disabled", "");
        ojciecKod.setAttribute("disabled", "");

        ojciecMiejscowosc.value = adresMiejscowosc.value;
        ojciecUlica.value = adresUlica.value;
        ojciecKod.value = adresKod.value;
    } else {
        ojciecMiejscowosc.removeAttribute("disabled");
        ojciecUlica.removeAttribute("disabled");
        ojciecKod.removeAttribute("disabled");
    }

    if(switchElementOpiekuna.checked) {
        opiekunMiejscowosc.setAttribute("disabled", "");
        opiekunUlica.setAttribute("disabled", "");
        opiekunKod.setAttribute("disabled", "");

        opiekunMiejscowosc.value = adresMiejscowosc.value;
        opiekunUlica.value = adresUlica.value;
        opiekunKod.value = adresKod.value;
    } else {
        opiekunMiejscowosc.removeAttribute("disabled");
        opiekunUlica.removeAttribute("disabled");
        opiekunKod.removeAttribute("disabled");
    }
}

function validatePESEL(pesel) {
    var weights = [1, 3, 7, 9, 1, 3, 7, 9, 1, 3];
    var sum = 0;
        if (pesel.length !== 11) {
            return false;
        }

    for (var i = 0; i < 10; i++) {
        sum += pesel[i] * weights[i];
    }
    
    var checksum = (10 - (sum % 10)) % 10;
    if (checksum !== parseInt(pesel[10])) {
        return false;
    }
    return true;
}

function validateEmail(email) {
    // Wzorzec do sprawdzania poprawności adresu e-mail
  var pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  // Testowanie wzorca na adresie e-mail
  return pattern.test(email);
}

const mails = document.querySelectorAll("input[type=email]");

mails.forEach((mail)=>{
mail.addEventListener("input", (target)=>{ValidateMail(target)})
})
pesel.addEventListener("input", ()=>{ValidatePesel()});

function ValidateMail(target) {
  if(!validateEmail(target.target.value)) target.target.classList.add("is-invalid");
else target.target.classList.remove("is-invalid");
}

function ValidatePesel() {
if(!validatePESEL(pesel.value)) pesel.classList.add("is-invalid");
else pesel.classList.remove("is-invalid");
}

if(error) document.getElementById("submit").setAttribute("disabled", "");
else document.getElementById("submit").removeAttribute("disabled");

var ok = `<select id="wyborSzkola" class="form-select">`;
fetch('rspo_2023_03_06.csv', { headers: { 'Content-Type': 'text/csv; charset=utf-8' }})
    .then(response => response.arrayBuffer())
    .then(buffer => {
        const decoder = new TextDecoder('utf-8');
        const text = decoder.decode(buffer);
        const rows = text.trim().split('\n');
        const table = [];
        for (let i = 0; i < rows.length; i++) {
            const columns = rows[i].split(';'); 
            table.push(columns);
        }
        for (let i = 0; i < rows.length; i++) {
            const row = table[i]; 
            if(i == 0) continue;
            ok += ("<option>" + row[4].substring(1,row[4].length-1) + " " + row[13].substring(1, row[13].length-1) +  " " + row[15].substring(1, row[15].length-1) + " " + row[16].substring(1, row[16].length-1) + "</option>");
        }
        ok += "</select><label for='wyborSzkola'>Szkoła do której uczęszczał kandydat</label>";
        document.getElementById("szkola").innerHTML = ok;
});

    grecaptcha.enterprise.ready(function() {
        grecaptcha.enterprise.execute('6LcH--ckAAAAAIS0cUrm8GBWzUCXOo6lvSDrSk4f', {action: 'login'}).then(function(token) {
            console.log("ok");
        });
    });