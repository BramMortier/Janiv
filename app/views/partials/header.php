<header class="header container">
    <img class="header__logo" src="/assets/logo.svg" alt="app logo" />

    <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>

        <div class="header__buttons">

            <?php if(isset($gameScores)): ?>

                <button class="header__settings-btn btn btn--small btn--secondary">Settings</button>

            <?php endif; ?>
            
            <div class="header__profile">
                <img src="/assets/person.svg" alt="profile icon">
            </div>

            <?php include PROJ_ROOT . "/app/views/menus/headerMenu.php" ?>
        </div>
            
    <?php endif; ?>

</header>