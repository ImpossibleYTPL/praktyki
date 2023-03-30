var errMatka, errOjciec, errOpiekun = false;

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

//tabs
const rekrutacjaTab = document.getElementById('rekrutacja-tab');
const kandydatTab = document.getElementById('home-tab');
const opiekuniTab = document.getElementById('profile-tab');
const ocenyTab = document.getElementById('contact-tab');
const osiagnieciaTab = document.getElementById('osiagniecia-tab');
const wyslijTab = document.getElementById('wyslij-tab');

//buttony
//rekrutacja
const RP = document.getElementById('RP')
const RD = document.getElementById('RD');
//kandydat
const KP = document.getElementById('KP');
const KD = document.getElementById('KD');
//opiekuni
const OPP = document.getElementById('OPP');
const OPD = document.getElementById('OPD');
//oceny
const OCP = document.getElementById('OCP');
const OCD = document.getElementById('OCD');
//osiagniecia
const OSP = document.getElementById('OSP');
const OSD = document.getElementById('OSD');
//wyslij
const WP = document.getElementById('WP')
const WD = document.getElementById('WD');

//oceny
const kierunek1 = document.getElementById("kierunek1");
const kierunek2 = document.getElementById("kierunek2");
const kierunek3 = document.getElementById("kierunek3");

const kierunek1Inputs = document.getElementById('kierunek1Inputs');
const kierunek2Inputs = document.getElementById('kierunek2Inputs');
const kierunek3Inputs = document.getElementById('kierunek3Inputs');

const zachowanie = document.getElementById("ocenaZachowanie");
const egzPol = document.getElementById("EgzPol");
const egzMat = document.getElementById("EgzMat");
const egzAng = document.getElementById("EgzAng");

//zgoda
const zgoda = document.getElementById('zgoda');

//Add Event Listener to every button and input
function events(){
     zgoda.addEventListener('change', ()=>Zgoda());

     switchElement.addEventListener('change', ()=>{adres(); FirstPageCheck()});
     switchElementMatki.addEventListener('change', ()=>{adres(); SecondPageValidateForm()});
     switchElementOjca.addEventListener('change', ()=>{adres(); SecondPageValidateForm()});
     switchElementOpiekuna.addEventListener('change', ()=>{adres(); SecondPageValidateForm()});
     
     adresMiejscowosc.addEventListener('input', ()=>adres());
     adresUlica.addEventListener("input", ()=>adres());
     adresKod.addEventListener("input", ()=>adres());
     adresGmina.addEventListener("input", ()=>adres());
     adresPoczta.addEventListener("input", ()=>adres());

     //tabs Event Listeners
     //rekrutacja
     RD.addEventListener('click', ()=>{ToKandydat()});
     //kandydat
     KP.addEventListener('click', ()=>{ToRekrutacja()});
     KD.addEventListener('click', ()=>{ToOpiekuni()});
     //opiekuni
     OPP.addEventListener('click', ()=>{ToKandydat()});
     OPD.addEventListener('click', ()=>{ToOceny()});
     //oceny
     OCP.addEventListener('click', ()=>{ToOpiekuni()});
     OCD.addEventListener('click', ()=>{ToOsiagniecia()});
     //osiagniecia
     OSP.addEventListener('click', ()=>{ToOceny()});
     OSD.addEventListener('click', ()=>{ToWyslij()});
     //wyslij
     WP.addEventListener('click', ()=>{ToOsiagniecia()});

     //first page Event Listeners
     nazwisko.addEventListener('input', ()=>{FirstPageCheck()});
     imie.addEventListener('input', ()=>{FirstPageCheck()});
     dataUrodzenia.addEventListener('input', ()=>{FirstPageCheck()});
     MiejsceUrodzenia.addEventListener('input', ()=>{FirstPageCheck()});
     pesel.addEventListener('input', ()=>{FirstPageCheck()});
     mail.addEventListener('input', ()=>{FirstPageCheck()});
     adresMiejscowosc.addEventListener('input', ()=>{FirstPageCheck()});
     adresUlica.addEventListener('input', ()=>{FirstPageCheck()});
     adresKod.addEventListener('input', ()=>{FirstPageCheck()});
     adresGmina.addEventListener('input', ()=>{FirstPageCheck()});
     adresPoczta.addEventListener('input', ()=>{FirstPageCheck()});
     zameldowanieMiejscowosc.addEventListener('input', ()=>{FirstPageCheck()});
     zameldowanieUlica.addEventListener('input', ()=>{FirstPageCheck()});
     zameldowanieKod.addEventListener('input', ()=>{FirstPageCheck()});
     zameldowanieGmina.addEventListener('input', ()=>{FirstPageCheck()});
     zameldowaniePoczta.addEventListener('input', ()=>{FirstPageCheck()});
     
     //second page Event Listeners
     
     switchElementMatki.addEventListener('input', ()=>{SecondPageValidateForm()});
     switchElementOjca.addEventListener('input', ()=>{SecondPageValidateForm()});
     switchElementOpiekuna.addEventListener('input', ()=>{SecondPageValidateForm()});
     
     //matka
     nazwiskoMatki.addEventListener('input', ()=>{SecondPageValidateForm()});
     imieMatki.addEventListener('input', ()=>{SecondPageValidateForm()});
     numerTelefonuMatki.addEventListener('input', ()=>{SecondPageValidateForm()});
     mailMatki.addEventListener('input', ()=>{SecondPageValidateForm()});
     matkaMiejscowosc.addEventListener('input', ()=>{SecondPageValidateForm()});
     matkaUlica.addEventListener('input', ()=>{SecondPageValidateForm()});
     matkaKod.addEventListener('input', ()=>{SecondPageValidateForm()});
     
     //ojciec
     nazwiskoOjca.addEventListener('input', ()=>{SecondPageValidateForm()});
     imieOjca.addEventListener('input', ()=>{SecondPageValidateForm()});
     numerTelefonuOjca.addEventListener('input', ()=>{SecondPageValidateForm()});
     mailOjca.addEventListener('input', ()=>{SecondPageValidateForm()});
     ojciecMiejscowosc.addEventListener('input', ()=>{SecondPageValidateForm()});
     ojciecUlica.addEventListener('input', ()=>{SecondPageValidateForm()});
     ojciecKod.addEventListener('input', ()=>{SecondPageValidateForm()});
     
     //opiekun
     nazwiskoOpiekuna.addEventListener('input', ()=>{SecondPageValidateForm()});
     imieOpiekuna.addEventListener('input', ()=>{SecondPageValidateForm()});
     numerTelefonuOpiekuna.addEventListener('input', ()=>{SecondPageValidateForm()});
     mailOpiekuna.addEventListener('input', ()=>{SecondPageValidateForm()});
     opiekunMiejscowosc.addEventListener('input', ()=>{SecondPageValidateForm()});
     opiekunUlica.addEventListener('input', ()=>{SecondPageValidateForm()});
     opiekunKod.addEventListener('input', ()=>{SecondPageValidateForm()});
    
    //oceny
    kierunek1.addEventListener('change', ()=>{Kierunek1(); ValidateOceny()});
    kierunek2.addEventListener('change', ()=>{Kierunek2(); ValidateOceny()});
    kierunek3.addEventListener('change', ()=>{Kierunek3(); ValidateOceny()});

    egzAng.addEventListener('input', ()=>{ValidateOceny()});
    egzMat.addEventListener('input', ()=>{ValidateOceny()});
    egzPol.addEventListener('input', ()=>{ValidateOceny()});

    zachowanie.addEventListener('change', ()=>{Validate3rdPage()})
    }




function ToRekrutacja(){
    rekrutacjaTab.removeAttribute('disabled');
    rekrutacjaTab.click();
    rekrutacjaTab.setAttribute('disabled', '');
    topFunction();
}
function ToKandydat(){
    //console.log('To kondydat')
    kandydatTab.removeAttribute('disabled');
    kandydatTab.click();
    kandydatTab.setAttribute('disabled', '');
    topFunction()
}

function ToOpiekuni(){
    opiekuniTab.removeAttribute('disabled');
    opiekuniTab.click();
    opiekuniTab.setAttribute('disabled', '');
    topFunction();
}

function ToOceny(){
    ocenyTab.removeAttribute('disabled');
    ocenyTab.click();
    ocenyTab.setAttribute('disabled', '');
    topFunction();
}

function ToOsiagniecia(){
    osiagnieciaTab.removeAttribute('disabled');
    osiagnieciaTab.click();
    osiagnieciaTab.setAttribute('disabled', '');
    topFunction();
}

function ToWyslij(){
    wyslijTab.removeAttribute('disabled');
    wyslijTab.click();
    wyslijTab.setAttribute('disabled', '');
    topFunction();
    disableDisabled();
}

function Zgoda(){
    if(zgoda.checked) WD.removeAttribute('disabled')
    else WD.setAttribute('disabled', '');
}

function topFunction() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
  }

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


    function FirstPageCheck(){
        error = Validate1STForm();
        if(error) KD.setAttribute('disabled', '');
        else KD.removeAttribute('disabled');
    }

    function Validate1STForm(){
        //console.log('validating..')
        if(nazwisko.value === '') return true;
        else if(imie.value === '') return true; 
        else if(dataUrodzenia.value === '') return true; 
        else if(MiejsceUrodzenia.value === '') return true;
        else if(pesel.value === '') return true; 
        else if(adresMiejscowosc.value === '') return true; 
        else if(adresUlica.value === '') return true; 
        else if(adresKod.value === '') return true; 
        else if(adresGmina.value === '') return true; 
        else if(adresPoczta.value === '') return true; 
        else if(zameldowanieMiejscowosc.value === '') return true; 
        else if(zameldowanieUlica.value === '') return true; 
        else if(zameldowanieKod.value === '') return true; 
        else if(zameldowanieGmina.value === '') return true; 
        else if(zameldowaniePoczta.value === '') return true; 
        else if(!validateEmail(mail.value)) return true; 
        else if(!validatePESEL(pesel.value)) return true; 
        else return false;
    }

    function SecondPageValidateForm(){

        const matka = !!(nazwiskoMatki.value != '' ||
        imieMatki.value != '' ||
        numerTelefonuMatki.value != '' ||
        mailMatki.value != '' ||
        matkaMiejscowosc.value != '' ||
        matkaUlica.value != '' ||
        matkaKod.value != '')

        const ojciec = !!(nazwiskoOjca.value != '' ||
        imieOjca.value != '' ||
        numerTelefonuOjca.value != '' ||
        mailOjca.value != '' ||
        ojciecMiejscowosc.value != '' ||
        ojciecUlica.value != '' ||
        ojciecKod.value != '')

        const opiekun = !!(nazwiskoOpiekuna.value != '' ||
        imieOpiekuna.value != '' ||
        numerTelefonuOpiekuna.value != '' ||
        mailOpiekuna.value != '' ||
        opiekunMiejscowosc.value != '' ||
        opiekunUlica.value != '' ||
        opiekunKod.value != '')

        //console.log("matka: " + matka + " ojciec: " + ojciec + " opiekun: " + opiekun)

        if(!matka && !ojciec && !opiekun) {
            OPD.setAttribute('disabled', '');
            return false;
        }

        if (matka) {
            errMatka =
            (nazwiskoMatki.value != '' &&
            imieMatki.value != '' &&
            numerTelefonuMatki.value != '' &&
            mailMatki.value != '' &&
            matkaMiejscowosc != '' &&
            matkaUlica.value != '' &&
            matkaKod.value != '' &&
            validateEmail(mailMatki.value))
        }

        if (ojciec) {
            errOjciec =
            (nazwiskoOjca.value != '' &&
            imieOjca.value != '' &&
            numerTelefonuOjca.value != '' &&
            mailOjca.value != '' &&
            ojciecMiejscowosc != '' &&
            ojciecUlica.value != '' &&
            ojciecKod.value != '' &&
            validateEmail(mailOjca.value))
        }

        if (opiekun) {
            errOpiekun =
            (nazwiskoOpiekuna.value != '' &&
            imieOpiekuna.value != '' &&
            numerTelefonuOpiekuna.value != '' &&
            mailOpiekuna.value != '' &&
            opiekunMiejscowosc != '' &&
            opiekunUlica.value != '' &&
            opiekunKod.value != '' &&
            validateEmail(mailOpiekuna.value))
        }

        if(errMatka || errOjciec || errOpiekun) {
            OPD.removeAttribute('disabled');
        } else {
            OPD.setAttribute('disabled', '');
        }
    }

    //strona z ocenami

    function ValidateOceny(){
      error = Validate3rdPage();
      if(error)
        OCD.setAttribute("disabled", '');
      else
        OCD.removeAttribute("disabled")
    }

    function Validate3rdPage(){
      var oceny = document.getElementsByClassName("przedmiot");
      oceny = Array.from(oceny);
      var err = !oceny.map(element => {
        if(element.value == '0' || element.value == '1') {
          //console.log(element)
          return true;
        }
        return false;
      }).every(result => result === false);
      //console.log(err);
      if(zachowanie.value == "Naganne") return true;
      else if(err) return true;
      else if(egzAng.value == '' || parseInt(egzAng.value) < 0 || parseInt(egzAng.value) > 100) return true;
      else if(egzMat.value == '' || parseInt(egzMat.value) < 0 || parseInt(egzMat.value) > 100) return true;
      else if(egzPol.value == '' || parseInt(egzPol.value) < 0 || parseInt(egzPol.value) > 100) return true;
      else if(kierunek1.value == '') return true;
      else false;
    }

    function Load(){
        document.getElementById('rekrutacja-tab').removeAttribute('disabled');
        document.getElementById('rekrutacja-tab').click;
        document.getElementById('rekrutacja-tab').setAttribute('disabled', '');
        events();
        //console.log('loaded');
        FirstPageCheck();
        SecondPageValidateForm();
        ValidateOceny();
      }

      function disableDisabled() {
        zameldowanieGmina.removeAttribute('disabled');
        zameldowanieKod.removeAttribute('disabled');
        zameldowanieMiejscowosc.removeAttribute('disabled');
        zameldowaniePoczta.removeAttribute('disabled');
        zameldowanieUlica.removeAttribute('disabled');

        matkaKod.removeAttribute('disabled');
        matkaMiejscowosc.removeAttribute('disabled');
        matkaUlica.removeAttribute('disabled');

        ojciecKod.removeAttribute('disabled');
        ojciecMiejscowosc.removeAttribute('disabled');
        ojciecUlica.removeAttribute('disabled');

        opiekunKod.removeAttribute('disabled');
        opiekunMiejscowosc.removeAttribute('disabled');
        opiekunUlica.removeAttribute('disabled');
      }

      function enableDisabled() {
        zameldowanieGmina.setAttribute('disabled', '');
        zameldowanieKod.setAttribute('disabled', '');
        zameldowanieMiejscowosc.setAttribute('disabled', '');
        zameldowaniePoczta.setAttribute('disabled', '');
        zameldowanieUlica.setAttribute('disabled', '');

        matkaKod.setAttribute('disabled', '');
        matkaMiejscowosc.setAttribute('disabled', '');
        matkaUlica.setAttribute('disabled', '');

        ojciecKod.setAttribute('disabled', '');
        ojciecMiejscowosc.setAttribute('disabled', '');
        ojciecUlica.removeAttribute('disabled');

        opiekunKod.setAttribute('disabled', '');
        opiekunMiejscowosc.setAttribute('disabled', '');
        opiekunUlica.setAttribute('disabled', '');
      }

      function Kierunek1(){
        if(kierunek1.value === 'TECHNIK GRAFIKI I POLIGRAFII CYFROWEJ' || kierunek1.value === 'TECHNIK INFORMATYK') {
            //console.log('inf')
            kierunek1Inputs.innerHTML = `<div class="mb-3 form-floating">
            <select name="oceny1Polski" id="oceny" class="form-select przedmiot">
              <option value="0">0 - Brak Oceny</option>
              <option value="1">1 - Niedostateczny</option>
              <option value="2">2 - Dopuszczający</option>
              <option value="3">3 - Dostateczny</option>
              <option value="4">4 - Dobry</option>
              <option value="5">5 - Bardzo Dobry</option>
              <option value="6">6 - Celujący</option>
            </select>
            <label for="oceny" class="form-label">Język polski</label>
          </div><div class="mb-3 form-floating">
          <select name="oceny1Matematyka" id="oceny" class="form-select przedmiot">
            <option value="0">0 - Brak Oceny</option>
            <option value="1">1 - Niedostateczny</option>
            <option value="2">2 - Dopuszczający</option>
            <option value="3">3 - Dostateczny</option>
            <option value="4">4 - Dobry</option>
            <option value="5">5 - Bardzo Dobry</option>
            <option value="6">6 - Celujący</option>
          </select>
          <label for="oceny" class="form-label">Matamatyka</label>
        </div><div class="mb-3 form-floating">
        <select name="oceny1Obcy" id="oceny" class="form-select przedmiot">
          <option value="0">0 - Brak Oceny</option>
          <option value="1">1 - Niedostateczny</option>
          <option value="2">2 - Dopuszczający</option>
          <option value="3">3 - Dostateczny</option>
          <option value="4">4 - Dobry</option>
          <option value="5">5 - Bardzo Dobry</option>
          <option value="6">6 - Celujący</option>
        </select>
        <label for="oceny" class="form-label">JęzykObcy</label>
      </div><div class="mb-3 form-floating">
      <select name="oceny1Informatyka" id="oceny" class="form-select przedmiot">
        <option value="0">0 - Brak Oceny</option>
        <option value="1">1 - Niedostateczny</option>
        <option value="2">2 - Dopuszczający</option>
        <option value="3">3 - Dostateczny</option>
        <option value="4">4 - Dobry</option>
        <option value="5">5 - Bardzo Dobry</option>
        <option value="6">6 - Celujący</option>
      </select>
      <label for="oceny" class="form-label">Informatyka</label>
    </div>`;
        var oceny = document.getElementsByClassName("przedmiot");
    oceny = Array.from(oceny);
    oceny.forEach(element => {
      if (element.getAttribute('listener') !== 'true') {
      if(element.value == '0') {
        element.setAttribute('listener' , 'true')
        element.addEventListener('change', ()=>{ValidateOceny();})
      }
      }
    })
        } else {
            //console.log('geo');
            kierunek1Inputs.innerHTML = `<div class="mb-3 form-floating">
            <select name="oceny1Polski" id="oceny" class="form-select przedmiot">
              <option value="0">0 - Brak Oceny</option>
              <option value="1">1 - Niedostateczny</option>
              <option value="2">2 - Dopuszczający</option>
              <option value="3">3 - Dostateczny</option>
              <option value="4">4 - Dobry</option>
              <option value="5">5 - Bardzo Dobry</option>
              <option value="6">6 - Celujący</option>
            </select>
            <label for="oceny" class="form-label">Język polski</label>
          </div><div class="mb-3 form-floating">
          <select name="oceny1Matematyka" id="oceny" class="form-select przedmiot">
            <option value="0">0 - Brak Oceny</option>
            <option value="1">1 - Niedostateczny</option>
            <option value="2">2 - Dopuszczający</option>
            <option value="3">3 - Dostateczny</option>
            <option value="4">4 - Dobry</option>
            <option value="5">5 - Bardzo Dobry</option>
            <option value="6">6 - Celujący</option>
          </select>
          <label for="oceny" class="form-label">Matamatyka</label>
        </div><div class="mb-3 form-floating">
        <select name="oceny1Obcy" id="oceny" class="form-select przedmiot">
          <option value="0">0 - Brak Oceny</option>
          <option value="1">1 - Niedostateczny</option>
          <option value="2">2 - Dopuszczający</option>
          <option value="3">3 - Dostateczny</option>
          <option value="4">4 - Dobry</option>
          <option value="5">5 - Bardzo Dobry</option>
          <option value="6">6 - Celujący</option>
        </select>
        <label for="oceny" class="form-label">Język Obcy</label>
      </div><div class="mb-3 form-floating">
      <select name="oceny1Geografia" id="oceny" class="form-select przedmiot">
        <option value="0">0 - Brak Oceny</option>
        <option value="1">1 - Niedostateczny</option>
        <option value="2">2 - Dopuszczający</option>
        <option value="3">3 - Dostateczny</option>
        <option value="4">4 - Dobry</option>
        <option value="5">5 - Bardzo Dobry</option>
        <option value="6">6 - Celujący</option>
      </select>
      <label for="oceny" class="form-label">Geografia</label>
    </div>`;
        var oceny = document.getElementsByClassName("przedmiot");
    oceny = Array.from(oceny);
    oceny.forEach(element => {
      if (element.getAttribute('listener') !== 'true') {
      if(element.value == '0') {
        element.setAttribute('listener' , 'true')
        element.addEventListener('change', ()=>{ValidateOceny();})
      }
      }
    })
  }
}
      function Kierunek2(){
        if(kierunek2.value === 'TECHNIK GRAFIKI I POLIGRAFII CYFROWEJ' || kierunek2.value === 'TECHNIK INFORMATYK') {
            //console.log('inf');
            kierunek2Inputs.innerHTML = `<div class="mb-3 form-floating">
            <select name="oceny2Polski" id="oceny" class="form-select przedmiot">
              <option value="0">0 - Brak Oceny</option>
              <option value="1">1 - Niedostateczny</option>
              <option value="2">2 - Dopuszczający</option>
              <option value="3">3 - Dostateczny</option>
              <option value="4">4 - Dobry</option>
              <option value="5">5 - Bardzo Dobry</option>
              <option value="6">6 - Celujący</option>
            </select>
            <label for="oceny" class="form-label">Język polski</label>
          </div><div class="mb-3 form-floating">
          <select name="oceny2Matematyka" id="oceny" class="form-select przedmiot">
            <option value="0">0 - Brak Oceny</option>
            <option value="1">1 - Niedostateczny</option>
            <option value="2">2 - Dopuszczający</option>
            <option value="3">3 - Dostateczny</option>
            <option value="4">4 - Dobry</option>
            <option value="5">5 - Bardzo Dobry</option>
            <option value="6">6 - Celujący</option>
          </select>
          <label for="oceny" class="form-label">Matamatyka</label>
        </div><div class="mb-3 form-floating">
        <select name="oceny2Obcy" id="oceny" class="form-select przedmiot">
          <option value="0">0 - Brak Oceny</option>
          <option value="1">1 - Niedostateczny</option>
          <option value="2">2 - Dopuszczający</option>
          <option value="3">3 - Dostateczny</option>
          <option value="4">4 - Dobry</option>
          <option value="5">5 - Bardzo Dobry</option>
          <option value="6">6 - Celujący</option>
        </select>
        <label for="oceny" class="form-label">JęzykObcy</label>
      </div><div class="mb-3 form-floating">
      <select name="oceny2Informatyka" id="oceny" class="form-select przedmiot">
        <option value="0">0 - Brak Oceny</option>
        <option value="1">1 - Niedostateczny</option>
        <option value="2">2 - Dopuszczający</option>
        <option value="3">3 - Dostateczny</option>
        <option value="4">4 - Dobry</option>
        <option value="5">5 - Bardzo Dobry</option>
        <option value="6">6 - Celujący</option>
      </select>
      <label for="oceny" class="form-label">Informatyka</label>
    </div>`;
        var oceny = document.getElementsByClassName("przedmiot");
    oceny = Array.from(oceny);
    oceny.forEach(element => {
      if (element.getAttribute('listener') !== 'true') {
      if(element.value == '0') {
        element.setAttribute('listener' , 'true')
        element.addEventListener('change', ()=>{ValidateOceny();})
      }
      }
    })
        } else {
            //console.log('geo');
            kierunek2Inputs.innerHTML = `<div class="mb-3 form-floating">
            <select name="oceny2Polski" id="oceny" class="form-select przedmiot">
              <option value="0">0 - Brak Oceny</option>
              <option value="1">1 - Niedostateczny</option>
              <option value="2">2 - Dopuszczający</option>
              <option value="3">3 - Dostateczny</option>
              <option value="4">4 - Dobry</option>
              <option value="5">5 - Bardzo Dobry</option>
              <option value="6">6 - Celujący</option>
            </select>
            <label for="oceny" class="form-label">Język polski</label>
          </div><div class="mb-3 form-floating">
          <select name="oceny2Matematyka" id="oceny" class="form-select przedmiot">
            <option value="0">0 - Brak Oceny</option>
            <option value="1">1 - Niedostateczny</option>
            <option value="2">2 - Dopuszczający</option>
            <option value="3">3 - Dostateczny</option>
            <option value="4">4 - Dobry</option>
            <option value="5">5 - Bardzo Dobry</option>
            <option value="6">6 - Celujący</option>
          </select>
          <label for="oceny" class="form-label">Matamatyka</label>
        </div><div class="mb-3 form-floating">
        <select name="oceny2Obcy" id="oceny" class="form-select przedmiot">
          <option value="0">0 - Brak Oceny</option>
          <option value="1">1 - Niedostateczny</option>
          <option value="2">2 - Dopuszczający</option>
          <option value="3">3 - Dostateczny</option>
          <option value="4">4 - Dobry</option>
          <option value="5">5 - Bardzo Dobry</option>
          <option value="6">6 - Celujący</option>
        </select>
        <label for="oceny" class="form-label">Język Obcy</label>
      </div><div class="mb-3 form-floating">
      <select name="oceny2Geografia" id="oceny" class="form-select przedmiot">
        <option value="0">0 - Brak Oceny</option>
        <option value="1">1 - Niedostateczny</option>
        <option value="2">2 - Dopuszczający</option>
        <option value="3">3 - Dostateczny</option>
        <option value="4">4 - Dobry</option>
        <option value="5">5 - Bardzo Dobry</option>
        <option value="6">6 - Celujący</option>
      </select>
      <label for="oceny" class="form-label">Geografia</label>
    </div>`;
        var oceny = document.getElementsByClassName("przedmiot");
    oceny = Array.from(oceny);
    oceny.forEach(element => {
      if (element.getAttribute('listener') !== 'true') {
      if(element.value == '0') {
        element.setAttribute('listener' , 'true')
        element.addEventListener('change', ()=>{ValidateOceny();})
      }
      }
    })
        }
      }
      function Kierunek3(){
        if(kierunek3.value === 'TECHNIK GRAFIKI I POLIGRAFII CYFROWEJ' || kierunek3.value === 'TECHNIK INFORMATYK') {
            //console.log('inf');
            kierunek3Inputs.innerHTML = `<div class="mb-3 form-floating">
            <select name="oceny3Polski" id="oceny" class="form-select przedmiot">
              <option value="0">0 - Brak Oceny</option>
              <option value="1">1 - Niedostateczny</option>
              <option value="2">2 - Dopuszczający</option>
              <option value="3">3 - Dostateczny</option>
              <option value="4">4 - Dobry</option>
              <option value="5">5 - Bardzo Dobry</option>
              <option value="6">6 - Celujący</option>
            </select>
            <label for="oceny" class="form-label">Język polski</label>
          </div><div class="mb-3 form-floating">
          <select name="oceny3Matematyka" id="oceny" class="form-select przedmiot">
            <option value="0">0 - Brak Oceny</option>
            <option value="1">1 - Niedostateczny</option>
            <option value="2">2 - Dopuszczający</option>
            <option value="3">3 - Dostateczny</option>
            <option value="4">4 - Dobry</option>
            <option value="5">5 - Bardzo Dobry</option>
            <option value="6">6 - Celujący</option>
          </select>
          <label for="oceny" class="form-label">Matamatyka</label>
        </div><div class="mb-3 form-floating">
        <select name="oceny3Obcy" id="oceny" class="form-select przedmiot">
          <option value="0">0 - Brak Oceny</option>
          <option value="1">1 - Niedostateczny</option>
          <option value="2">2 - Dopuszczający</option>
          <option value="3">3 - Dostateczny</option>
          <option value="4">4 - Dobry</option>
          <option value="5">5 - Bardzo Dobry</option>
          <option value="6">6 - Celujący</option>
        </select>
        <label for="oceny" class="form-label">JęzykObcy</label>
      </div><div class="mb-3 form-floating">
      <select name="oceny3Informatyka" id="oceny" class="form-select przedmiot">
        <option value="0">0 - Brak Oceny</option>
        <option value="1">1 - Niedostateczny</option>
        <option value="2">2 - Dopuszczający</option>
        <option value="3">3 - Dostateczny</option>
        <option value="4">4 - Dobry</option>
        <option value="5">5 - Bardzo Dobry</option>
        <option value="6">6 - Celujący</option>
      </select>
      <label for="oceny" class="form-label">Informatyka</label>
    </div>`;        var oceny = document.getElementsByClassName("przedmiot");
    oceny = Array.from(oceny);
    oceny.forEach(element => {
      if (element.getAttribute('listener') !== 'true') {
      if(element.value == '0') {
        element.setAttribute('listener' , 'true')
        element.addEventListener('change', ()=>{ValidateOceny();})
      }
      }
    })
        } else {
            //console.log('geo');
            kierunek3Inputs.innerHTML = `<div class="mb-3 form-floating">
            <select name="oceny3Polski" id="oceny" class="form-select przedmiot">
              <option value="0">0 - Brak Oceny</option>
              <option value="1">1 - Niedostateczny</option>
              <option value="2">2 - Dopuszczający</option>
              <option value="3">3 - Dostateczny</option>
              <option value="4">4 - Dobry</option>
              <option value="5">5 - Bardzo Dobry</option>
              <option value="6">6 - Celujący</option>
            </select>
            <label for="oceny" class="form-label">Język polski</label>
          </div><div class="mb-3 form-floating">
          <select name="oceny3Matematyka" id="oceny" class="form-select przedmiot">
            <option value="0">0 - Brak Oceny</option>
            <option value="1">1 - Niedostateczny</option>
            <option value="2">2 - Dopuszczający</option>
            <option value="3">3 - Dostateczny</option>
            <option value="4">4 - Dobry</option>
            <option value="5">5 - Bardzo Dobry</option>
            <option value="6">6 - Celujący</option>
          </select>
          <label for="oceny" class="form-label">Matamatyka</label>
        </div><div class="mb-3 form-floating">
        <select name="oceny3Obcy" id="oceny" class="form-select przedmiot">
          <option value="0">0 - Brak Oceny</option>
          <option value="1">1 - Niedostateczny</option>
          <option value="2">2 - Dopuszczający</option>
          <option value="3">3 - Dostateczny</option>
          <option value="4">4 - Dobry</option>
          <option value="5">5 - Bardzo Dobry</option>
          <option value="6">6 - Celujący</option>
        </select>
        <label for="oceny" class="form-label">Język Obcy</label>
      </div><div class="mb-3 form-floating">
      <select name="oceny3Geografia" id="oceny" class="form-select przedmiot">
        <option value="0">0 - Brak Oceny</option>
        <option value="1">1 - Niedostateczny</option>
        <option value="2">2 - Dopuszczający</option>
        <option value="3">3 - Dostateczny</option>
        <option value="4">4 - Dobry</option>
        <option value="5">5 - Bardzo Dobry</option>
        <option value="6">6 - Celujący</option>
      </select>
      <label for="oceny" class="form-label">Geografia</label>
    </div>`;
    var oceny = document.getElementsByClassName("przedmiot");
    oceny = Array.from(oceny);
    if (element.getAttribute('listener') !== 'true') {
    oceny.forEach(element => {
      if(element.value == '0') {
        element.setAttribute('listener' , 'true')
        element.addEventListener('change', ()=>{ValidateOceny();})
      }
    })
  }
        }
      }