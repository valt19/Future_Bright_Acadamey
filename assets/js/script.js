document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.querySelector('.nav-toggle');
    const nav = document.querySelector('.main-nav');

    if (toggleButton && nav) {
        toggleButton.addEventListener('click', function () {
            nav.classList.toggle('is-open');
        });
    }
});
