<?php
    session_start();
    if(isset($_SESSION['unique_id'])){//если пользователь уже аутентифицирован
        header("location: user.php");
    }
?>
<?php include_once "header.php"?>
<body>
    <div class="wrapper">
        <section class="form login">
            <header>Аутентификация</header>
            <form action="#" autocomplete="off">
                <div class="error-txt"></div>
                <div class="field input">
                    <label>Логин</label>
                    <input type="text" name="login" placeholder="Введите логин">
                </div>
                <div class="field input">
                    <label>Пароль</label>
                    <input type="password" name="password" placeholder="Введите пароль">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field button">
                    <input type="submit" value="Начать общение">
                </div>
            </form>
            <div class="link">Еще не зарегистрированы?<a href="index.php">Регистрация</a> </div>
        </section>
    </div>

    <script src="javascript/pass-show-hide.js"></script>
    <script src="javascript/login.js"></script>

</body>
</html>