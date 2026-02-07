import './bootstrap';

import.meta.glob([
    '../images/**'
]);

document.addEventListener("DOMContentLoaded", function () {
    const candidateRadio = document.getElementById("candidate");
    const employerRadio = document.getElementById("employer");
    const employerFields = document.getElementById("employerFields");

    function toggleEmployerFields() {
        if (employerRadio.checked) {
            employerFields.style.display = "block";
        } else {
            employerFields.style.display = "none";
        }
    }

    toggleEmployerFields();

    candidateRadio.addEventListener("change", toggleEmployerFields);
    employerRadio.addEventListener("change", toggleEmployerFields);
});

document.addEventListener('DOMContentLoaded', function() {
    const flashMessages = document.querySelectorAll('.fixed.top-4');
    
    flashMessages.forEach(message => {
        setTimeout(() => {
            message.style.opacity = '0';
            message.style.transition = 'opacity 0.5s ease-out';
            setTimeout(() => message.remove(), 500);
        }, 5000);
    });
});