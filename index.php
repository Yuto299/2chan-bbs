<?php

include_once('./app/database/connect.php');

if (isset($_POST["submitButton"])) {
  $username = $_POST["username"];
  var_dump($username);
  $body = $_POST["body"];
  var_dump($body);
}

$comment_array = array();

//コメントデータをテーブルから取得してくる
$sql = 'SELECT * FROM comment';
$stmt = $pdo->prepare($sql);
$comment_array = $stmt->execute();

$comment_array = $stmt;
var_dump($comment_array);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>2ちゃんねる掲示板</title>
  <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
  <header>
    <h1 class='title'>2ちゃんねる掲示板</h1>
    <hr>
  </header>

  <!-- スレッドエリア -->
  <div class='threadWrapper'>
    <div class="childWrapper">
      <div class='threadTitle'>
        <span> 【タイトル】 </span>
        <h1>2ちゃんねる掲示板を作ってみた</h1>
      </div>
      <section>
        <article>
          <div class="wrapper">
            <div class="nameArea">
              <span>名前:</span>
              <p class='username'>Yu299</p>
              <time>:2025/01/12 17:00</time>
            </div>
            <p class='comment'>手書きのコメントです。</p>
          </div>
        </article>
      </section>
      <form class='formWrapper' method='POST'>
        <div>
          <input type="submit" value="書き込む" name="submitButton">
          <label>名前:</label>
          <input type="text" name='username'>
        </div>
        <div>
          <textarea class="commentTextArea" name="body"></textarea>
        </div>
      </form>
    </div>
  </div>
</body>
</html>