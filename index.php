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
        <div class="p-top-article__card">
          <h3 class="p-top-article__title">WHERE句でデータを検索する</h3>
          <div class="p-top-article__link">
            <a href="./where.php" class="p-top-article__link-inline">Link Page</a>
          </div>
        </div>
        <div class="p-top-article__card">
          <h3 class="p-top-article__title">userデータの更新と削除</h3>
          <div class="p-top-article__link">
            <a href="./users.php" class="p-top-article__link-inline">Link Page</a>
          </div>
        </div>
        <div class="p-top-article__card">
          <h3 class="p-top-article__title">userデータを並び替え</h3>
          <div class="p-top-article__link">
            <a href="./orderby.php" class="p-top-article__link-inline">Link Page</a>
          </div>
        </div>
      </article>
    </div>
  </div>
</main>

<?php require_once(__DIR__ . '/layouts/footer.php'); ?>