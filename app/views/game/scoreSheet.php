<li class="scoreboard__player">
    <div class="scoreboard__player-info">
        <div class="scoreboard__player-icon">
            <img src="/assets/person-inverted.svg" alt="person icon">
        </div>
        <p class="subtle center"><?= $scoreSheet->playerName ?></p>
    </div>
    <ul class="scoreboard__player-scores">

        <?php if($scoreSheet->playerScores): ?>
            <?php foreach(explode(",", $scoreSheet->playerScores) as $index => $score): ?>

                <li class="scoreboard__player-score subtle"><?= $score ?></li>

            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</li>