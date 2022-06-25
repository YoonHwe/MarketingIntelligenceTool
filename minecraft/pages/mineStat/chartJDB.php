<?php
// var_dump($_POST);
$conn = mysqli_connect("127.0.0.1", "root", "gj987456~!", "project", 3306);

header("Content-Type:application/json");
// DB 연결 환경파일

$query = "SELECT * FROM keywords k INNER JOIN view_ratings vr ON k.id = vr.k_id";
$res = mysqli_query($conn, $query) or die("selecting error!");

if ($res) {

    $arr = array();
    while ($row = mysqli_fetch_object($res)) {

        //객체화 JSON칼럼명 = DB칼럼명
        $t = new stdClass();
        $t->id = $row->k_id;
        // $t->id = $row->pk_id;
        $t->word = $row->word;
        $t->url = $row->url;
        $t->channel = $row->channel;
        // $t->comment = $row->comment;
        $t->value = $row->value;
        $t->shopname = $row->shopname;
        $t->payed = $row->payed;
        // $t->comment = $row->comment;
        // $t->comment = $row->comment;
        $t->date = $row->s_date;
        $t->rating = $row->rating;
        
        $arr[] = $t;
        unset($t);
    }
} else {
    $arr = array(0 => 'empty');
}

// $query = "SELECT * FROM keywords k INNER JOIN view_ratings vr ON k.id = vr.k_id";
$query = "SELECT * FROM keywords k INNER JOIN powerlink_ratings pr ON k.id = pr.k_id";
$res = mysqli_query($conn, $query) or die("selecting error!");

if ($res) {

    while ($row = mysqli_fetch_object($res)) {

        //객체화 JSON칼럼명 = DB칼럼명
        $t = new stdClass();
        // $t->id = $row->k_id;
        $t->id = $row->pk_id;
        $t->word = $row->word;
        $t->url = $row->url;
        $t->channel = $row->channel;
        // $t->comment = $row->comment;
        $t->value = $row->value;
        $t->shopname = $row->shopname;
        $t->payed = $row->payed;
        // $t->comment = $row->comment;
        // $t->comment = $row->comment;
        $t->date = $row->s_date;
        $t->rating = $row->rating;
        
        $arr[] = $t;
        unset($t);
    }
} else {
    $arr = array(0 => 'empty');
}


echo json_encode($arr);
