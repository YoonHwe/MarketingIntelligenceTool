<?php
// var_dump($_POST);
$conn = mysqli_connect("localhost", "root", "kio134679", "mineshare", 3307);

header("Content-Type:application/json");
// DB 연결 환경파일

$query = "SELECT * FROM view_ratings";
$res   = mysqli_query($conn, $query) or die("selecting error!");

if ($res) {

    $arr = array();
    while ($row = mysqli_fetch_object($res)) {

        //객체화 JSON칼럼명 = DB칼럼명
        $t = new stdClass();
        $t->rank = $row->rating;
        $t->date = $row->s_date;


        $arr[] = $t;
        unset($t);
    }
} else {
    $arr = array(0 => 'empty');
}


echo json_encode($arr);
