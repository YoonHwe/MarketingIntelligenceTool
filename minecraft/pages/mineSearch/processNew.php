<?php
// var_dump($_POST);
$conn = mysqli_connect("127.0.0.1", "root", "gj987456~!", "project", 3306);

$id = 0;

//--
$find = "SELECT * FROM hospitals";
$res0 = mysqli_query($conn, $find);

while ($row = mysqli_fetch_array($res0)) {
    if (htmlspecialchars($row['name']) == $_POST['shopName']) {
        $id = htmlspecialchars($row['id']);
    }
}

//--

$date = date("Y m d");
$sql = "
    INSERT INTO keywords
    (h_id, word, url, channel, value, shopname, payed)
    VALUES(
        '{$id}',
        '{$_POST['keyword']}',
        '{$_POST['orgUrl']}',
        '{$_POST['type']}',
        '{$_POST['value']}',
        '{$_POST['shopName']}',
        '{$_POST['payed']}'
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
