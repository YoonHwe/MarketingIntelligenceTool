<?php
// var_dump($_POST);
$conn = mysqli_connect("localhost", "root", "kio134679", "mineshare", 3307);

header("Content-Type:application/json");
// DB 연결 환경파일

$shopname = $_GET['shopId']; 
$channel = $_GET['channel'];//VIEW와 파워링크 채널 선택

$query = "SELECT * FROM keywords JOIN $channel ON keywords.id=$channel.k_id
WHERE shopname='{$shopname}' 

--  최근 일주일 데이터 선택(들어있는 데이터 기준 최근)
AND s_date BETWEEN DATE_ADD(
(SELECT s_date FROM keywords JOIN $channel ON keywords.id=$channel.k_id WHERE shopname='{$shopname}'
 ORDER BY $channel.k_id desc, s_date desc limit 1)
,INTERVAL -6 DAY) AND 
(SELECT s_date FROM keywords JOIN $channel ON keywords.id=$channel.k_id WHERE shopname='{$shopname}'
 ORDER BY $channel.k_id desc, s_date desc limit 1)

-- 오늘 기준 일주일 데이터 선택
--  AND s_date between DATE_ADD(NOW(),INTERVAL -1 WEEK) AND NOW()

ORDER BY $channel.k_id ASC, s_date ASC";
//where조건 검색할 매장과 최근 7일의 조회
//order정렬 키워드 개수 알기위해서 k_id 오름차순, 순차적 데이터 삽입을 위한 날짜 오름차순

$res   = mysqli_query($conn, $query) or die("selecting error!");

if ($res) {

    $arr = array();
    while ($row = mysqli_fetch_object($res)) {

        //객체화 JSON칼럼명 = DB칼럼명
        $t = new stdClass();
        $t->rank = $row->rating;
        $t->date = $row->s_date;
        $t->k_id = $row->k_id;
        $t->word = $row->word;

        $arr[] = $t;
        unset($t);
    }
} else {
    $arr = array(0 => 'empty');
}


echo json_encode($arr);
