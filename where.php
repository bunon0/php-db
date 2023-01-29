<?php
require_once(__DIR__ . '/functions.php');

$db_user =  getenv('DB_USERNAME');
$db_pass = getenv('DB_PASSWORD');


if (!empty($_GET['keyword'])) {
  // サニタイズ
  $get = sanitize($_GET);
  $keyword = "%{$get['keyword']}%";

  // DBからuserデータの取得
  try {
    $dbh = new PDO('mysql:host=localhost;dbname=php_db', $db_user, $db_pass);
    $sql = 'SELECT * FROM users WHERE furigana LIKE :keyword';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':keyword', $keyword, PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $dbh = null;
  } catch (PDOException $e) {
    exit('DB接続に失敗しました。' . $e->getMessage());
  }
} else {
  $keyword = '%%';

  // DBからuserデータの取得
  try {
    $dbh = new PDO('mysql:host=localhost;dbname=php_db', $db_user, $db_pass);
    $sql = 'SELECT * FROM users WHERE furigana LIKE :keyword';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':keyword', $keyword, PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $dbh = null;
  } catch (PDOException $e) {
    exit('DB接続に失敗しました。' . $e->getMessage());
  }
}
?>

<?php require_once(__DIR__ . '/layouts/header.php'); ?>

<main class="l-main">
  <div class="l-main__inner">
    <div class="p-where">
      <h2 class="p-where__title">ユーザー検索</h2>
      <div class="p-where__form">
        <form action="./where.php" method="get">
          <input type="text" name="keyword" placeholder="ふりがなで検索">
          <button type="submit" name="submit" value="search">検索</button>
        </form>
      </div>
      <!-- table -->
      <div class="p-where__table">
        <table class="c-table01">
          <thead class="c-table01__thead">
            <tr class="c-table01__row">
              <th class="c-table01__th">氏名</th>
              <th class="c-table01__th">ふりがな</th>
            </tr>
          </thead>
          <tbody class="c-table01__tbody">
            <!-- データベースから取得してきたuser情報をテーブル列として表示 -->
            <?php
            foreach ($results as $result) {
              echo "
                <tr class='c-table01__row'>
                  <td class='c-table01__td'>{$result['name']}</td>
                  <td class='c-table01__td'>{$result['furigana']}</td>
                </tr>
              ";
            }
            ?>
          </tbody>
        </table>
        <!-- /table -->
      </div>
      <div class="p-insert__btn-back">
        <a href="./index.php" class="c-btn-back">トップへ戻る</a>
      </div>
    </div>
  </div>
  <!-- /.l-main__inner -->
</main>

<?php require_once(__DIR__ . '/layouts/footer.php'); ?>