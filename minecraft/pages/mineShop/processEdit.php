<?php

$conn = mysqli_connect("127.0.0.1", "root", "gj987456~!", "project", 3306);

$filtered = array(
  'title' => mysqli_real_escape_string($conn, $_POST['shopName']),
  'phone' => mysqli_real_escape_string($conn, $_POST['phoneNo']),
  'biz' => mysqli_real_escape_string($conn, $_POST['bizNo'])
);

$sql = "
  UPDATE shop
    SET
      name = '{$filtered['title']}',
      tel = '{$filtered['phone']}',
      num = '{$filtered['biz']}'
    WHERE
      name = '{$filtered['title']}'
";

$res = mysqli_query($conn, $sql);
if ($res === false) {
  echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
  error_log(mysqli_error($conn));
} else {
  echo "성공";
  // header('Location: author.php?title=' . $filtered['title']);
}
