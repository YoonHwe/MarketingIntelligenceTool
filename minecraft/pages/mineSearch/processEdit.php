<?php

$conn = mysqli_connect("127.0.0.1", "root", "gj987456~!", "project", 3306);

$filtered = array(
  'title' => mysqli_real_escape_string($conn, $_POST['shopName']),
  'keyword' => mysqli_real_escape_string($conn, $_POST['keyword']),
  'sort' => mysqli_real_escape_string($conn, $_POST['sort']),
  'type' => mysqli_real_escape_string($conn, $_POST['type']),
  'url' => mysqli_real_escape_string($conn, $_POST['orgUrl']),
  'pay' => mysqli_real_escape_string($conn, $_POST['payed'])
);

//--
$find = "SELECT * FROM keywords";
$res0 = mysqli_query($conn, $find);

while ($row = mysqli_fetch_array($res0)) {
    if (htmlspecialchars($row['shopname']) == $_POST['shopName'] && htmlspecialchars($row['word']) == $_POST['keyword']) {
        $id = htmlspecialchars($row['id']);
    }
}
$newKeyword = $_POST['newKeyword'];

$sql = "
  UPDATE keywords
    SET
      shopname = '{$filtered['title']}',
      word = '{$newKeyword}',
      value = '{$filtered['sort']}',
      channel = '{$filtered['type']}',
      url = '{$filtered['url']}',
      payed = '{$filtered['pay']}'
    WHERE
      id = '{$id}'
";

$res = mysqli_query($conn, $sql);
if ($res === false) {
  echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
  error_log(mysqli_error($conn));
} else {
  echo "성공";
  // header('Location: author.php?title=' . $filtered['title']);
}