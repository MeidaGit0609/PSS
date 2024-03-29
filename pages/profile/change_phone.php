<?php
require_once '../../php/config.php';
require_once '../../php/functions/posts_functions.php';
require_once '../../php/functions/user_functions.php';
require_once '../../php/functions/comment_functions.php';
require_once '../../php/functions/like_functions.php';
require_once '../../includes/head.php';
?>
    <style>
        .form {
            max-width: 300px;
            margin: 0 auto;
        }
    </style>
    </head>
    <body>
<?php
require_once '../../includes/header.php';

$user_id = $_GET['user_id'];
if($user_id && $user['id'] == $user_id || $user['is_admin'] == 1) : // Может ли пользователь менять эту информацию
    ?>
    <div class="container mt-5">
        <form action="/php/action/changes/change_phone-handler.php?user_id=<?=$user_id ?>" class="form" method="post">
            <div class="form-group">
                <?=$_GET['change'] == 'happy' ? '<div class="alert alert-success">Вы успешно изменили Номер телефона</div>' : ''?>
                <?=$_GET['change'] == 'fail' ? '<div class="alert alert-danger">Телефон введён неверно</div>' : ''?>
                <?=$_GET['change'] == 'input_fail' ? '<div class="alert alert-danger">Заполните поле</div>' : ''?>
                <input type="text" name="new_phone" class="form-control mb-3" placeholder="Новый номер телефона с (7)" required>
                <button class="btn btn-md btn-success">Отправить</button>
            </div>
        </form>
    </div>
<?php else : ?>
    <div class="alert">Неправильный адрес</div>
<?php endif; ?>


    <script src="https://kit.fontawesome.com/e044194a8c.js" crossorigin="anonymous"></script>
<? require_once '../../includes/footer.php'; ?>