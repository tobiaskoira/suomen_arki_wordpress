document.addEventListener("DOMContentLoaded", function () {
    const languageSwitcher = document.querySelector(".language-switcher");
    const languageMenu = document.querySelector(".language-menu");
    let hideTimeout;

    // Показываем меню при наведении
    languageSwitcher.addEventListener("mouseenter", function () {
        clearTimeout(hideTimeout); // Отменяем скрытие, если пользователь вернулся
        languageMenu.style.display = "block";
    });

    // Задержка перед скрытием меню
    languageSwitcher.addEventListener("mouseleave", function () {
        hideTimeout = setTimeout(function () {
            languageMenu.style.display = "none";
        }, 2000); // 2 секунды задержки
    });
});

document.addEventListener('wpcf7mailsent', function(event) {
    console.log('Contact Form 7: Form submission was successful.');
}, false);

document.addEventListener('wpcf7mailsent', function(event) {
    const form = document.querySelector('.wpcf7');
    const feedbackMessage = document.createElement('div');
    feedbackMessage.className = 'custom-feedback';
    feedbackMessage.innerHTML = '<p>Thank you! Your message has been sent successfully.</p>';
    form.innerHTML = feedbackMessage.outerHTML;
}, false);
