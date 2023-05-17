<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = pg_escape_string($postgre, $_POST['outgoing_id']);
        $incoming_id = pg_escape_string($postgre, $_POST['incoming_id']);
        $message = pg_escape_string($postgre, $_POST['message']);

        if(!empty($message)){
            $query = ("insert into public.messages (incoming_msg_id, outgoing_msg_id, msg)
                      values ({$incoming_id},{$outgoing_id},'{$message}')") or die();
            $insert_result_query = pg_query($query);
        }
    }else{
        header("../login.php");
    }
?>

