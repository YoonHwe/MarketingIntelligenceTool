<?php
// var_dump($_POST);
$conn = mysqli_connect("127.0.0.1", "root", "gj987456~!", "project", 3306);

header("Content-Type:application/json");
// DB 연결 환경파일

$query = "SELECT * FROM hospitals";
$res   = mysqli_query($conn, $query) or die("selecting error!");

if ($res) {

    $arr = array();
    while ($row = mysqli_fetch_object($res)) {

        //객체화 JSON칼럼명 = DB칼럼명
        $t = new stdClass();
        $t->shopName = $row->name;
        $t->phoneNo = $row->tel;
        $t->bizNo  = $row->num;


        $arr[] = $t;
        unset($t);
    }
} else {
    $arr = array(0 => 'empty');
}


echo json_encode($arr);
