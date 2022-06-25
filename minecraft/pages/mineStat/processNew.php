<?php
$conn = mysqli_connect("localhost", "root", "kio134679", "mineshare", 3307);
$channel = $_POST['channel'];
$sql = "
    INSERT INTO $channel
    (k_id, rating, s_date)
    VALUES(
        '{$_POST['k_id']}',
        '{$_POST['rating']}',
        '{$_POST['s_date']}'
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
