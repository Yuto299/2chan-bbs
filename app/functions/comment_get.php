<?php
  $comment_array = array();

  //コメントデータをテーブルから取得してくる
  $sql = 'SELECT * FROM comment';
  $stmt = $pdo->prepare($sql);
  $comment_array = $stmt->execute();

  $comment_array = $stmt;
  // var_dump($comment_array);
?>