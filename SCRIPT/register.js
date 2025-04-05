function enterage() {
    var ageString = prompt("Enter Your Age:");
    var age = parseFloat(ageString);
    if (!isNaN(age) && age >= 0) {
      return age;
    } else {
      alert("Invalid.");
      return null;
    }
  }
  function isAllNumbers(str) {
    return /^\d+$/.test(str);
}

document.getElementById("Form").addEventListener("submit", function(event) {
    var checkedRadio = document.querySelector('input[name="purpose"]:checked');
    if(checkedRadio.value == 'driver'){
      event.preventDefault();
    const form = document.getElementById('Form');
    let phone = document.getElementById("phone").value;
    if(phone.charAt(0) === '0' && isAllNumbers(phone)){
      var city = prompt("Enter your city :");
    const input = document.createElement('input');
    input.setAttribute('type', 'hidden');
    input.setAttribute('name', 'city');
    input.setAttribute('value', city);
    form.appendChild(input);
      this.submit();
    }  
    }else{
      event.preventDefault();
    const form = document.getElementById('Form');
    let phone = document.getElementById("phone").value;
    
    if(phone.charAt(0) === '0' && isAllNumbers(phone)){
      var city = prompt("Enter your city :");
    const input = document.createElement('input');
    input.setAttribute('type', 'hidden');
    input.setAttribute('name', 'city');
    input.setAttribute('value', city);
    form.appendChild(input);
    var age = enterage();
      if(age !== null && age>= 18){
        const input = document.createElement('input');
    input.setAttribute('type', 'hidden');
    input.setAttribute('name', 'Age');
    input.setAttribute('value', age);
    form.appendChild(input);
    this.submit();
    }else{
        alert("Under Age");
    }
    }
    }
})


var radioButtons = document.querySelectorAll('input[type="radio"]');
    radioButtons.forEach(function(radioButton) {
        radioButton.addEventListener('change', function() {
            if (this.value === "driver") {
              var parentDiv = document.getElementById("create");
              var newDiv = document.createElement("div");
              newDiv.id = "newcont";
    var birthDateDiv = document.createElement("div");
    birthDateDiv.classList.add("form-con");
    var birthDateInput = document.createElement("input");
    birthDateInput.type = "text";
    birthDateInput.name = "BirthDate";
    birthDateInput.setAttribute("onblur", "this.type='text'");
    birthDateInput.setAttribute("onfocus", "this.type='date'");
    birthDateInput.required = true;
    var birthDateLabel = document.createElement("label");
    birthDateLabel.textContent = "BirthDate";
    birthDateLabel.setAttribute("for", "BirthDate");
    birthDateDiv.appendChild(birthDateInput);
    birthDateDiv.appendChild(birthDateLabel);
    var licenseDateDiv = document.createElement("div");
    licenseDateDiv.classList.add("form-con");
    var licenseDateInput = document.createElement("input");
    licenseDateInput.type = "text";
    licenseDateInput.name = "LicenseDate";
    licenseDateInput.setAttribute("onblur", "this.type='text'");
    licenseDateInput.setAttribute("onfocus", "this.type='date'");
    licenseDateInput.required = true;
    var licenseDateLabel = document.createElement("label");
    licenseDateLabel.textContent = "LicenseDate";
    licenseDateLabel.setAttribute("for", "LicenseDate");
    licenseDateDiv.appendChild(licenseDateInput);
    licenseDateDiv.appendChild(licenseDateLabel);
    newDiv.appendChild(birthDateDiv);
    newDiv.appendChild(licenseDateDiv);
              parentDiv.parentNode.insertBefore(newDiv, parentDiv.nextSibling);
              
              var containerfo = document.getElementById("containerfo");
              containerfo.style.height = "83vh";


            }else if(this.value === "passenger"){
              var parentDiv = document.getElementById("newcont");
              parentDiv.parentNode.removeChild(parentDiv);
              var containerfo = document.getElementById("containerfo");
              containerfo.style.height = "63vh";
            }
        });
    });






    

    