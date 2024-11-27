document.addEventListener("DOMContentLoaded", function(){
    var button = document.getElementById('darkmodebtn');

    function applyDarkModeToImages() {
        var images = document.querySelectorAll('img');
        for (var i = 0; i < images.length; i++) {
            images[i].style.filter = 'invert(95%) hue-rotate(180deg)';
        }
    }

    function removeDarkModeFromImages() {
        var images = document.querySelectorAll('img');
        for (var i = 0; i < images.length; i++) {
            images[i].style.filter = 'none';
        }
    }

    button.addEventListener('click', function(){
        document.body.classList.toggle('darkbody');
        if(document.body.classList.contains('darkbody')){
            applyDarkModeToImages();
            localStorage.setItem('darkMode', 'enabled');
            button.textContent = '☀️';
        } else {
            removeDarkModeFromImages();
            localStorage.removeItem('darkMode');
            button.textContent = '🌙';
        }
    });

    if(localStorage.getItem('darkMode') === 'enabled'){
        document.body.classList.add('darkbody');
        button.textContent = '☀️';
        applyDarkModeToImages();
    } else {
        document.body.classList.remove('darkbody');
        button.textContent = '🌙';
    }

    var observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.addedNodes.length > 0 && document.body.classList.contains('darkbody')) {
                applyDarkModeToImages();
            }
        });
    });

    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
});
