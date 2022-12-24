<?php 
    $games = $data["games"];
?>

<?php include PROJ_ROOT . "/app/views/partials/head.php" ?>

<body>

    <?php include PROJ_ROOT . "/app/views/partials/header.php" ?>

    <main>
        <div class="overlay"></div>

        <section class="action-btns container">

            <h3 class="subtle text-space-sm">Menu</h3>
            <div class="action-btns__grid">

                <a href="/game/create" class="action-btns__btn">
                    <img src="/assets/play-circle.svg" alt="new game btn">
                    <p class="subtle">Start new game</p>
                </a>

                <a href="/dashboard/info" class="action-btns__btn">
                    <img src="/assets/info-circle.svg" alt="new game btn">
                    <p class="subtle">Game rules</p>
                </a>

                <a href="/game/load" class="action-btns__btn">
                    <img src="/assets/download.svg" alt="new game btn">
                    <p class="subtle">Load game</p>
                </a>

            </div>

        </section>

        <section class="games container">

            <h3 class="subtle text-space-sm">Recent Games</h3>
            <ul class="games__list">

                <?php if(!$games): ?> 

                    <div class="games__empty-message">
                        <p class="center text-sm subtle">
                            No games saved, <br /> 
                            start a new one
                        </p>
                        <a href="/game/create">
                            <button class="btn btn--primary btn--small btn--icon">
                                New game
                                <img src="/assets/plus.svg" alt="add player icon">
                            </button>
                        </a>
                    </div>
                    
                <?php endif; ?>

                <?php foreach($games as $index => $game): ?>

                    <?php include PROJ_ROOT . "/app/views/game/gameCard.php"; ?>

                <?php endforeach; ?>

            </ul>
            
            <?php if($games): ?><p class="subtle center text-sm">View more</p> <?php endif; ?>

        </section>

    </main>

    <?php include PROJ_ROOT . "/app/views/partials/footer.php" ?>

</body>
</html>




