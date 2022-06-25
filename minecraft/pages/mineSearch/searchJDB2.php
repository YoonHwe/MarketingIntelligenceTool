<?php
// var_dump($_POST);
$conn = mysqli_connect("127.0.0.1", "root", "gj987456~!", "project", 3306);

header("Content-Type:application/json");
// DB 연결 환경파일

$query = "SELECT * FROM keywords 
WHERE shopname='{$_GET['shopId']}'
";
//  AND channel='{$_POST['type']}' 



$res   = mysqli_query($conn, $query) or die("selecting error!");

// $shopId = $_GET["shopId"];
// $type = $_GET["type"];

$arr = array();



while ($row = mysqli_fetch_object($res)) {

    //객체화 JSON칼럼명 = DB칼럼명
    $t = new stdClass();
    $t->shopName = $row->shopname;
    $t->sort = $row->value;
    $t->keyword = $row->word;
    $t->type = $row->channel;
    $t->url = $row->url;
    $t->created = $row->date;


    $arr[] = $t;
    unset($t);
}


// if ($_GET['shopId'] != NULL && $_GET['type'] != NULL) {
//     $query = "SELECT * FROM keywords 
//     WHERE shopname='{$_GET["shopId"]}' 
//     AND channel='{$_GET["type"]}' ";
//     $res   = mysqli_query($conn, $query) or die("selecting error!");
//     while ($row = mysqli_fetch_object($res)) {

//         //객체화 JSON칼럼명 = DB칼럼명
//         $t = new stdClass();
//         $t->shopName = $row->shopname;
//         $t->sort = $row->value;
//         $t->keyword = $row->word;
//         $t->type = $row->channel;
//         $t->url = $row->url;
//         $t->created = $row->date;


//         $arr[] = $t;
//         unset($t);
//     }
// }


echo json_encode($arr);
// header('Location: index.php');
