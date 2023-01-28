<?php
require_once(__DIR__ . '/functions.php');

$db_user =  getenv('DB_USERNAME');
$db_pass = getenv('DB_PASSWORD');

if (isset($_POST['submit'])) {
  /*
  * sanitize関数の実行(XSS)対策
    POSTの受け取りエスケープ処理を行い、$postへ格納する
  */
  $post = sanitize($_POST);
  if (!empty($post['age'])) {
    $post['age'] =  intval($post['age']);
  }

  try {
    $dbh = new PDO('mysql:dbname=php_db;:host=localhost;', $db_user, $db_pass);
    $sql = 'INSERT INTO users(name, furigana, email, age, address)
            VALUES (:name, :furigana, :email, :age, :address)
            ';
    $stmt = $dbh->prepare($sql);
    // prepareステートメントに値を挿入
    $stmt->bindValue(':name', $post['user_name'], PDO::PARAM_STR);
    $stmt->bindValue(':furigana', $post['user_furigana'], PDO::PARAM_STR);
    $stmt->bindValue(':email', $post['user_email'], PDO::PARAM_STR);
    $stmt->bindValue(':age', $post['user_age'], PDO::PARAM_INT);
    $stmt->bindValue(':address', $post['user_address'], PDO::PARAM_STR);
    // sqlの実行
    $stmt->execute();

    echo 'db接続完了';

    $dbh = null;
  } catch (PDOException $e) {
    exit('DB接続に失敗しました。' . $e->getMessage());
  }
}

?>

<?php require_once(__DIR__ . '/layouts/header.php'); ?>

<main class="l-main">
  <div class="l-main__inner">
    <div class="p-insert">
      <h2 class="p-insert__title">ユーザー登録</h2>
      <p class="p-insert__title-aside">ユーザー情報を入力してください。</p>
      <form class="p-insert-form" action="./insert.php" method="post">
        <div class="p-insert-form__part">
          <label class="p-insert-form__part-label" for="user_name">名前<span class="p-insert-form__part-required">必須</span></label>
          <input class="p-insert-form__part-input" id="user_name" type="text" name="user_name" placeholder="山田 太郎" maxlength="60" required>
        </div>
        <div class="p-insert-form__part">
          <label class="p-insert-form__part-label" for="user_furigana">フリガナ<span class="p-insert-form__part-required">必須</span></label>
          <input class="p-insert-form__part-input" id="user_furigana" type="text" name="user_furigana" placeholder="やまだ たろう" maxlength="60" required>
        </div>
        <div class="p-insert-form__part">
          <label class="p-insert-form__part-label" for="user_email">メールアドレス<span class="p-insert-form__part-required">必須</span></label>
          <input class="p-insert-form__part-input" id="user_email" type="email" name="user_email" placeholder="tarou@gmail.com" maxlength="255" required>
        </div>
        <div class="p-insert-form__part">
          <label class="p-insert-form__part-label" for="user_age">年齢</label>
          <input class="p-insert-form__part-input" id="user_age" type="number" name="user_age" placeholder="20" min=0 max=100>
        </div>
        <div class="p-insert-form__part">
          <label class="p-insert-form__part-label" for="user_address">住所</label>
          <input class="p-insert-form__part-input" id="user_address" type="text" name="user_address" placeholder="東京都" maxlength="255">
        </div>
        <button class="p-insert-form__submit" type="submit" name="submit" value="register">登録する</button>
      </form>
      <div class="p-insert__btn-back">
        <a href="./index.php" class="c-btn-back">トップへ戻る</a>
      </div>
    </div>
  </div>
</main>

<?php require_once(__DIR__ . '/layouts/footer.php'); ?>