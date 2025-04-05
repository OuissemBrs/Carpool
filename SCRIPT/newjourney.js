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

  function enterPrice() {
    var priceString = prompt("Enter Price:");
    var price = parseFloat(priceString);
    if (!isNaN(price) && price >= 0) {
      return price;
    } else {
      alert("Invalid, Please enter a valid price.");
      return null;
    }
  }
document.getElementById("Form").addEventListener("submit", function(event) {
    event.preventDefault();
    const tabcity = ["Annaba","Batna","Constantine","Guelma","Jijel","Skikda","Taref","Om Bwaqi"];
    var Departure = document.getElementById("Departure").value;
    var Destination = document.getElementById("Destination").value;
    var Time1 = document.getElementById("Time1").value;
    var Time2 = document.getElementById("Time2").value;
    var Stop1 = document.getElementById("Stop1").value;
    var Stop2 = document.getElementById("Stop2").value;
    var Date = document.getElementById("Date").value;
    alert(Departure);
    alert(Destination);
    alert(tabcity);
    if (Departure === Destination) {
      alert("The Places are same!");
      return;
    }
    if (Departure === Stop1 ||   Destination === Stop1 || Departure === Stop2 ||   Destination === Stop2) {
        alert("The Places are same!");
        return;
    }
    if(!tabcity.includes(Departure) || !tabcity.includes(Destination)){
        alert("Cities are not in the System for now");
        return;
    }
    if((Stop2.lenght>3 && !tabcity.includes(Stop2))){
        alert("Cities are not in the System for now");
        return;
    }
    if((Stop1.lenght>3 && !tabcity.includes(Stop1))){
      alert("Cities are not in the System for now");
      return;
  }
    if (compareTimes(Time2, Time1)) {
        alert("Time is Not Right!");
        return;
    }
    if (!isDateGreaterThanToday(Date)) {
        alert("Date is Not Right!");
        return;
    }
    const form = document.getElementById('Form');
    var confirmed = confirm("NO Smoking ?");
    if(confirmed){
        const input = document.createElement('input');
            input.setAttribute('type', 'hidden');
            input.setAttribute('name', 'Smoking');
            input.setAttribute('value', 'no');
            form.appendChild(input);
    }
    else{
        const input = document.createElement('input');
            input.setAttribute('type', 'hidden');
            input.setAttribute('name', 'Smoking');
            input.setAttribute('value', 'yes');
            form.appendChild(input);
    }
    var Prix = enterPrice();
    if (Prix !== null) {
        const input = document.createElement('input');
            input.setAttribute('type', 'hidden');
            input.setAttribute('name', 'Prix');
            input.setAttribute('value', Prix);
            form.appendChild(input);
        this.submit();
    }
    

  });