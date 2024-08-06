document.addEventListener('DOMContentLoaded', function () {
    var coll = document.getElementsByClassName("collapsible");
    var content = document.getElementById('content');

    function setCollapsibleState() {
        if (localStorage.getItem('collapsibleState') === 'open') {
            content.style.display = "block";
        } else {
            content.style.display = "none";
        }
    }

    setCollapsibleState();

    coll[0].addEventListener("click", function() {
        if (content.style.display === "block") {
            content.style.display = "none";
            localStorage.setItem('collapsibleState', 'closed');
        } else {
            content.style.display = "block";
            localStorage.setItem('collapsibleState', 'open');
        }
    });

    Livewire.hook('message.processed', (message, component) => {
        setCollapsibleState();
    });
});