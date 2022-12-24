<?php 
    $createdGame = $data["createdGame"];
?>

<?php include PROJ_ROOT . "/app/views/partials/head.php" ?>

<body>

    <?php include PROJ_ROOT . "/app/views/partials/header.php" ?>

    <main>

        <section class="game-settings container">

            <h3 class="subtle text-lg text-space-md">Game settings</h3>

            <form class="game-settings__form" action="/game/create" method="POST">

                <div class="game-settings__name form-group">
                    <label for="gameName">Game name</label>
                    <input 
                        class="input input--inverted <?= $createdGame->gameNameErr ? "input--invalid" : "" ?>" 
                        type="text" 
                        name="gameName"
                        placeholder="Choose a name"
                        value="<?= $createdGame->gameName ?>"
                    />
                    <span class="input-error">
                        <img 
                            class="error-icon <?= $createdGame->gameNameErr ? "error-icon--show" : "" ?>" 
                            src="/assets/error-circle.svg" 
                            alt="error icon"
                        />
                        <?= $createdGame->gameNameErr ?>
                    </span>
                </div>

                <div class="game-settings__losing-score form-group">
                    <label for="losingScore">Losing score</label>
                    <input 
                        class="input input--inverted <?= $createdGame->losingScoreErr ? "input--invalid" : "" ?>" 
                        type="number" 
                        name="losingScore"
                        placeholder="Set the losing score"
                        value="<?= $createdGame->losingScore ?>"
                    />
                    <span class="input-error">
                        <img 
                            class="error-icon <?= $createdGame->losingScoreErr ? "error-icon--show" : "" ?>" 
                            src="/assets/error-circle.svg" 
                            alt="error icon"
                        />
                        <?= $createdGame->losingScoreErr ?>
                    </span>
                </div>

                <div class="game-settings__players form-group">
                    <label class="text-space-xxxs" for="players[]">Players</label>

                    <div class="game-settings__players-list">

                        <div class="game-settings__player">
                            <div class="game-settings__player-icon">
                                <img src="/assets/person-inverted.svg" alt="player icon">
                            </div>
                            <input 
                                class="input input--inverted <?= $createdGame->playersErr ? "input--invalid" : "" ?>" 
                                type="text"
                                name="players[]"
                                placeholder="Playername"
                            />
                            <button class="game-settings__player-delete">
                                <img src="/assets/trashcan.svg" alt="trashcan icon">
                            </button>
                        </div>
    
                        <div class="game-settings__player">
                            <div class="game-settings__player-icon">
                                <img src="/assets/person-inverted.svg" alt="player icon">
                            </div>
                            <input 
                                class="input input--inverted <?= $createdGame->playersErr ? "input--invalid" : "" ?>" 
                                type="text"
                                name="players[]"
                                placeholder="Playername"
                            />
                            <button class="game-settings__player-delete">
                                <img src="/assets/trashcan.svg" alt="trashcan icon">
                            </button>
                        </div>
    
                        <div class="game-settings__player">
                            <div class="game-settings__player-icon">
                                <img src="/assets/person-inverted.svg" alt="player icon">
                            </div>
                            <input 
                                class="input input--inverted <?= $createdGame->playersErr ? "input--invalid" : "" ?>" 
                                type="text"
                                name="players[]"
                                placeholder="Playername"
                            />
                            <button class="game-settings__player-delete">
                                <img src="/assets/trashcan.svg" alt="trashcan icon">
                            </button>
                        </div>

                    </div>

                    <div class="game-settings__player-options">
                        <span class="input-error">
                            <img 
                                class="error-icon <?= $createdGame->playersErr ? "error-icon--show" : "" ?>" 
                                src="/assets/error-circle.svg" 
                                alt="error icon"
                            />
                            <?= $createdGame->playersErr ?>
                        </span>
                        <button type="button" class="game-settings__add-player btn btn--secondary btn--small btn--icon">
                            Add player
                            <img src="/assets/plus.svg" alt="add player icon">
                        </button>
                    </div>

                </div>

                <button class="game-settings__create-btn btn btn--primary" type="submit">Create game</button>

            </form>

        </section>

    </main>

    <?php include PROJ_ROOT . "/app/views/partials/footer.php" ?>

</body>
</html>