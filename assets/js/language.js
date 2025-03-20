function changeLanguage() {
    const languageSelect = document.querySelectorAll('.language-selector select');

    languageSelect.forEach(select => {
        select.addEventListener('change', (e) => {
            const language = e.target.value;
            const nompage = window.location.pathname;

            if (nompage.includes('apropos')) {
                window.location.href = language === 'fr' ? 'aproposfr.html' : 'aproposen.html';
            } else if (nompage.includes('index')) {
                window.location.href = language === 'fr' ? 'indexfr.html' : 'indexen.html';
            } else if (nompage.includes('reservation')) {
                window.location.href = language === 'fr' ? 'reservationfr.html' : 'reservationen.html';
            }
        });
    });
}

function LanguageSelector() {
    const languageSelect = document.querySelectorAll('.language-selector select');
    const nompage = window.location.pathname;

    let language = 'fr';
    if (nompage.includes('en')) language = 'en';

    languageSelect.forEach(select => {
        select.value = language;
    });
}


document.addEventListener('DOMContentLoaded', () => {
    changeLanguage();
    LanguageSelector();
});
