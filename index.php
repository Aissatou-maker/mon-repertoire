<?php
require_once('configurer/functions.php');
$articles = getArticles();
?>


<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8"/>
        <title>MON BLOG</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    </head>
    <body>
    <div class="container-fluid">
        <h1>MON BLOG </h1>

    <?php foreach ($articles as $article ) : ?>
        <h2> <?= $article->title ?> </h2>
        <time><?=$article->date ?></time>
        <br><br>
        <a href="article.php?id=<?= $article->id ?>"class="btn btn-primary"> Lire la suite </a>
    <?php endforeach; ?>
        
    </div>

    </body>
</html>