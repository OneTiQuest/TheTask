<?php
    $host = "localhost";
    $user = "root";
    $pass1 = "";
    $database = "task";
    
    $connection = new mysqli($host, $user, $pass1, $database);
    
    if ($connection == false) {
        echo 'Не удалось подключиться к БД';
    }

    $fio = htmlspecialchars($_POST['fio']);
    $email = htmlspecialchars($_POST['email']);
    $message  = htmlspecialchars($_POST['message']);
    $mes = 'Письмо от пользователя: '.$fio.' с текстом: '.$message.'\r\n'.'Связь по почте: '.$email;
    
    if(isset($_POST['sub'])){
        $auth = $connection->query("SELECT * FROM `send` WHERE `email` LIKE '$email'");
        if(mysqli_num_rows($auth) < 1){
            $connection->query("INSERT INTO `send` (`fio`, `email`, `message`) VALUES ('$fio', '$email', '$message')");
            if(mail('ksimfhn@gmail.com', 'Письмо с моего сайта', $mes, 'From: ksimfhn@gmail.com')){
                echo '<p style="color: green;font-size:24px;">Письмо отправлено.</p>';
            }else{
                echo 'Письмо не отправлено';
            };
          }else{
            echo '<p style="color: red;font-size:24px;">С этого Email уже отправлялось письмо. Ваше сообщение не отправилось.</p>';
          }
    };
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=100%, initial-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <link rel="stylesheet" href="css/style.css">
    <title>Задание</title>
</head>

<body>
    <div class="win">
        <h1 style="text-align: center;">Форма обратной связи</h1>
        <div id="error"></div>
        <form action="#" class="form" method="post">
            <label for="fio">Ваше Ф.И.О.</label>
            <input id="fio" type="text" name="fio" required>

            <label for="email">Ваш E-mail:</label>
            <input id="email" type="email" name="email" required>

            <label for="message">Текст вопроса:</label>
            <textarea id="message" name="message" rows="6" required></textarea>

            <input type="submit" id="sub" name="sub">
        </form>
    </div>
</body>

    <script>
let in1 = document.querySelector('#fio');
let in2 = document.querySelector('#email');
let in3 = document.querySelector('#message');
    in1.style.border = 'none';
    in2.style.border = 'none';
    in3.style.border = 'none';
let sub = document.querySelector('#sub');

sub.addEventListener('click', function () {
    let errors = false;
    if (in1.value == '') {
        in1.style.border = '1px solid red';
        in2.style.border = 'none';
        in3.style.border = 'none';
        Error();
        error.textContent = 'Имя обязательно к заполнению';
        errors = true;
    }else if (in1.value.length <= 5) {
        in1.style.border = '1px solid red';
        in2.style.border = 'none';
        in3.style.border = 'none';
        Error();
        error.textContent = 'Имя должно быть не меньше 6 символов.';
        errors = true;
    }else if(in1.value.match('/^[А-Яа-яЁё]+$/')){
        in1.style.border = '1px solid red';
        Error();
        error.textContent = 'Имя должно содержать только буквы.';
        errors = true;
    }else if(in2.value == '') {
        in2.style.border = '1px solid red';
        in1.style.border = 'none';
        in3.style.border = 'none';
        Error();
        error.textContent = 'Почта обязательна к заполнению';
        errors = true;
    }else if (in2.value.length <= 5) {
        in2.style.border = '1px solid red';
        in1.style.border = 'none';
        in3.style.border = 'none';
        Error();
        error.textContent = 'Почта должна быть не меньше 6 символов.';
        errors = true;
    }else if (in3.value == '') {
        in1.style.border = 'none';
        in2.style.border = 'none';
        in3.style.border = '1px solid red';
        Error();
        error.textContent = 'Текст вопроса не может быть пустым.';
        errors = true;
    }else{
        in1.style.border = 'none';
        in2.style.border = 'none';
        in3.style.border = 'none';
        notError()
    }
    if(errors == true){
        event.preventDefault();
    }
})
function Error(){
    document.querySelector('.win').style.height = '500px';
    let error = document.querySelector('#error').classList = 'error';
}
function notError(){
    document.querySelector('.win').style.height = '450px';
    document.querySelector('#error').classList = '';
    document.querySelector('#error').textContent = '';
}
    </script>

</html>