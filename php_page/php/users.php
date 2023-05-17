<?php
    session_start();
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $query = ("select * from public.user where not unique_id = {$outgoing_id}");
    $result_query = pg_query($query);
    $output = "";

    if(pg_num_rows($result_query) == 1){
        $output .= "Нет пользователей!";
    }elseif(pg_num_rows($result_query) > 0){
        include "data.php";
    }
    echo $output;
?>

