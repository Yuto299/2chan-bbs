<?php
include_once('./app/database/connect.php');
$pdo->exec("SET NAMES utf8mb4");
include('./app/functions/comment_add.php');
include('./app/functions/comment_get.php');
?>

<div class='threadWrapper'>
    <div class="childWrapper">
      <div class='threadTitle'>
        <span> 【タイトル】 </span>
        <h1>2ちゃんねる掲示板を作ってみた</h1>
      </div>
      <?php include('commentSection.php'); ?>
      <?php include('commentForm.php'); ?>
    </div>
</div>