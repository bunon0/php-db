<?php
require_once(__DIR__ . '/functions.php');
$db_user = getenv('DB_USERNAME');
$db_pass = getenv('DB_PASSWORD');

if (!empty($_GET)) {
  $get = sanitize($_GET);
  $get['id'] = intval($get['id']);

  try {
    $dbh = new PDO('mysql:dbname=php_db;host=localhost', $db_user, $db_pass);
    $sql = 'DELETE FROM users WHERE id=:id';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $get['id'], PDO::PARAM_STR);
    $stmt->execute();
    $delete_count = $stmt->rowCount();

    // 削除するユーザー情報があった場合
    if ($delete_count === 0) {
      header('refresh:3;url=./users.php');
      exit('削除対象が見つかりませんでした。3秒後にユーザー一覧ページに遷移します。');
    } else {
      header("Location: ./users.php?delete_count={$delete_count}");
    }

    $dbh = null;
  } catch (PDOException $e) {
    exit($e->getMessage('DBへ接続出来ませんでした'));
  }
} else {
  echo 'hoge';
}
