var mobileTrigger = document.querySelector('.mobileTrigger'),
    overlay = document.querySelector('.overlay'),
    // get all links that should be smooth scrolling
    navLinks = [].slice
        .call(document.querySelectorAll('a[href]'))
        .filter(function(tag) {
            return tag.hash;
        });


if (mobileTrigger) {
    mobileTrigger.addEventListener('click', function() {
        overlay.classList.toggle('visible');
    });
}

navLinks.forEach(function(navLink) {
    navLink.addEventListener('click', function(e) {
        overlay.classList.remove('visible');
        e.preventDefault();

        var section = document.querySelector(e.target.hash);

        if (!section) {
            return;
        }

        window.scroll({
            top: window.scrollY + section.getBoundingClientRect().top - 120,
            left: 0,
            behavior: 'smooth',
        });
    });
});

window.addEventListener('hashchange', function(e) {
    e.preventDefault();
});
