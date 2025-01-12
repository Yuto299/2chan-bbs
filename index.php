<?php

include_once('./app/database/connect.php');

$pdo->exec("SET NAMES utf8mb4");
$error_message = array();

if (isset($_POST["submitButton"])) {

  //名前入力チェック
  if (empty($_POST['username'])) {
    $error_message['username'] = 'お名前を入力してください';
  } 
  //コメント入力チェック
  if (empty($_POST['body'])) {
    $error_message['body'] = 'コメントを入力してください';
  } 

  if (empty($error_message)) {
    $post_date = date("Y-m-d H:i:s");

    $sql = "INSERT INTO `comment` (`username`, `body`, `post_date`) VALUES (:username, :body, :post_date);";
    $stmt = $pdo->prepare($sql);
  
    //値をセットする
    $stmt->bindParam(':username', $_POST['username'], PDO::PARAM_STR);
    $stmt->bindParam(':body', $_POST['body'], PDO::PARAM_STR);
    $stmt->bindParam(':post_date', $post_date, PDO::PARAM_STR);
  
    $stmt->execute();
  }
}

$comment_array = array();

//コメントデータをテーブルから取得してくる
$sql = 'SELECT * FROM comment';
$stmt = $pdo->prepare($sql);
$comment_array = $stmt->execute();

$comment_array = $stmt;
// var_dump($comment_array);

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

  <!-- バリデーションチェックエラー文表示 -->
  <?php if (isset($error_message)): ?>
    <ul class='errorMessage'>
      <?php foreach ($error_message as $error): ?>
        <li><?php echo $error ?></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>

  <!-- スレッドエリア -->
  <div class='threadWrapper'>
    <div class="childWrapper">
      <div class='threadTitle'>
        <span> 【タイトル】 </span>
        <h1>2ちゃんねる掲示板を作ってみた</h1>
      </div>
      <section>
        <?php foreach($comment_array as $comment) :?>
        <article>
          <div class="wrapper">
            <div class="nameArea">
              <span>名前:</span>
              <p class='username'><?php echo $comment['username']; ?></p>
              <time>:<?php echo $comment['post_date']; ?></time>
            </div>
            <p class='comment'><?php echo $comment['body']; ?></p>
          </div>
        </article>
        <?php endforeach; ?>
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