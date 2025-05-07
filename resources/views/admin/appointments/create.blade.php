<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Nieuwe Afspraken</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-6">Nieuwe Afspraak Aanmaken</h1>

        <!-- Formulier voor het aanmaken van een afspraak -->
        <form action="{{ route('appointments.store') }}" method="POST">
            @csrf

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

            <button type="submit" class="bg-blue-500 text-white p-2 rounded-md w-full">Afspraken Opslaan</button>
        </form>

        <!-- Link om terug te gaan naar het dashboard -->
        <a href="{{ route('dashboard') }}" class="mt-4 text-blue-500">Terug naar de kalender</a>
    </div>
</body>

</html>
