<?php
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if(isset($_FILES["fileToUpload"])) {
        $check = filesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
            echo "Загрузите файл!";
            echo "<br>";
            exit();
        }
    }
    // проверка если $uploadOk заскейлен в 0 другой ошибкой
    if ($uploadOk == 0) {
        echo "Произошла непредвиденная ошибка 1";
        echo "<br>";
    // загрузка файла
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "Файл ". basename( $_FILES["fileToUpload"]["name"]). " был загружен";
            header( "refresh:2;url=/users.php" );
        } else {
            echo "Произошла непредвиденная ошибка 2";
            echo "<br>";
        }
    }
?>