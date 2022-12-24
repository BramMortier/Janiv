<?php 
    $gameInfo = $data["gameInfo"];
    $gameScores = $data["gameScores"];
    $gameId = $data["gameId"];
?>

<?php include PROJ_ROOT . "/app/views/partials/head.php" ?>

<body>

    <?php include PROJ_ROOT . "/app/views/partials/header.php" ?>

    <main>
        <div class="overlay"></div>

        <section class="scoreboard container">

            <h3 class="subtle text-space-lg">Scoreboard</h3>
            <h4 class="center text-space-md bold">Round <?= $gameInfo->round ?? 0 ?></h4>

            <ul class="scoreboard__grid">

                <?php foreach($gameScores as $index => $scoreSheet): ?>

                    <?php include PROJ_ROOT . "/app/views/game/scoreSheet.php" ?>

                <?php endforeach; ?>

            </ul>

            <div class="scoreboard__btns scoreboard__btns--open">
                <button class="scoreboard__add-round btn btn--small btn--primary">New round</button>
                <button class="scoreboard__delete-round btn btn--small btn--secondary">Delete round</button>
            </div>

            <?php include PROJ_ROOT . "/app/views/menus/newRoundMenu.php" ?>

            <?php include PROJ_ROOT . "/app/views/menus/deleteRoundMenu.php" ?>

            <?php include PROJ_ROOT . "/app/views/menus/settingsMenu.php"; ?>

        </section>
    </main>

    <?php include PROJ_ROOT . "/app/views/partials/footer.php" ?>

</body>
</html>