window.addEventListener('scroll', function() {
    var navigation = document.querySelector('.navigation');
    var navigationLinks = document.querySelectorAll('.navigation a');

    if (window.scrollY > 100) {
        navigation.style.backgroundColor = 'rgba(0,0,0,0.9)';
        navigation.style.transition = 'background-color 0.5s ease-in-out';

        navigationLinks.forEach(function(link) {
            link.style.color = '#ffffff';
            link.style.transition = 'color 0.3s ease-in-out';
        });
    } else {
        navigation.style.backgroundColor = '';
        navigationLinks.forEach(function(link) {
            link.style.color = '';
        });
    }
});
