<?php

function getArticles()
{
    require('connecte.php');
    $req= $bdd->prepare('SELECT id, title, date FROM articles ORDER BY id DESC');
    $req->execute();
    $data = $req-> fetchAll(PDO::FETCH_OBJ);
    return $data;
    $req -> closeCursor();

}
function getArticle($id)
{
    require('connecte.php');
    $req = $bdd->prepare('SELECT * FROM articles WHERE id= ?');
    $req->execute(array($id));

    if ($req->rowCount() == 1)
    {
        $data= $req->fetch(PDO::FETCH_OBJ);
        return $data;
    }
    else 
    header('location: index.php');
    $req -> closeCursor();
}
//fonction qui ajoute un commentaire dans la bdd
function addComment($articleId, $author, $comment)
{
    require('connecte.php');
    $req = $bdd->prepare('INSERT INTO comments (articleId, author, comment, date) VALUES(?,?,?, NOW())');
    $req->execute(array($articleId, $author, $comment));
    $req -> closeCursor();

} // recupere commentaire 
function getComments($id) {

require('connecte.php');
$req = $bdd->prepare('SELECT * FROM comments WHERE articleId= ?');
$req->execute(array($id));
$data= $req->fetchAll(PDO::FETCH_OBJ);
return $data;
$req -> closeCursor();
}


?>