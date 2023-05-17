<?php
    while($row = pg_fetch_assoc($result_query)){
        $query2 = ("select * from public.messages where 
                                (outgoing_msg_id = '{$row['unique_id']}' or incoming_msg_id = '{$row['unique_id']}') 
                                and (outgoing_msg_id = '{$outgoing_id}' or incoming_msg_id = '{$outgoing_id}') order by msg_id desc limit 1");
        $result_query2 = pg_query($query2);
        $row2 = pg_fetch_assoc($result_query2);
        if(pg_num_rows($result_query2) > 0){
            $result = $row2['msg'];
        }else{
            $result = "Нет сообщений";
        }
        // обрезка сообщения, если слово больше 28
        (strlen($result) > 28) ? $msg = substr($result, 0, 28).'...' : $msg = $result;
        // добавление "Вы" перед сообщением которое вы отправили
        ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "Вы: " : $you = "";
        //проверка статуса
        ($row['status'] == "Неактивен") ? $offline = "offline" : $offline = "";

        $output .= '<a href="chat.php?user_id='. $row['unique_id'] .'">
                        <div class="content">
                            <img src="php/images/'. $row['img'].'" alt="">
                            <div class="details">
                                <span>'. $row['fname'] . " " . $row['lname'] . " - " . $row['job'].'</span>
                                <p>'. $you . $msg .'</p>
                            </div>
                        </div>
                        <div class="status-dot '.$offline.'"><i class="fas fa-circle"></i></div>
                     </a>';
    }
?>

