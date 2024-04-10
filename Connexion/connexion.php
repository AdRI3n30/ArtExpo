<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login 01</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Mulish&display=swap"
            rel="stylesheet"
        >
        <link rel="stylesheet" href="/CSS/connexion.css">
    </head>
    <body>
        <div class="background"></div>
        <div class="centering">
            <form class="my-form" action="login.php" method="post">
                <div class="login-welcome-row">
                    <img
                        class="login-welcome"
                        src="../../img/Logonobg.png"
                        alt="Astronaut"
                    >
                    <!-- optimize the image in production -->
                    <h1>Login !</h1>
                </div>
                <div class="text-field">
                    <label for="email">Pseudo:</label>
                    <input
                        aria-label="Email"
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Your Pseudo"
                        required
                    >
                    <img
                        alt="Email Icon"
                        title="Email Icon"
                        src="../img/email.svg"
                    >
                </div>
                <div class="text-field">
                    <label for="password">Password:</label>
                    <input
                        id="password"
                        type="password"
                        aria-label="Password"
                        name="password"
                        placeholder="Your Password"
                        required
                    >
                    <img
                        alt="Password Icon"
                        title="Password Icon"
                        src="../img/password.svg"
                    >
                </div>
                <input type="submit" class="my-form__button" value="Login" >
                <div class="my-form__actions">
                    <div class="my-form__signup">
                        <a href="/inscription/inscription.php" title="Create Account" class="page-transition">Create Account</a>
                        
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>