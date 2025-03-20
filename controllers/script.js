function updateSummary() {
    document.getElementById("recap_family_name").textContent = document.querySelector("input[name='family_name']").value;
    document.getElementById("recap_name").textContent = document.querySelector("input[name='name']").value;
    document.getElementById("recap_email").textContent = document.querySelector("input[name='email']").value;
    document.getElementById("recap_date").textContent = document.querySelector("input[name='date']").value;
    document.getElementById("recap_time_slot").textContent = document.querySelector("select[name='time_slot']").value;
    document.getElementById("recap_places").textContent = document.querySelector("input[name='places']").value;
}

document.querySelectorAll("#reservationForm input, #reservationForm select").forEach(element => {
    element.addEventListener("input", updateSummary);
});

window.onload = updateSummary;