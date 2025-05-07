import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';

document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    const modal = document.getElementById("appointmentModal");

    const calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        selectable: true,
        editable: true,
        events: '/admin/appointments/data', // Zorg ervoor dat je een endpoint hebt dat de bestaande afspraken ophaalt
        dateClick: function (info) {
            openAppointmentModal(info.dateStr);  // Open de modal met geselecteerde datum
        }
    });

    calendar.render();

    // Open de modal met de geselecteerde datum
    function openAppointmentModal(dateStr) {
        modal.classList.remove("hidden");

        // Zet de start- en eindtijd naar de geselecteerde datum
        const now = new Date();
        const timeStr = now.toTimeString().slice(0, 5); // Stel de tijd in op nu
        const datetime = dateStr + 'T' + timeStr;

        document.getElementById("start").value = datetime;
        document.getElementById("end").value = datetime;

        // Optioneel: Voeg de geselecteerde datum als titel voor de activiteit
        document.getElementById("title").value = "Nieuwe activiteit op " + dateStr;
    }

    // Sluit de modal wanneer je op de sluitknop klikt
    document.getElementById("closeModalBtn").onclick = function () {
        modal.classList.add("hidden");
    }

    // Sluit de modal als je ergens buiten de modal klikt
    window.onclick = function (event) {
        if (event.target === modal) {
            modal.classList.add("hidden");
        }
    }

    // Verzend het formulier voor het toevoegen van de afspraak
    document.getElementById('appointmentForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const title = document.getElementById('title').value;
        const start = document.getElementById('start').value;
        const end = document.getElementById('end').value;

        // AJAX-aanroep om de afspraak op te slaan
        fetch('/admin/appointments', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                title: title,
                start: start,
                end: end
            })
        })
        .then(res => res.json())
        .then((appointment) => {
            // Voeg de afspraak toe aan de kalender
            calendar.addEvent({
                title: appointment.title,
                start: appointment.start,
                end: appointment.end
            });

            // Sluit de modal
            modal.classList.add("hidden");
        })
        .catch(error => {
            console.error('Er is een fout opgetreden:', error);
        });
    });
});
