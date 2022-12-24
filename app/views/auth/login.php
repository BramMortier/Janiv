<?php 
    $loginData = $data["loginData"];
?>

<?php include PROJ_ROOT . "/app/views/partials/head.php" ?>

<body class="background">

    <?php include PROJ_ROOT . "/app/views/partials/header.php" ?>

    <main>
        <section class="auth container">

            <h2 class="text-xxl bold text-space-xxs">Login</h2>
            <p class="subtle">
                Welcome back you've <br /> 
                been missed!
            </p>

            <form class="auth__form" action="/auth/login" method="POST">

                <div class="form-group">
                    <label for="username">Username</label>
                    <input 
                        class="input <?= $loginData->usernameErr ? "input--invalid" : "" ?>" 
                        type="text" 
                        name="username" 
                        placeholder="Type your username"
                        value="<?= $loginData->username ?>"
                    />
                    <span class="input-error">
                        <img 
                            class="error-icon <?= $loginData->usernameErr ? "error-icon--show" : "" ?>" 
                            src="/assets/error-circle.svg" 
                            alt="error icon"
                        />
                        <?= $loginData->usernameErr ?>
                    </span>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input 
                        class="input <?= $loginData->passwordErr ? "input--invalid" : "" ?>" 
                        type="password"
                        name="password" 
                        placeholder="Fill in your password"
                        value="<?= $loginData->password ?>"
                    />
                    <span class="input-error">
                        <img 
                            class="error-icon <?= $loginData->passwordErr ? "error-icon--show" : "" ?>" 
                            src="/assets/error-circle.svg" 
                            alt="error icon"
                        />
                        <?= $loginData->passwordErr ?>
                    </span>
                </div>

                <div class="form-group">
                    <button class="btn btn--primary" type="submit">Login</button>
                    <p class="text-sm subtle">Don't have an account? <a class="col-red bold" href="/auth/register">Register here</a></p>
                </div>

            </form>

            <span class="input-error">
                <img 
                    class="error-icon <?= $loginData->loginErr ? "error-icon--show" : "" ?>" 
                    src="/assets/error-circle.svg" 
                    alt="error icon"
                />
                <?= $loginData->loginErr ?>
            </span>

        </section>
    </main>

    <?php include PROJ_ROOT . "/app/views/partials/footer.php" ?>

</body>
</html>