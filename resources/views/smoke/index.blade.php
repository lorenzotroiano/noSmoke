<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/js/app.js'])
    <title>Stop Smoking</title>
    <style>
        #timeColumns {
            background: gray;
            border: solid black 1px;
        }

        .time-column {
            display: inline-block;
            width: 20px;
            /* Larghezza iniziale delle colonne */
            height: 0;
            /* Altezza iniziale delle colonne */
            border-top-right-radius: 10px;
            margin: 0 5px;
            /* Margine tra le colonne */
            transition: height 0.5s ease-out;
            /* Animazione dell'altezza */
        }

        .col-y {
            background-color: red
        }

        .col-m {
            background-color: rgb(255, 119, 0)
        }

        .col-w {
            background-color: rgba(255, 242, 0, 0.923)
        }

        .col-d {
            background-color: rgba(94, 255, 0, 0.923)
        }

        .col-h {
            background-color: rgba(0, 251, 255, 0.923)
        }

        .col-m {
            background-color: rgba(0, 17, 255, 0.923)
        }

        .col-s {
            background-color: rgba(162, 0, 255, 0.923)
        }

        #elapsedTime {
            font-size: 18px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Calcolatore del tempo trascorso senza fumare</h1>

        @if ($stopSmoking)
            <p>Ultima sigaretta: {{ $stopSmoking->data_fine->format('d/m/Y') }}</p>
            <p id="elapsedTime"></p>
            <div id="timeColumns">
                <div class="time-column col-y" id="yearsColumn"></div>
                <div class="time-column col-m" id="monthsColumn"></div>
                <div class="time-column col-w" id="weeksColumn"></div>
                <div class="time-column col-d" id="daysColumn"></div>
                <div class="time-column col-h" id="hoursColumn"></div>
                <div class="time-column col-m" id="minutesColumn"></div>
                <div class="time-column col-s" id="secondsColumn"></div>
            </div>
        @endif

        <form method="post" action="{{ route('smoke.update') }}">
            @csrf
            <label for="data_fine">Inserisci la data della tua ultima sigaretta:</label>
            <input type="date" id="data_fine" name="data_fine" required>

            <button type="submit" class="btn btn-outline-primary">Aggiorna</button>
        </form>
    </div>


    <script>
        function updateElapsedTime() {
            var stopDate = new Date("{{ $stopSmoking->data_fine }}");
            var currentDate = new Date();

            var elapsedTime = currentDate - stopDate;

            var seconds = Math.floor(elapsedTime / 1000);
            var minutes = Math.floor(seconds / 60);
            var hours = Math.floor(minutes / 60);
            var days = Math.floor(hours / 24);
            var weeks = Math.floor(days / 7);
            var months = Math.floor(days / 30);
            var years = Math.floor(months / 12);

            document.getElementById('elapsedTime').innerHTML =
                'Tempo trascorso: ' +
                years + ' anni, ' +
                months % 12 + ' mesi, ' +
                weeks % 4 + ' settimane, ' +
                days % 7 + ' giorni, ' +
                hours % 24 + ' ore, ' +
                minutes % 60 + ' minuti, ' +
                seconds % 60 + ' secondi';

            // Aggiorna l'altezza delle colonne in base al tempo
            document.getElementById('yearsColumn').style.height = years * 10 + 'px';
            document.getElementById('monthsColumn').style.height = (months % 12) * 10 + 'px';
            document.getElementById('weeksColumn').style.height = (weeks % 4) * 10 + 'px';
            document.getElementById('daysColumn').style.height = (days % 7) * 10 + 'px';
            document.getElementById('hoursColumn').style.height = (hours % 24) * 10 + 'px';
            document.getElementById('minutesColumn').style.height = (minutes % 60) * 5 + 'px';
            document.getElementById('secondsColumn').style.height = (seconds % 60) * 2 + 'px';
        }

        setInterval(updateElapsedTime, 1000);
        updateElapsedTime(); // Aggiorna all'avvio per evitare un ritardo nell'animazione
    </script>
</body>

</html>
