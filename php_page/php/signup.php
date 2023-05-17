<?php
    session_start();
    include_once "config.php";
    $fname = pg_escape_string($postgre, $_POST['fname']);
    $lname = pg_escape_string($postgre, $_POST['lname']);
    $login = pg_escape_string($postgre, $_POST['login']);
    $job = pg_escape_string($postgre, $_POST['job']);
    $password = pg_escape_string($postgre, $_POST['password']);

    if(!empty($fname) && !empty($lname) && !empty($login) && !empty($job) && !empty($password)){
        $query = ("select login from public.user where login = '".$login."'");
        $result_query = pg_query($query);
        //если кол-во полученных строк больше 0, значит пользователь с таким логином уже зарегистрирован
        if(pg_num_rows($result_query) > 0) {
            echo "$login - такой логин уже зарегестрирован";
        }else{
            if(isset($_FILES['image'])){
                $img_name = $_FILES['image']['name']; // получение имени, загруженного файла
                $tmp_name = $_FILES['image']['tmp_name']; //  временное имя файла, которое будет использоваться для сохранения файла в директории

                // исследуем изображение и получим расширение (jng png..)
                $img_explode = explode('.', $img_name);
                $img_ext = end($img_explode); // расширение

                $extensions = ['png', 'jpeg', 'jpg', 'PNG', 'JPEG', 'JPG'];
                if(in_array($img_ext, $extensions) === true){ // если загруженный файл соответствует расширению
                    $time = time(); //получение времени
                    //перемещение файла с новым именем в локальную директорию
                    $new_img_name = $time.$img_name;
                    if(move_uploaded_file($tmp_name, "images/".$new_img_name)){ //если пользователь успешно загрузил изображение в нашу директорию

                        $status = "Онлайн"; // как только пользователь зарегистрировался, его статус теперь будет онлайн
                        $random_id = rand(time(), 1000000); // создание случайного идентификатора для пользователя

                        // добавление пользовательских данных в таблицу
                        $query1 = ("insert into public.user (unique_id, fname, lname, login, job, password, img, status) 
                                                VALUES ('".$random_id."', '".$fname."', '".$lname."', '".$login."', '".$job."', '".$password."', '".$new_img_name."', '".$status."')");
                        $result_query_insert = pg_query($query1);
                        if($result_query_insert){
                            $query2 = ("select * from public.user where login = '{$login}'");
                            $result_query1 = pg_query($query2);
                            if(pg_num_rows($result_query1) > 0){
                                $row = pg_fetch_assoc($result_query1);
                                $_SESSION['unique_id'] = $row['unique_id']; // используя этот сеанс, мы используем пользовательский unique_id в других файлах
                                echo "Ok";
                            }
                        }else{
                            echo "Что-то пошло не так!";
                        }
                    }
                }else{
                    echo "Добавьте файл с расширением - jpeg, jpg, png!";
                }
            }else{
                echo "Добавьте файл изображения!";
            }
        }
    }else{
        echo "Все поля обязательны для заполнения!";
    }
?>