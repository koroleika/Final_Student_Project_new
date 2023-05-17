<?php
session_start();
if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
}
?>

<?php include_once "header.php"?>
<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <?php
                    include_once "php/config.php";
                    $user_id = pg_escape_string($postgre, $_GET['user_id']);
                    $query = ("select * from public.user where unique_id = '{$user_id}'");
                    $result_query = pg_query($query);
                    if(pg_num_rows($result_query) > 0){
                        $row = pg_fetch_assoc($result_query);
                    }
                ?>
                <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="php/images/<?php echo $row['img']; ?>" alt="">
                <div class="details">
                    <span><?php echo $row['fname'] . " " . $row['lname']. " - " . $row['job']; ?></span>
                    <p><?php echo $row['status']; ?></p>
                </div>
            </header>
            <div class="chat-box">

            </div>
            <form action="php/insert-chat.php" class="typing-area" autocomplete="off">
                <input type="text" name="outgoing_id" value="<?php echo $_SESSION['unique_id']; ?>" hidden>
                <input type="text" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                <input type="text" name="message" class="input-field" placeholder="Введите сообщение здесь...">
                <button class="button1"><i class="fa fa-level-up"></i></button>
            </form>
        </section>
    </div>

    <script src="javascript/chat.js"></script>
</body>
</html>