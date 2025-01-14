<?php
$pdo->exec("SET NAMES utf8mb4");
$error_message = array();

if (isset($_POST['threadSubmitButton'])) {

  //スレッド名チェック
  if (empty($_POST['title'])) {
    $error_message['title'] = 'お名前を入力してください';
  } else {
    //エスケープ処理
    $escaped['title'] = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
  }
  //お名前チェック
  if (empty($_POST['username'])) {
    $error_message['username'] = 'お名前を入力してください';
  } else {
    //エスケープ処理
    $escaped['username'] = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
  }
  //コメント入力チェック
  if (empty($_POST['body'])) {
    $error_message['body'] = 'お名前を入力してください';
  } else {
    //エスケープ処理
    $escaped['body'] = htmlspecialchars($_POST['body'], ENT_QUOTES, 'UTF-8');
  }

  if (empty($error_message)) {
    $post_date = date('Y-m-d H:i:s');

    //スレッドを追加
    $sql = 'INSERT INTO `thread` (`title`) VALUES (:title);';
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam("title", $escaped['title'], PDO::PARAM_STR);
    $stmt->execute();

    //コメントも追加
    $sql = 'INSERT INTO comment (username, body, post_date, thread_id) VALUES (:username, :body, :post_date, (SELECT id FROM thread WHERE title = :title))';
    $stmt = $pdo->prepare($sql);

    //値をセットする
    $stmt->bindParam(':username', $escaped['username'], PDO::PARAM_STR);
    $stmt->bindParam(':body', $escaped['body'], PDO::PARAM_STR);
    $stmt->bindParam(':post_date', $post_date, PDO::PARAM_STR);
    $stmt->bindParam(':title', $escaped['title'], PDO::PARAM_STR);

    $stmt->execute();
  }

  //掲示板ページに遷移
  header('Location: http://localhost:8080/2chan-bbs');
}
?>