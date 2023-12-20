<!DOCTYPE html>
<html>

<head>
    <title>Tasker</title>
    <meta charset="UTF-8">
    <meta name="description" content="In progress">
    <meta name="keywords" content="In progress">
    <meta name="author" content="Michal Szymacha">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="data/css/login.css">
</head>

<body>
    <div class="mainContainer">
        <div class="mainContainer__left">
            <div class="mainContainer__left--title">
                <span class="mainContainer__left--name">Tasker</span>
                <img src="data/img/logo.svg" alt="Logo" class="mainContainer__left--logo">
            </div>

        </div>
        <form class="register" action="register" method="post">
            <div class="mainContainer__right">
                <h1 class="mainContainer__right--header"> Create an account</h1>
                <span class="mainContainer__right--text">Email</span>
                <input name="email" type="text" class="mainContainer__right--input" placeholder="Enter Your Email">
                <span class="mainContainer__right--text">Password</span>
                <input name="pass" type="password" class="mainContainer__right--input"
                    placeholder="Enter Your Password">
                <button class="mainContainer__right--button" type="submit">Sing up</button>
                <?php if (isset($messages)) {
                    foreach ($messages as $message) {
                        echo $message;
                    }
                } ?>
                <span class="mainContainer__right--footer">Already have an account? <a href="login">Login</a></span>
            </div>
        </form>
    </div>
</body>

</html>