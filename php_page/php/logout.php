<?php
    session_start();
    if(isset($_SESSION['unique_id'])){//если пользователь аутентифицирован, то зайдет на эту страницу, в противном случае перейдет на страницу аутентификации
        include_once "config.php";
        $logout_id = pg_escape_string($postgre , $_GET['logout_id']);
        if(isset($logout_id)){ //если logout_id заданно
            $status = "Неактивен";
            //обновление статуса пользователя
            $query = ("update public.user set status = '{$status}' where unique_id = {$logout_id}");
            $result_query = pg_query($query);
            if($result_query){
                session_unset();
                session_destroy();
                header("location: ../login.php");
            }else{
                header("location: ../users.php");
            }
        }
    }else{
        header("location: ../login.php");
    }
?>