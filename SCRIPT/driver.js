let manger = document.querySelectorAll('.blue');


manger.forEach(element => {
    element.addEventListener('click', function() {
        const requestBody = {
            id: this.id
        };
        

    const form = document.createElement('form');
    form.setAttribute('method', 'post');
    form.setAttribute('action', 'mange.php');
    for (const key in requestBody) {
        if (requestBody.hasOwnProperty(key)) {
            
            const input = document.createElement('input');
            input.setAttribute('type', 'hidden');
            input.setAttribute('name', key);
            input.setAttribute('value', requestBody[key]);
            form.appendChild(input);
        }
    }
    document.body.appendChild(form);
    form.submit();

    document.body.removeChild(form);
    
    });
});



document.addEventListener("DOMContentLoaded", function() {
    const experience = document.getElementById("experience").value;
    const category = document.getElementById("category").value;
    const delay = document.getElementById("delay").value;
    const phone = document.getElementById("phone").value;
    document.addEventListener("keypress", function(event) {
        if (event.keyCode === 13) {
            var newexperience = document.getElementById("experience").value;
            var newcategory = document.getElementById("category").value;
            var newdelay = document.getElementById("delay").value;
            var newphone = document.getElementById("phone").value;
            let newdata = {};
            if(newexperience !== experience ){
                alert("Experience Cannot Be Changed!");
                document.getElementById("experience").value = experience;
            }
            if(newphone !== phone && newphone.length === 10 && newphone.charAt(0) === '0'){
                newdata["Phone"] = newphone;
            }
            if(newcategory !== category && (newcategory === 'bus' || newcategory === 'car')){
                newdata["Category"] = newcategory;
            }
            if(newdelay !== delay ){
                alert("Delay is a data Cannot Be Changed! but Can be gained!");
                document.getElementById("delay").value = delay;
            }
            if (Object.keys(newdata).length !== 0) {
                const form = document.createElement('form');
                form.setAttribute('method', 'post');
                form.setAttribute('action', 'php/upddriver.php');
                for (const key in newdata) {
                    if (newdata.hasOwnProperty(key)) {
                        const input = document.createElement('input');
                        input.setAttribute('type', 'hidden');
                        input.setAttribute('name', key);
                        input.setAttribute('value', newdata[key]);
                        form.appendChild(input);
                    }
                }
                        document.body.appendChild(form);
                        form.submit();
                    
                        document.body.removeChild(form);
                        
                        event.preventDefault();
                        document.getElementById("myForm").submit();
                        }
        }
    });
});
document.getElementById("mybutton").addEventListener("click", function() {
    window.location.href = "NewJourney.php";
  });