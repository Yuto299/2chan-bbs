<?php
  $thread_array = array();

  //コメントデータをテーブルから取得してくる
  $sql = 'SELECT * FROM thread';
  $stmt = $pdo->prepare($sql);
  $stmt->execute();

  $thread_array = $stmt;
  // var_dump($comment_array);
?>