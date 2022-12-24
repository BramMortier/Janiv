<div class="new-round-menu">
    <h3 class="subtle text-space-md">Fill in round scores</h3>

    <form id="new-round-form" class="new-round-menu__form" action="/game/scoreboard/<?= $gameId ?>" method="POST">

        <input type="hidden" name="round" value="<?= $gameInfo->round + 1 ?? 1 ?>">

        <?php foreach($gameScores as $index => $scoreSheet): ?>

            <div class="form-group">
                <label for="scores[]"><?= $scoreSheet->playerName ?></label>
                <input 
                    class="input" 
                    type="text" 
                    placeholder="score"
                    name="scores[<?= $scoreSheet->playerId ?>]"
                />
            </div>

        <?php endforeach; ?>

    </form>

    <div class="new-round-menu__btns">
        <button class="new-round-menu__close btn btn--small btn--secondary">Close</button>
        <button type="submit" form="new-round-form" class="btn btn--small btn--primary">Add round</button>
    </div>
</div>