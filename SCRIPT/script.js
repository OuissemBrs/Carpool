var checkboxes = document.querySelectorAll('input[type="checkbox"]');
var radio = document.querySelectorAll('input[type="radio"]'); 



function sortprice(){
    var priceElement = document.getElementsByClassName("prix");
    var container = document.getElementById("voyup");
                    for (var i = 0; i <= priceElement.length - 1; i++) {
                        for (var j = 1; j <= priceElement.length - 1; j++) {
                            if ((parseInt(priceElement[j-1].textContent.substring(0, priceElement[j-1].textContent.length - 2)) > parseInt(priceElement[j].textContent.substring(0, priceElement[j].textContent.length - 2)))) {
                                container.insertBefore(priceElement[j-1].parentNode.parentNode, priceElement[j].parentNode.parentNode.nextSibling);
                            }
                        }
                    }
    

}


function sortfast(){
    
    var priceElement = document.getElementsByClassName("diff");
    var container = document.getElementById("voyup");
                    for (var i = 0; i <= priceElement.length - 1; i++) {
                        for (var j = 1; j <= priceElement.length - 1; j++) {
                            if (parseFloat(priceElement[j-1].textContent.replace(":", ".")) > parseFloat(priceElement[j].textContent.replace(":", "."))) {
                                container.insertBefore(priceElement[j-1].parentNode.parentNode.parentNode.parentNode, priceElement[j].parentNode.parentNode.parentNode.parentNode.nextSibling);
                            }
                        }
                    }
    

}

function sorttime(){
    
    var priceElement = document.getElementsByClassName("depart");
    var container = document.getElementById("voyup");
                    for (var i = 0; i <= priceElement.length - 1; i++) {
                        for (var j = 1; j <= priceElement.length - 1; j++) {
                            if (parseFloat(priceElement[j-1].textContent.replace(":", ".")) > parseFloat(priceElement[j].textContent.replace(":", "."))) {
                                container.insertBefore(priceElement[j-1].parentNode.parentNode.parentNode.parentNode, priceElement[j].parentNode.parentNode.parentNode.parentNode.nextSibling);
                            }
                        }
                    }
    

}

function clearsmoking(a){
    
    if (a) {
        var alldiv = document.getElementsByClassName("smoking");
                for (var i = 0; i < alldiv.length; i++) {
                    alldiv[i].style.display = "none";
                }
    }else{
        var droute = document.getElementById("droute");
        var nosmoke = document.getElementById("certified");
        var alldiv = document.getElementsByClassName("nocertified");
                for (var i = 0; i < alldiv.length; i++) {
                    if(droute.checked && nosmoke.checked){
                        if(alldiv[i].classList.toString().includes("notdirect") || alldiv[i].classList.toString().includes("nocertified")){
                        }else{
                            alldiv[i].style.display = "grid";
                        }
                    }else if(droute.checked){
                        if(!alldiv[i].classList.toString().includes("notdirect")){
                            alldiv[i].style.display = "grid";
                        }
                    }else if(nosmoke.checked){
                        if(!alldiv[i].classList.toString().includes("nocertified")){
                            alldiv[i].style.display = "grid";
                        }
                    }else{
                        alldiv[i].style.display = "grid";
                    }
                    
                }
    }
}
function clearnotcertified(a){
    
    if (a) {
        var alldiv = document.getElementsByClassName("nocertified");
                for (var i = 0; i < alldiv.length; i++) {
                    alldiv[i].style.display = "none";
                }
    }else{
        var droute = document.getElementById("droute");
        var nosmoke = document.getElementById("nosmoke");
        var alldiv = document.getElementsByClassName("nocertified");
                for (var i = 0; i < alldiv.length; i++) {
                    if(droute.checked && nosmoke.checked){
                        if(alldiv[i].classList.toString().includes("notdirect") || alldiv[i].classList.toString().includes("smoking")){
                        }else{
                            alldiv[i].style.display = "grid";
                        }
                    }else if(droute.checked){
                        if(!alldiv[i].classList.toString().includes("notdirect")){
                            alldiv[i].style.display = "grid";
                        }
                    }else if(nosmoke.checked){
                        if(!alldiv[i].classList.toString().includes("smoking")){
                            alldiv[i].style.display = "grid";
                        }
                    }else{
                        alldiv[i].style.display = "grid";
                    }
                    
                }
    }
}

function clearnotdirect(a){
    if (a) {
        var alldiv = document.getElementsByClassName("notdirect");
                for (var i = 0; i < alldiv.length; i++) {
                    alldiv[i].style.display = "none";
                }
    }else{
        var droute = document.getElementById("certified");
        var nosmoke = document.getElementById("nosmoke");
        var alldiv = document.getElementsByClassName("notdirect");
                for (var i = 0; i < alldiv.length; i++) {
                    if(droute.checked && nosmoke.checked){
                        if(alldiv[i].classList.toString().includes("nocertified") || alldiv[i].classList.toString().includes("smoking")){
                        }else{
                            alldiv[i].style.display = "grid";
                        }
                    }else if(droute.checked){
                        if(!alldiv[i].classList.toString().includes("nocertified")){
                            alldiv[i].style.display = "grid";
                        }
                    }else if(nosmoke.checked){
                        if(!alldiv[i].classList.toString().includes("smoking")){
                            alldiv[i].style.display = "grid";
                        }
                    }else{
                        alldiv[i].style.display = "grid";
                    }
                    
                }
    }
}



function logout(){
    window.location.href = "./logout.php"
}


function mange(){
    window.location.href = "personne.php"
}



function login(){

let loginDiv = document.createElement("div");
loginDiv.id = "login";
document.addEventListener("keydown", function() {
    if (event.keyCode === 27) {
        loginDiv.remove();
    }
    
});

let DivBox = document.createElement("div");
DivBox.id = "FormBox";

let form = document.createElement("form");
form.action = "login.php";
form.method = "POST";

let loginHeader = document.createElement("div");
loginHeader.id = "reg";
loginHeader.textContent = "Login";

let phoneDiv = document.createElement("div");
phoneDiv.classList.add("form-con");
phoneDiv.id = "nom";

let phoneInput = document.createElement("input");
phoneInput.type = "text";
phoneInput.name = "phone";
phoneInput.setAttribute('maxlength', '10');
phoneInput.setAttribute('minlength', '10');
phoneInput.required = true;

let phoneLabel = document.createElement("label");
phoneLabel.htmlFor = "phone";
phoneLabel.textContent = "Phone";

phoneDiv.appendChild(phoneInput);
phoneDiv.appendChild(phoneLabel);

let passDiv = document.createElement("div");
passDiv.classList.add("form-con");
passDiv.id = "pass";

let passInput = document.createElement("input");
passInput.type = "password";
passInput.name = "password";
passInput.setAttribute('minlength', '6');
passInput.required = true;

let passLabel = document.createElement("label");
passLabel.htmlFor = "password";
passLabel.textContent = "Password";

passDiv.appendChild(passInput);
passDiv.appendChild(passLabel);

let btnDiv = document.createElement("div");
btnDiv.id = "btn";

let submitInput = document.createElement("input");
submitInput.classList.add("subres");
submitInput.type = "submit";
submitInput.value = "Login";

btnDiv.appendChild(submitInput);
form.appendChild(loginHeader);
form.appendChild(phoneDiv);
form.appendChild(passDiv);
form.appendChild(btnDiv);
DivBox.appendChild(form);
loginDiv.appendChild(DivBox);
document.body.appendChild(loginDiv);
        var idd = Document.getElementById("login");
        idd.style.position = "absolute";
}

function register(){
window.location.href='Registration.php';
}
function logoutfirst(){
    alert("Log out first");
}


function compareTimes(time1, time2) {
    var date1 = new Date("2000-01-01T" + time1 + ":00");
    var date2 = new Date("2000-01-01T" + time2 + ":00");
  
    if (date1 < date2) {
      return true;
    } else {
      return false;
    }
  }

  function isDateGreaterThanToday(dateString) {
    var date = new Date(dateString);
    var today = new Date();
    if (date > today) {
      return true;
    } else {
      return false;
    }
  }

function arein(tab , city){
  for(i = 0 ; i<tab.lenght ; i++){
    if(tab[i] === city)
      return true;
  }
  return false;
}


document.getElementById("formtosend").addEventListener("submit", function(event) {
    
    const tabcity = ["Annaba","Batna","Constantine","Guelma","Jijel","Skikda","Taref","Om Bwaqi"];
    var Departure = document.getElementById("depart").value;
    var Destination = document.getElementById("final").value;
    var Place = document.getElementById("clie").value;
    var Date = document.getElementById("date").value;
    if (Departure === Destination) {
      alert("The Places are same!");
      event.preventDefault();
      return;
    }
    if(Place > 4){
        alert("max places est 4");
        event.preventDefault();
        return;
    }
    if(arein(tabcity,Departure) && arein(tabcity,Destination) ){
        alert("Cities are not in the System for now");
        event.preventDefault();
        return;
    }
    if (!isDateGreaterThanToday(Date)) {
        alert("Date is Not Right!");
        event.preventDefault();
        return;
    }
    
    

  });