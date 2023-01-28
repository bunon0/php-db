<?php
$db_user =  getenv('DB_USERNAME');
$db_pass = getenv('DB_PASSWORD');

try {
  $dbh = new PDO('mysql:localhost;dbname=php_db', $db_user, $db_pass);
  echo 'DB接続に成功しました';

  $dbh = null;
} catch (PDOException $e) {
  exit('DB接続に失敗しました。' . $e->getMessage());
}
?>

<?php require_once(__DIR__ . '/layouts/header.php'); ?>

<main class="l-main">
  <div class="p-index"></div>
</main>

<?php require_once(__DIR__ . '/layouts/footer.php'); ?>