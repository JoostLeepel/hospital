<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Afspraken</title>
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@5.10.0/main.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@5.10.0/main.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-6">Admin Dashboard – Afsprakenbeheer</h1>

        <!-- Button voor Nieuwe Afspraak -->
        <div class="mb-4">
            <a href="/admin/appointments/create" class="bg-red-500 text-white p-2 rounded-md">
                Nieuwe Afspraak Aanmaken
            </a>
        </div>

        <!-- Kalenderweergave -->
        <div id="calendar"></div>

        <!-- Modal voor afspraak toevoegen -->
        <div id="appointmentModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-6 rounded-lg w-full max-w-md relative">
                <button id="closeModalBtn" class="absolute top-2 right-2 text-xl font-bold">&times;</button>
                <h2 class="text-lg font-bold mb-4">Nieuwe activiteit</h2>

                <form id="appointmentForm">
                    <div class="mb-4">
                        <label for="title" class="block">Titel van de activiteit</label>
                        <input type="text" id="title" name="title" class="border border-gray-300 p-2 w-full" required />
                    </div>

                    <div class="mb-4">
                        <label for="start" class="block">Starttijd</label>
                        <input type="datetime-local" id="start" name="start" class="border border-gray-300 p-2 w-full" required />
                    </div>

                    <div class="mb-4">
                        <label for="end" class="block">Eindtijd</label>
                        <input type="datetime-local" id="end" name="end" class="border border-gray-300 p-2 w-full" required />
                    </div>

                    <button type="submit" class="bg-blue-500 text-white p-2 rounded-md w-full">Opslaan</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@5.10.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@5.10.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@5.10.0/main.min.js"></script>
</body>

</html>
