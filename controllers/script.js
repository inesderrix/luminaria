let currentStep = 1;

function nextStep(step) {
    if (validateStep(step)) {
        document.getElementById(`step${step}`).classList.remove('active');
        document.getElementById(`step${step + 1}`).classList.add('active');
        currentStep = step + 1;
        updateRecap();
        updateBreadcrumb();
    }
}


function validateStep(step) {
    const inputs = document.querySelectorAll(`#step${step} input, #step${step} select`);
    for (let input of inputs) {
        if (!input.value) {
            alert('Veuillez remplir tous les champs.');
            return false;
        }
    }
    return true;
}

function updateRecap() {
    document.getElementById('recap_family_name').innerText = document.querySelector('input[name="family_name"]').value;
    document.getElementById('recap_name').innerText = document.querySelector('input[name="name"]').value;
    document.getElementById('recap_email').innerText = document.querySelector('input[name="email"]').value;
    document.getElementById('recap_date').innerText = document.querySelector('input[name="date"]').value;
    document.getElementById('recap_time_slot').innerText = document.querySelector('input[name="time_slot"]:checked')?.value || 'Non sélectionné';
    document.getElementById('recap_places').innerText = document.querySelector('input[name="places"]').value;
}

function updateBreadcrumb() {
    const steps = ["Réservation", "Inscription", "Récapitulatif", "Confirmation"];
    let breadcrumbHTML = steps.map((step, index) => {
        return `<span class="${index + 1 === currentStep ? 'current' : ''}">${step}</span>`;
    }).join(' > ');
    document.getElementById('breadcrumb').innerHTML = breadcrumbHTML;
}

