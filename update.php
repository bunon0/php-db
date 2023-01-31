<?php
require_once(__DIR__ . '/functions.php');

$db_user =  getenv('DB_USERNAME');
$db_pass = getenv('DB_PASSWORD');

// アクセス時にユーザー情報をDBから取得して表示
if (!empty($_GET['id'])) {
  $get = sanitize($_GET);
  // サニタイズしたGETの値をDB型と同じ型へ変換する
  $get['id'] = intval($get['id']);

  // DBへの接続
  try {
    $dbh = new PDO('mysql:dbname=php_db;host=localhost;', $db_user, $db_pass);
    $sql = "SELECT * FROM users WHERE id=:id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $get['id'], PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $dbh = null;

    if ($user === false) {
      exit('ユーザー情報が見つかりませんでした。');
    }
  } catch (PDOException $e) {
    exit('DB接続に失敗しました' . $e->getMessage());
  }
}

// 更新ボタンが押された時 - user情報の更新
if (isset($_POST['submit'])) {
  $post = sanitize($_POST);
  $get = sanitize($_GET);
  // サニタイズしたGETの値をDB型と同じ型へ変換する
  $get['id'] = intval($get['id']);
  $post['user_age'] = intval($post['user_age']);

  // DBへの接続
  $dbh = new PDO('mysql:dbname=php_db;host=localhost;', $db_user, $db_pass);
  $sql = "UPDATE users SET name=:name, furigana=:furigana, email=:email, age=:age, address=:address WHERE id=:id";
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':name', $post['user_name'], PDO::PARAM_STR);
  $stmt->bindValue(':furigana', $post['user_furigana'], PDO::PARAM_STR);
  $stmt->bindValue(':email', $post['user_email'], PDO::PARAM_STR);
  $stmt->bindValue(':age', $post['user_age'], PDO::PARAM_INT);
  $stmt->bindValue(':address', $post['user_address'], PDO::PARAM_STR);
  $stmt->bindValue(':id', $get['id'], PDO::PARAM_INT);
  $stmt->execute();
  $dbh = null;
  try {
  } catch (PDOException $e) {
    $e->getMessage();
  }
  header('Location: ./users.php');
}

?>

<?php require_once(__DIR__ . '/layouts/header.php'); ?>
<main class="l-main">

  <div class="l-main__inner">
    <div class="p-update">
      <?php
      // id=0がパラメータの値として来た場合の条件分岐
      if (!empty($user)) :
      ?>
        <div class="p-update__form">
          <form class="c-form01" action="./update.php?id=<?= $get['id']; ?>" method="post">
            <div class="c-form01__part">
              <label class="c-form01__part-label" for="user_name">名前<span class="c-form01__part-required">必須</span></label>
              <input class="c-form01__part-input" id="user_name" type="text" name="user_name" value="<?= $user['name']; ?>" placeholder="山田 太郎" maxlength="60" required>
            </div>
            <div class="c-form01__part">
              <label class="c-form01__part-label" for="user_furigana">フリガナ<span class="c-form01__part-required">必須</span></label>
              <input class="c-form01__part-input" id="user_furigana" type="text" name="user_furigana" value="<?= $user['furigana']; ?>" placeholder="やまだ たろう" maxlength="60" required>
            </div>
            <div class="c-form01__part">
              <label class="c-form01__part-label" for="user_email">メールアドレス<span class="c-form01__part-required">必須</span></label>
              <input class="c-form01__part-input" id="user_email" type="email" name="user_email" value="<?= $user['email']; ?>" placeholder="tarou@gmail.com" maxlength="255" required>
            </div>
            <div class="c-form01__part">
              <label class="c-form01__part-label" for="user_age">年齢</label>
              <input class="c-form01__part-input" id="user_age" type="number" name="user_age" value="<?= $user['age']; ?>" placeholder="20" min=0 max=100>
            </div>
            <div class="c-form01__part">
              <label class="c-form01__part-label" for="user_address">住所</label>
              <input class="c-form01__part-input" id="user_address" type="text" name="user_address" value="<?= $user['address']; ?>" placeholder="東京都" maxlength="255">
            </div>
            <button class="c-form01__submit" type="submit" name="submit" value="update">更新する</button>
          </form>
        </div>
        <!-- /.p-update__form -->
      <?php else : ?>
        <p>ユーザー情報が見つかりませんでした。</p>
      <?php endif; ?>

      <div class="p-update__btn-back">
        <a href="./users.php" class="c-btn-back">ユーザー情報一覧へ</a>
      </div>
    </div>
    <!-- /.p-update -->
  </div>
  <!-- /.l-main__inner -->
</main>

<?php require_once(__DIR__ . '/layouts/footer.php'); ?>