<?php
// formで送信されたGETやPOSTの値を無害化する関数（XSS対策）
function sanitize($before)
{
  $after = [];
  foreach ($before as $key => $value) {
    $after[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
  }

  return $after;
}
