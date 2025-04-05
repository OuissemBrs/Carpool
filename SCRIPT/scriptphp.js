let voyagdetElements = document.querySelectorAll('.Voyage');

voyagdetElements.forEach(element => {
    element.addEventListener('click', function() {
        let id = this.id;
        console.log("Clicked element ID:", id);
        let url = './journey.php?id=' + encodeURIComponent(id);
        window.location.href = url;
    });
});

