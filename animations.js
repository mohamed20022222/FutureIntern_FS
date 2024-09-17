document.addEventListener('DOMContentLoaded', function() {
    const introSection = document.querySelector('.intro');

    function checkScroll() {
        const introPosition = introSection.getBoundingClientRect().top;
        const screenPosition = window.innerHeight / 1.3;

        if (introPosition < screenPosition) {
            introSection.classList.add('show');
        }
    }

    window.addEventListener('scroll', checkScroll);
    checkScroll(); // Initial check on page load
});
