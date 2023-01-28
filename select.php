<?php
$db_user =  getenv('DB_USERNAME');
$db_pass = getenv('DB_PASSWORD');

try {
  $dbh = new PDO('mysql:dbname=php_db;:host=localhost;', $db_user, $db_pass);
  $sql = 'SELECT * FROM users';
  $stmt = $dbh->query($sql);
  $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $dbh = null;
} catch (PDOException $e) {
  exit('DB接続に失敗しました。' . $e->getMessage());
}
?>

<?php require_once(__DIR__ . '/layouts/header.php'); ?>

<main class="l-main">
  <div class="p-select">
    <table class="p-select-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>氏名</th>
        </tr>
      </thead>
      <tbody>
        <!-- データベースから取得してきたuser情報をテーブル列として表示 -->
        <?php
        foreach ($users as $user) {
          echo "
      <tr>
        <td>{$user['id']}</td>
        <td>{$user['name']}</td>
      </tr>
      ";
        }
        ?>
      </tbody>
    </table>
    <div class="p-select__btn-back">
      <a href="./index.php" class="c-btn-back">トップへ戻る</a>
    </div>
  </div>
</main>

<?php require_once(__DIR__ . '/layouts/footer.php'); ?>