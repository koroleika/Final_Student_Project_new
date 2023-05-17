<?php
    session_start();
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $searchTerm = pg_escape_string($postgre, $_POST['searchTerm']);
    $output = "";
    $query = ("select * from public.user where not unique_id = {$outgoing_id} and (fname like '%{$searchTerm}%' or lname  like '%{$searchTerm}%')");
    $result_query = pg_query($query);
    if(pg_num_rows($result_query) > 0){
        include "data.php";
    }else{
        $output .= "Пользователь не найден";
    }
    echo $output;
?>