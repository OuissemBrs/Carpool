

document.addEventListener("DOMContentLoaded", function() {
    const name = document.getElementById("name").value;
    const phone = document.getElementById("phone").value;
    const gmail = document.getElementById("gmail").value;
    document.addEventListener("keypress", function(event) {
        if (event.keyCode === 13) {
            var newname = document.getElementById("name").value;
            var newphone = document.getElementById("phone").value;
            var newgmail = document.getElementById("gmail").value;
            let newdata = {};
            if(newname !== name){
                newdata["name"] = newname;
            }
            if(newphone !== phone && newphone.length === 10){
                newdata["Phone"] = newphone;
            }
            if(newgmail !== gmail){
                newdata["gmail"] = newgmail;
            }
            if (Object.keys(newdata).length !== 0) {
                const form = document.createElement('form');
                form.setAttribute('method', 'post');
                form.setAttribute('action', 'php/updpersonne.php');
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