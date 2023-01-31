<?php
require_once(__DIR__ . '/functions.php');

$db_user =  getenv('DB_USERNAME');
$db_pass = getenv('DB_PASSWORD');

try {
  $dbh = new PDO('mysql:dbname=php_db;:host=localhost;', $db_user, $db_pass);
  $sql = 'SELECT * FROM users';
  $stmt = $dbh->query($sql);
  $users = $stmt->fetchAll();

  $dbh = null;
} catch (PDOException $e) {
  exit('DB接続に失敗しました。' . $e->getMessage());
}

if (!empty($_GET['delete_count'])) {
  $get_delete_count = htmlspecialchars($_GET['delete_count'], ENT_QUOTES, 'UTF-8');
  $delete_count = intval($get_delete_count);
} else {
  $delete_count = null;
}


?>

<?php require_once(__DIR__ . '/layouts/header.php'); ?>

<main class="l-main">

  <div class="l-main__inner">
    <div class="p-users">
      <h2 class="p-users__title">ユーザー情報一覧</h2>
      <!-- ユーザー情報が変化した場合メッセージの表示 -->
      <?php if ($delete_count) {
        echo "<p class='p-user__message'>ユーザー情報を{$delete_count}件削除しました。</p>";
      } ?>
      <div class="p-users__table">
        <table class="c-table01">
          <thead class="c-table01__thead">
            <tr class="c-table01__row">
              <th class="c-table01__th">ID</th>
              <th class="c-table01__th">氏名</th>
              <th class="c-table01__th">ふりがな</th>
              <th class="c-table01__th">メールアドレス</th>
              <th class="c-table01__th">年齢</th>
              <th class="c-table01__th">住所</th>
              <th class="c-table01__th">編集</th>
              <th class="c-table01__th">削除</th>
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
                  <td class='c-table01__td'>{$user['furigana']}</td>
                  <td class='c-table01__td'>{$user['email']}</td>
                  <td class='c-table01__td'>{$user['age']}</td>
                  <td class='c-table01__td'>{$user['address']}</td>
                  <td class='c-table01__td'>
                    <a href='./update.php?id={$user['id']}' class='c-table01__edit'>編集</a>
                  </td>
                  <td class='c-table01__td'>
                    <a href='./delete.php?id={$user['id']}' class='c-table01__delete'>削除</a>
                  </td>
                </tr>
              ";
            }
            ?>
          </tbody>
        </table>
        <!-- /.c-table -->
      </div>
      <!-- /.p-users__table -->
      <div class="p-users__btn-back">
        <a href="./index.php" class="c-btn-back">トップへ戻る</a>
      </div>
    </div>
    <!-- /.p-users -->
  </div>
  <!-- /.l-main__inner -->
</main>

<?php require_once(__DIR__ . '/layouts/footer.php'); ?>