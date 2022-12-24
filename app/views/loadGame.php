<?php 
    $games = $data["games"];
    $query = $data["query"];
?>

<?php include PROJ_ROOT . "/app/views/partials/head.php" ?>

<body>

    <?php include PROJ_ROOT . "/app/views/partials/header.php" ?>

    <main>

        <section class="filters">
            <form action="/game/load" method="POST" class="filters__form">

                <div class="filters__top">
                    <h3 class="subtle">Load game</h3>
                    <div class="filters__toggle">
                        <label class="text-xs subtle" for="finished-games">Hide finished games</label>
                        <input 
                            class="filters__checkbox"
                            type="checkbox" 
                            name="finishedGames"
                        />
                    </div>
                </div>
                <div class="filters__search">
                    <input 
                        class="input input--inverted" 
                        type="text"
                        placeholder="Search"
                        name="query"
                        value="<?= $query ?>"
                    />
                    <button class="btn btn--primary btn--small">Search</button>
                </div>

            </form>
        </section>

        <section class="games container">

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