<?php

if (!isset($_GET['id']) OR !is_numeric($_GET['id']))
header('location: index.php');

else {
    extract($_GET);
    $id = strip_tags($id);

    require_once('configurer/functions.php');

    if(!empty($_POST)){

        extract($_POST);
        $errors = array();

        $author = strip_tags($author);
        $comment = strip_tags($comment);

        if(empty($author))
        array_push($errors, 'entrez un pseudo');

        if(empty($comment))
        array_push($errors, 'entrez un commentaire');

        if(count($errors) == 0) {

            $comment= addComment($id, $author, $comment);
            $success = 'Votre commentaire a été publié';
            unset($author);
            unset($comment);
        }

    }

    $article = getArticle($id);
    $comments = getComments($id);

}
?>

<!DOCTYPE html>
<html>
<head> <meta charset="utf-8">
<title><?= $article->title ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">


</head>
<body>
<a href="index.php">Retour aux articles</a>

<div class="container-fluid">
    <h1><?= $article->title ?></h1>
    <time><?=$article->date ?></time>
    <p><?= $article->content ?></p>
    <hr/>

    
<img src="neige.jpg" class="rounded float-end" alt="neige.jpg">

    <?php
    if(isset($success))
        echo $success;

    if(!empty($errors)):?>

    <?php foreach($errors as $error):?>
        <div class="row">
                <div class="col-md-6">
                <div class="alert alert-danger"><?= $error ?></div>
                
                </div>
        </div>

    <?php endforeach; ?>

    <?php endif; ?>

    <div class="row">
    <div class="col-md-6">

             <form method = "POST" action= "?id= <?php echo $article->id; ?>">
                <p><label for="author">Pseudo : </label><br>
                <input type="text" name="author" id="author" value=" <?php if(isset($author)) echo $author ?>" class="form-control"/></p>
                <p><label for="comment">Commentaire: </label><br>
                <textarea name="comment" id="comment" cols="30" rows="5" class="form-control" > <?php if(isset($comment)) echo $comment?></textarea> </p>
                <button type="submit" class="btn btn-success"> ENVOYER</button>

            </form>
    
    </div>
    </div>

    
    <h2>COMMENTAIRES</h2>

    <?php foreach($comments as $com): ?>
        <h3><?= $com->author ?> </h3>
        <time><?= $com->date ?></time>
        <p><?= $com->comment ?></p>
    <?php endforeach; ?>

</div>




</body>
</html>