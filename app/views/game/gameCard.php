<li>
    <a href="/game/scoreboard/<?= $game->gameId ?>" class="games__list-item">
        <div class="games__list-item-info">
            <h4 class="bold"><?= $game->gameName ?></h4>
            <p class="col-red text-sm">Spelers: 
                <span class="games__list-item-players subtle"><?= str_replace(",", " | ", $game->gamePlayers) ?></span>
            </p>
        </div>
        <button class="games__list-item-btn">
            <img src="/assets/play.svg" alt="play btn">
        </button>
    </a>
</li>