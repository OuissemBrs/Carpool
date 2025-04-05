let ok = document.querySelectorAll('#ok');
let no = document.querySelectorAll('#no');
const id= document.getElementById('return').className;

document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape' || event.key === 'Esc') {
        var co = confirm("Supprime le journey ?");
        if(co){
        const form = document.createElement('form');
    form.setAttribute('method', 'post');
    form.setAttribute('action', 'php/deletejourney.php');


            const input = document.createElement('input');
            input.setAttribute('type', 'hidden');
            input.setAttribute('name', 'id');
            input.setAttribute('value', id);
            form.appendChild(input);
            document.body.appendChild(form);
    form.submit();
        }
        
    }
});

ok.forEach(element => {element.addEventListener('click', function(event) {
    const parentDiv = element.closest('div');
    const parentDiv1 = parentDiv.closest('div');
    const id= document.getElementById('personne').className;
    const requestBody = {
        statu : 'accept',
        phone: parentDiv.id,
        id: id
    };
    const form = document.createElement('form');
    form.setAttribute('method', 'post');
    form.setAttribute('action', '');

    for (const key in requestBody) {
        if (requestBody.hasOwnProperty(key)) {
            const input = document.createElement('input');
            input.setAttribute('type', 'hidden');
            input.setAttribute('name', key);
            input.setAttribute('value', requestBody[key]);
            form.appendChild(input);
        }
    }
    window.history.back();
    document.body.appendChild(form);
    form.submit();
    document.body.removeChild(form);
    localStorage.setItem("idpage",id);

});
});
no.forEach(element => {element.addEventListener('click', function(event) {
    const parentDiv = element.closest('div');
    const parentDiv1 = parentDiv.closest('div');
    const id= document.getElementById('personne').className;
    const requestBody = {
        statu: 'refuse',
        phone: parentDiv.id,
        id: id
    };
    const form = document.createElement('form');
    form.setAttribute('method', 'post');
    form.setAttribute('action', '');
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
    localStorage.setItem("idpage",id);

});
});
function returnback(){
    window.location.href = "driver.php";
}



