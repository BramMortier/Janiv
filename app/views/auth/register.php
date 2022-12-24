<?php 
    $registerData = $data["registerData"];
?>

<?php include PROJ_ROOT . "/app/views/partials/head.php" ?>

<body class="background">

    <?php include PROJ_ROOT . "/app/views/partials/header.php" ?>

    <main>
        <section class="auth container">

            <h2 class="text-xxl bold text-space-xxs">Register</h2>
            <p class="subtle">
                Don't miss out on all <br /> 
                the fun!
            </p>

            <form class="auth__form" action="/auth/register" method="POST">

                <div class="form-group">
                    <label for="username">Username</label>
                    <input 
                        class="input <?= $registerData->usernameErr ? "input--invalid" : "" ?>" 
                        type="text" 
                        name="username"
                        placeholder="Type a username" 
                        value="<?= $registerData->username ?>"
                    />
                    <span class="input-error">
                        <img 
                            class="error-icon <?= $registerData->usernameErr ? "error-icon--show" : "" ?>" 
                            src="/assets/error-circle.svg" 
                            alt="error icon"
                        />
                        <?= $registerData->usernameErr ?>
                    </span>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input 
                        class="input <?= $registerData->passwordErr ? "input--invalid" : "" ?>" 
                        type="password" 
                        name="password"
                        placeholder="Choose a strong password" 
                        value="<?= $registerData->password ?>"
                    />
                    <span class="input-error">
                        <img 
                            class="error-icon <?= $registerData->passwordErr ? "error-icon--show" : "" ?>" 
                            src="/assets/error-circle.svg" 
                            alt="error icon"
                        />
                        <?= $registerData->passwordErr ?>
                    </span>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm password</label>
                    <input 
                        class="input <?= $registerData->confirmPasswordErr ? "input--invalid" : "" ?>" 
                        type="password" 
                        name="confirm_password" 
                        placeholder="Confirm your password" 
                        value="<?= $registerData->confirmPassword ?>"
                    />
                    <span class="input-error">
                        <img 
                            class="error-icon <?= $registerData->confirmPasswordErr ? "error-icon--show" : "" ?>" 
                            src="/assets/error-circle.svg" 
                            alt="error icon"
                        />
                        <?= $registerData->confirmPasswordErr ?>
                    </span>
                </div>

                <div class="form-group">
                    <button class="btn btn--primary" type="submit">Register</button>
                    <p class="text-sm subtle">Already a member? <a class="col-red bold" href="/auth/login">Login here</a></p>
                </div>

            </form>

            <span class="input-error">
                <img 
                    class="error-icon <?= $registerData->registerErr ? "error-icon--show" : "" ?>" 
                    src="/assets/error-circle.svg" 
                    alt="error icon"
                />
                <?= $registerData->registerErr ?>
            </span>

        </section>
    </main>

</body>
</html>