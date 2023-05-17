<?php
    session_start();
    if(isset($_SESSION['unique_id'])){//if user is logged in
        header("location: user.php");
    }
?>
<?php include_once "header.php"?>
<body>
    <div class="wrapper">
        <section class="form singup">
            <header>Регистрация</header>
            <form action="#" enctype="multipart/form-data">
                <div class="error-txt"></div>
                <div class="name-details">
                    <div class="field input">
                        <label>Имя</label>
                        <input type="text" name="fname" placeholder="Введите имя" required>
                    </div>
                    <div class="field input">
                        <label>Фамилия</label>
                        <input type="text" name="lname" placeholder="Введите фамилию" required>
                    </div>
                </div>
                <div class="field input">
                    <label>Должность</label>
                    <input type="text" name="job" placeholder="Введите должность" required>
                </div>
                <div class="field input">
                    <label>Логин</label>
                    <input type="text" name="login" placeholder="Введите логин" required>
                </div>
                <div class="field input">
                    <label>Пароль</label>
                    <input type="password" name="password" placeholder="Пароль" required>
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field image">
                   <label>Фото</label>
                   <input type="file" name="image" required>
                </div>
                <div class="field button">
                    <input type="submit" value="Начать общение">
                </div>
            </form>
            <div class="link">Уже зарегестрированны? <a href="login.php">Аутентифицироваться</a> </div>
        </section>
    </div>

    <script src="javascript/pass-show-hide.js"></script>
    <script src="javascript/signup.js"></script>

</body>
</html>