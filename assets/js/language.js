function updateLinkLanguage() {
    const languageSelect = document.querySelectorAll('.language-selector select');
    const reserveLink = document.querySelector('.reserve');
    const language = languageSelect[0].value; 
    if (reserveLink) {
        reserveLink.href = `index.php?lang=${language}`;
    }
}

function changeLanguage() {
    const languageSelect = document.querySelectorAll('.language-selector select');

    languageSelect.forEach(select => {
        select.addEventListener('change', (e) => {
            const language = e.target.value;
            const nompage = window.location.pathname;

            if (nompage.includes('apropos')) {
                window.location.href = language === 'fr' ? 'aproposfr.html' : 'aproposen.html';
            }
            updateLinkLanguage();
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

    updateLinkLanguage();
}


document.addEventListener('DOMContentLoaded', () => {
    changeLanguage();
    LanguageSelector();
});
