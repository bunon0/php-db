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
  <div class="l-main__inner">
    <div class="p-select">
      <h2 class="p-select__title">Selectページ</h2>
      <div class="p-select__table">
        <table class="c-table01">
          <thead class="c-table01__thead">
            <tr class="c-table01__row">
              <th class="c-table01__th">ID</th>
              <th class="c-table01__th">氏名</th>
            </tr>
          </thead>
          <tbody class="c-table01__tbody">
            <!-- データベースから取得してきたuser情報をテーブル列として表示 -->
            <?php
            foreach ($users as $user) {
              echo "
                <tr class='c-table01__row'>
                  <td class='c-table01__td'>{$user['id']}</td>
                  <td class='c-table01__td'>{$user['name']}</td>
                </tr>
              ";
            }
            ?>
          </tbody>
        </table>
      </div>
      <div class="p-select__btn-back">
        <a href="./index.php" class="c-btn-back">トップへ戻る</a>
      </div>
    </div>
  </div>
</main>

<?php require_once(__DIR__ . '/layouts/footer.php'); ?>