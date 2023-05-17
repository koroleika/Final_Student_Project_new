<?php
    session_start();
    include_once "config.php";
    $login = pg_escape_string($postgre, $_POST['login']);
    $password = pg_escape_string($postgre, $_POST['password']);

    if(!empty($login) && !empty($password)){
        $query = ("select * from public.user where login = '{$login}' and password = '{$password}'");
        $result_query = pg_query($query);
        if(pg_num_rows($result_query) > 0){
            $row = pg_fetch_assoc($result_query);
            $status = "Онлайн";
            //обновление статуса пользователя
            $query2 = ("update public.user set status = '{$status}' where unique_id = {$row['unique_id']}");
            $result_query2 = pg_query($query2);
            if($query2){
                $_SESSION['unique_id'] = $row['unique_id']; //используя этот сеанс, мы используем пользовательский unique_id в других файлах
                echo "Ok";
            }
        }else{
            echo "Логин или пароль введены неверно";
        }
    }else{
        echo "Все поля обязательны для заполнения!!";
    }
?>
