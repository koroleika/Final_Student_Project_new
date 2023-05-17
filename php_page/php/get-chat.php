<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = pg_escape_string($postgre, $_POST['outgoing_id']);
        $incoming_id = pg_escape_string($postgre, $_POST['incoming_id']);
        $output = "";


        $query = ("select * from public.messages 
                                left join public.user on public.user.unique_id = public.messages.outgoing_msg_id
                                where (outgoing_msg_id = '{$outgoing_id}' and incoming_msg_id = '{$incoming_id}') 
                                or (outgoing_msg_id = '{$incoming_id}' and incoming_msg_id = '{$outgoing_id}') order by msg_id");
        $result_query = pg_query($query);
        if(pg_num_rows($result_query) > 0){
            while($row = pg_fetch_assoc($result_query)){
                if($row['outgoing_msg_id'] === $outgoing_id){ //отправка сообщения
                    $output .= '<div class="chat outgoing">
                                    <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                    </div>
                                </div>';
                }else{ // получение сообщения
                    $output .= '<div class="chat incoming">
                                    <img src="php/images/'.$row['img'].'" alt="">
                                    <div class="details">
                                        <p>'. $row['msg'] .'</p>
                                    </div>
                                </div>';
                }
            }
            echo $output;
        }
    }else{
        header("../login.php");
    }
?>
