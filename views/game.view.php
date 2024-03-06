<?php
use Rpg\Enums\Levels;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chroniques d'Eldoria : L'Épopée des Royaumes Perdus</title>
    <link href="public/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="public/game.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="public/assets/logo.ico">
    <link href="https://cdn.jsdelivr.net/npm/prismjs@1.25.0/themes/prism-tomorrow.min.css" rel="stylesheet">
</head>
<body>

    <div class="devmode-btn">
        <button class="btn btn-disable" onclick="toggleDevMenu()">Details [Esc]</button>
    </div>

    <div class="game-container">
        <div class="game-topbar">
            <div class="datetime-container">
                <p class="datetime" id="dt"><!-- in js --></p>
            </div>
            <h1 class="game-title">Chroniques d'Eldoria : L'Épopée des Royaumes Perdus</h1>
        </div>

        <div class="p-2 h-100">
            <?php $game->run(); ?>
        </div>
    </div>

    <div class="devmenu-container" id="devmenu">
        <div class="container">
            <div class="d-flex flex-row justify-content-between">
                <form method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir reprendre de 0 ?')">
                    <div class="m-3">
                        <input type="hidden" name="form" value="reset-storage"/>
                        <button type="submit" class="btn btn-danger">Reset</button>
                    </div>
                </form>
                <div class="m-3"><button class="btn btn-disable" onclick="toggleDevMenu()">Close</button></div>
            </div>
            <div class="end-0 font-monospace border game-logs-container bg-body-secondary">
                <ul class="list-group list-group-flush">
                    <?php foreach($game->logs as $log): ?>
                    <li class="list-group-item"><pre><?= $log  ?></pre></li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
        <pre class="code-block"><code class="language-javascript"><?= var_export($game)?></code></pre>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.25.0/prism.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        function toggleDevMenu(){
            let menu = document.getElementById("devmenu")
            menu.classList.toggle("visible");
        }
        let datetime = document.getElementById("dt");
        let date = new Date()
        datetime.innerHTML = `${date.getHours()}:${date.getMinutes() <= 9 ? "0" + date.getMinutes(): date.getMinutes()}:${date.getSeconds() <= 9 ? "0" + date.getSeconds(): date.getSeconds()}`;
        setInterval(() => {
            date = new Date()
            datetime.innerHTML = `${date.getHours()}:${date.getMinutes() <= 9 ? "0" + date.getMinutes(): date.getMinutes()}:${date.getSeconds() <= 9 ? "0" + date.getSeconds(): date.getSeconds()}`;
        }, 100);
        document.addEventListener('DOMContentLoaded', function() {
            Prism.highlightAll();
        });
        document.addEventListener("keydown", function(event) {
          if (event.key === "Escape") {
            var element = document.getElementById("devmenu");
            element.classList.toggle("visible");
          }
        });
    </script>
    <?php
        $gamebg = match($game->gameContext->getLevel()){
            Levels::OVERWORLD => "overworld.bg.png",
            Levels::MISTS => "mist.bg.jpg",
            Levels::CAVE => "cave.bg.jpg",
            Levels::HELL => "hell.bg.jpg"
        };
    ?>
    <style>
        body{
            min-height: 100vh;
            background-image: url("/public/assets/gameassets/<?= $gamebg ?>");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</body>
</html>
