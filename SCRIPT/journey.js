let btn = document.querySelectorAll('.reserve');

btn.forEach(element => {
    element.addEventListener('click', function() {
        const form = document.createElement('form');
        form.setAttribute('method', 'get');
        form.setAttribute('action', 'php/requestreservation.php');
                const input = document.createElement('input');
                input.setAttribute('type', 'hidden');
                input.setAttribute('name', 'id');
                input.setAttribute('value', this.id);
                form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
        document.body.removeChild(form);
    });
});
