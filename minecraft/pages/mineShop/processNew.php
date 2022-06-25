<?php
// var_dump($_POST);
$conn = mysqli_connect("127.0.0.1", "root", "gj987456~!", "project", 3306);
$sql = "
    INSERT INTO hospitals
    (name, tel, num, created)
    VALUES(
        '{$_POST['shopName']}',
        '{$_POST['phoneNo']}',
        '{$_POST['bizNo']}',
        NOW()
        )
";
$res = mysqli_query($conn, $sql);
if ($res === false) {
    echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
    error_log(mysqli_error($conn));
} else {
    echo "성공";
    // header('Location: author.php?title=' . $filtered['title']);
}
