<?php
$root = $_SERVER['DOCUMENT_ROOT'];
$categories_way = $root . '/php/functions/categories_functions.php';
require_once $categories_way;

$root = $_SERVER['DOCUMENT_ROOT'];
$config_way  = $root . '/php/config.php';
require_once $config_way;
?>
<nav class="navbar navbar-dark bg-primary navbar-expand-lg mb-5">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand" href="/"><?=$config['companyName'] ?></a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <?php $categories = get_categories(); ?>

<!--            <li class="nav-item active">-->
<!--                <a class="nav-link" href="/pages/user.php?id=--><?//=$user['id'] ?><!--">Профиль</a>-->
<!--            </li>-->

            <?php if(isset($_COOKIE['user'])) :// Зарегистрирован?>
                <?php foreach($categories as $category) :?>
                    <?php if($category['access'] == 1): ?>
                        <?php if($category['title'] == 'Профиль') :?>
                            <li class="nav-access active">
                                <a class="nav-link" href="<?=$category['link'] . $_COOKIE['user']?>"><?=$category['title'] ?></a>
                        <?php else:?>
                            <li class="nav-access active">
                                <a class="nav-link" href="<?=$category['link']?>"><?=$category['title'] ?></a>
                            </li>
                        <?php endif; ?>
                    <?php else: ?>
                    <?php endif; ?>
                <?php endforeach; ?>

            <?php elseif(!isset($_COOKIE['user'])):  // Не зарегистрирован?>
                <?php foreach($categories as $category) : ?>
                    <?php if($category['access'] == 2): ?>

                        <li class="nav-access active">
                            <a class="nav-link" href="<?=$category['link'] ?>"><?=$category['title'] ?></a>
                        </li>

                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif;  ?>


            <?php foreach($categories as $category) : // Неважно?>
                <?php if($category['access'] == 0): ?>

                    <li class="nav-item active">
                        <a class="nav-link" href="<?=$category['link'] ?>"><?=$category['title'] ?></a>
                    </li>

                <?php else: ?>
                <?php endif; ?>
            <?php endforeach; ?>



        </ul>
    </div>

    <form class="search row no-gutters" action="/pages/search.php" method="get">
        <div class="col-8">
            <input type="search" name="query" class="form-control d-inline-block" placeholder="Найти канал..." required value="<?=isset($query) ? $_GET['query'] : '' ?>">
        </div>
        <button class="btn btn-md btn-outline-dark d-inline-block">Поиск</button>
    </form>
</nav>