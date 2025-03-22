document.addEventListener('DOMContentLoaded', () => {
    const monthNames = {
        fr: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
        en: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
    };

    const daysGrid = document.querySelector('.days-grid');
    const currentMonth = document.getElementById('currentMonth');
    const prevMonthBtn = document.getElementById('prevMonth');
    const nextMonthBtn = document.getElementById('nextMonth');
    const selectedDateInput = document.getElementById('selectedDate');

   
    function getLangFromURL() {
        const params = new URLSearchParams(window.location.search);
        return params.get('lang') === 'en' ? 'en' : 'fr'; 
    }

    const userLang = getLangFromURL();

    let date = new Date();
    let currentYear = date.getFullYear();
    let currentMonthIndex = date.getMonth();

    function renderCalendar() {
        document.querySelectorAll('.day:not(.day-name)').forEach(day => day.remove());

        currentMonth.textContent = `${monthNames[userLang][currentMonthIndex]} ${currentYear}`;

        const firstDay = new Date(currentYear, currentMonthIndex, 1).getDay();
        const daysInMonth = new Date(currentYear, currentMonthIndex + 1, 0).getDate();

        const adjustedFirstDay = firstDay === 0 ? 6 : firstDay - 1;

        for (let i = 0; i < adjustedFirstDay; i++) {
            daysGrid.innerHTML += '<div class="day empty"></div>';
        }

        for (let day = 1; day <= daysInMonth; day++) {
            const today = new Date();
            const dayElement = document.createElement('div');
            dayElement.classList.add('day');
            dayElement.textContent = day;
            const dayDate = new Date(currentYear, currentMonthIndex, day);

            if (dayDate < today.setHours(0, 0, 0, 0)) {
                dayElement.classList.add('past');
            } else {
                dayElement.addEventListener('click', () => selectDate(dayDate));
            }
            daysGrid.appendChild(dayElement);
        }
    }

    function selectDate(date) {
        const formattedDate = `${date.getDate()}/${date.getMonth() + 1}/${date.getFullYear()}`;
        selectedDateInput.value = formattedDate;
        document.querySelectorAll('.day').forEach(day => day.classList.remove('selected'));
        event.target.classList.add('selected');
    }

    prevMonthBtn.addEventListener('click', () => {
        if (currentMonthIndex === 0) {
            currentMonthIndex = 11;
            currentYear--;
        } else {
            currentMonthIndex--;
        }
        renderCalendar();
    });

    nextMonthBtn.addEventListener('click', () => {
        if (currentMonthIndex === 11) {
            currentMonthIndex = 0;
            currentYear++;
        } else {
            currentMonthIndex++;
        }
        renderCalendar();
    });

    renderCalendar();
});

function changeValue(delta) {
    const input = document.getElementById('visitorCount');
    let value = parseInt(input.value) + delta;

    if (value < 1) value = 1;
    if (value > 10) value = 10;

    input.value = value;
    updateRecap();
}