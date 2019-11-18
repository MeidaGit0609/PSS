<?php
require_once '../../php/config.php';
require_once '../../php/functions/posts_functions.php';
require_once '../../php/functions/user_functions.php';
require_once '../../php/functions/comment_functions.php';
require_once '../../php/functions/like_functions.php';
require_once '../../includes/head.php';
?>
    <link rel="stylesheet" href="/resource/styles/index-page.css">
    <link rel="stylesheet" href="/resource/styles/profile.css">
</head>
<body>
<?php
require_once '../../includes/header.php';

$user_id = $_COOKIE['user'];
if($user_id) :
?>
<header class="profile-header">
    <div class="container">
        <div class="row flex-wrap-wrap">
            <? $user_info = user_by_id($user_id); ?>
            <div class="col-md-3 col-sm-4 col-lg-2 col-3 avatar-wrapper">
                <div class="avatar">
                    <img src="<?=$user_info['avatar'] ?>" alt="">
                </div>
            </div>
            <div class="col">
                <h1 class="user__username"><?=$user_info['username'] ?></h1>
                <div class="user__public-count">
                    <?php $posts_counter = user_posts_counter($user_id); ?>
                    <b><?=$posts_counter ?></b> Публикация
                </div>
                <div class="user__name"><b><?=$user_info['name_surname'] ?></b></div>

                <form action="/php/action/add_avatar.php?user_id=<?=$user_id ?>" method="post" enctype="multipart/form-data" class="avatar_upload">
                    <b>Поменять аватар:</b>
                    <?=$_GET['upload'] == 'expansion_false' ? 'Невозможно загружать файлы такого типа в целях безопасности<br>' : '' ?>
                    <?=$_GET['upload'] == 'mime_false' ? 'Невозможно загружпть файлы такого типа в целях безопасности<br>' : '' ?>
                    <?=$_GET['upload'] == 'happy' ? 'Аватар успешно сменён<br>' : '' ?>
                    <?=$_GET['upload'] == 'big' ? 'Фото весит слишком много<br>' : '' ?>
                    <input type="file" name="avatar">
                    <button type="submit" class="btn btn-sm btn-primary" name="enter">Загрузить</button>
                </form>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="account.php">Аккаунт</a>
                    </li>
                </ul>
            </div>
        </nav>
        <hr>
        <div class="user_posts mt-5">
            <a class="btn btn-md btn-primary" href="/pages/add_post.php">Добавить пост</a>
            <div class="row mt-5">
                <?php
                if(isset($_GET['page'])) {
                    $page = $_GET['page'];
                }
                else {
                    $page = 1;
                }


                $posts = get_user_posts($page, $user_id);
                foreach($posts as $post) :
                    $comments = get_post_comment($post['id']);
                    $comments_num = count($comments);
                    ?>
                    <div class="col-md-4 col-sm-6 col-12 mini-post post mb-4">
                        <a class="post_img w-100" href="/pages/post.php?id=<?=$post['id'] ?>">
                            <img class="w-100 d-block" src="<?=$post['image'] ?>" alt="">

                            <div class="stat w-100 h-100 post_sub">
                        <span class="views stat_item">
                            <img src="/resource/img/icons/comment.svg" height="50" class="comment_icon">
                            <?=$comments_num ?>
                        </span>
                                <!-- like  -->
                                <form action="/php/action/like.php" method="post" class="like stat_item">
                                    <input type="hidden" name="likes" value="<?=$post['likes'] ?>">
                                    <input type="hidden" name="post_id" value="<?=$post['id'] ?>">
                                    <input type="hidden" name="user_id" value="<?=$user_id ?>">
                                    <button type="submit" class="no-btn">
                                        <?php if(is_like($post['id'], $user_id)) :?>
                                            <img src="/resource/img/icons/like.svg" alt="" WIDTH="45">
                                        <?php else :?>
                                            <img src="/resource/img/icons/like_dis.svg" alt="" WIDTH="45">
                                        <?php endif; ?>
                                    </button>
                                    <?=like_num($post['id'] ) ?>
                                </form>
                            </div>

                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="row justify-content-center">
                <div class="pagination">
                    <?php if($page < 2) :?>

                    <?php else : ?>
                        <a href="?page=<?=$page - 1;?>" class="pageBtn mr-3">Предыдущая страница </a>
                    <?php endif; ?>


                    <?php
                    $forLimit = user_posts_counter($user_info['id']) / $postsOnePage;
                    $forLimit = ceil($forLimit);
                    ?>

                    <?php if($forLimit == 1) : ?>

                    <?php else : ?>
                        <?php for($i = 1; $i <= $forLimit;$i++) : ?>
                            <a href="?page=<?=$i;?>" class="mr-2"><?=$i;?> </a>
                        <?php endfor; ?>
                    <?php endif; ?>


                    <?php if($page == $forLimit || $page > $forLimit) :?>

                    <?php else : ?>
                        <a href="?page=<?=$page + 1;?>" class="pageBtn ml-3">Следующая страница</a>
                    <?php endif; ?>


                </div>
            </div>
        </div>
    </div>
</header>
<?php else : ?>
<div class="alert">Вы не вошли в свой аккаунт или не создали его</div>
<?php endif; ?>


    <script src="https://kit.fontawesome.com/e044194a8c.js" crossorigin="anonymous"></script>

<? require_once '../../includes/footer.php'; ?>