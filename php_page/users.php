<?php
    session_start();
    if(!isset($_SESSION['unique_id'])){
        header("location: login.php");
    }
?>

<?php include_once "header.php"?>
<body>
    <div class="wrapper">
        <section class="users">
            <header>
            <?php
                include_once "php/config.php";
                $query = ("select * from public.user where unique_id = '{$_SESSION['unique_id']}'");
                $result_query = pg_query($query);
                if(pg_num_rows($result_query) > 0){
                    $row = pg_fetch_assoc($result_query);
                }
            ?>
                <div class="content">
                    <img src="php/images/<?php echo $row['img']; ?>" alt="">
                    <div class="details">
                        <span><?php echo $row['fname'] . " " . $row['lname'] . " - " . $row['job']; ?></span>
                        <p><?php echo $row['status']; ?></p>
                    </div>
                </div>
                <a href="php/logout.php?logout_id=<?php echo $row['unique_id'] ?>" class="logout">Выйти</a>
            </header>
            <div class="search">
                <span class="text">Выберете, с кем хотите начать общение</span>
                <input type="text" placeholder="Введите имя для поиска...">
                <button><i class="fas fa-search"></i> </button>
            </div>
            <div class="users-list">
            </div>
        </section>
    </div>
    <div id="file-panel-id-main" class="wrapper2">
        <section id="file-panel-id-all" class="files">
            <div class="content1">
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    <div class="details1">
                        <span>Загрузка файлов</span>
                    </div>
                    <input type="file" name="fileToUpload" id="fileToUpload" class="choose">
                    <input type="submit" value="Загрузить файл" name="submit" class="upload">
                </form>
                <div class="res">
                    <?php
                    $files = scandir('./uploads');
                    sort($files); // сортировка файлов
                    for($i = 2; $i < count($files); $i++){
                        echo'<a href="uploads/'.$files[$i].'" download=""><br>'.$files[$i].'</a>';
                    }
                    ?>
                </div>
            </div>
        </section>
    </div>
    <button id="open" class="openbtn" onclick="openFiles()"><i class="fa fa-arrow-right" aria-hidden="true"></i> </button>
    <button id="close" class="closebtn" onclick="closeFiles()"><i class="fa fa-arrow-left" aria-hidden="true"></i> </button>
    <script src="javascript/users.js"></script>
    <script src="javascript/file-panel.js"></script>
</body>
</html>