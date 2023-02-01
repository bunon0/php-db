<?php
require_once(__DIR__ . '/functions.php');

$db_user =  getenv('DB_USERNAME');
$db_pass = getenv('DB_PASSWORD');

try {
  $dbh = new PDO('mysql:dbname=php_db;:host=localhost;', $db_user, $db_pass);

  // 並び替えのパラメータの有無で処理を分ける
  if (isset($_GET['sort'])) {

    $get = sanitize($_GET);

    if ($get['sort'] === 'asc') {
      $sql = 'SELECT * FROM users ORDER BY age ASC';
    } elseif ($get['sort'] === 'desc') {
      $sql = 'SELECT * FROM users ORDER BY age DESC';
    } else {
      $sql = 'SELECT * FROM users ORDER BY id ASC';
    }
    // パラメータが渡れなかった場合
  } else {
    $_GET['sort']  = null;
    $sql = 'SELECT * FROM users ORDER BY id ASC';
  };

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
    <div class="p-orderby">
      <h2 class="p-orderby__title">
        データの並び替え
      </h2>

      <div class="p-orderby__btn-wrapper">
        <a href="./orderby.php?sort=asc" class="c-btn-sort">年齢順（昇順）</a>
        <a href="./orderby.php?sort=desc" class="c-btn-sort">年齢順（降順）</a>
        <a href="./orderby.php" class="c-btn-sort">リセット</a>
      </div>

      <div class="p-orderby__table">
        <table class="c-table01">
          <thead class="c-table01__thead">
            <tr class="c-table01__row">
              <th class="c-table01__th">ID</th>
              <th class="c-table01__th">氏名</th>
              <th class="c-table01__th">年齢</th>
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
                  <td class='c-table01__td'>{$user['age']}</td>
                </tr>
              ";
            }
            ?>
          </tbody>
        </table>
      </div>
      <div class="p-orderby__btn-back">
        <a href="./index.php" class="c-btn-back">トップへ戻る</a>
      </div>
    </div>
  </div>
</main>

<?php require_once(__DIR__ . '/layouts/footer.php'); ?>