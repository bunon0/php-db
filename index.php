<?php
$db_user =  getenv('DB_USERNAME');
$db_pass = getenv('DB_PASSWORD');

try {
  $dbh = new PDO('mysql:localhost;dbname=php_db', $db_user, $db_pass);
  $dbh = null;
} catch (PDOException $e) {
  exit('DB接続に失敗しました。' . $e->getMessage());
}
?>

<?php require_once(__DIR__ . '/layouts/header.php'); ?>

<main class="l-main">
  <div class="l-main__inner">
    <div class="p-top">
      <h2 class="p-top__title">トップページ</h2>
      <article class="p-top-article">
        <div class="p-top-article__card">
          <h3 class="p-top-article__title">SElECT文でDBの値を取得して表示</h3>
          <div class="p-top-article__link">
            <a href="./select.php" class="p-top-article__link-inline">Link Page</a>
          </div>
        </div>
        <div class="p-top-article__card">
          <h3 class="p-top-article__title">INSERT文でDBにデータを挿入する</h3>
          <div class="p-top-article__link">
            <a href="./insert.php" class="p-top-article__link-inline">Link Page</a>
          </div>
        </div>
      </article>
    </div>
  </div>
</main>

<?php require_once(__DIR__ . '/layouts/footer.php'); ?>