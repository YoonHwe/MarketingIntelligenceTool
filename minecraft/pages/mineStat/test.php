<?php
// Include the library
include_once('simple_html_dom.php');
$urlAddress = json_decode( $_POST['val'] );
$urlAddress = (array)$urlAddress;

//$urlAddress = new stdClass();
$today = new DateTime();
$dateOfTenArticles = array();

$dateGapAll = array();
$dateGappAllIndex = 0;

for($i = 1; $i <= count($urlAddress); $i++){
    $idx = 0;
    $target = $urlAddress[$i];
    $html = file_get_html($target);
    foreach($html->find('.sub_time') as $t){
        if($idx < 10){
            $newDate = $t->text();
            $newDate = str_replace('.', '', $newDate);
            $dateDiff = 0;
            if(strpos($newDate, '일 전')){
                //echo "case1...";
                $newDate = str_replace('일 전', '', $newDate);
                $dateDiff = $newDate;
                $dateDiff = intval($dateDiff);
                $dateOfTenArticles[$idx] = $dateDiff;
                // echo $idx.") 날짜차이: ". $dateDiff." ". gettype($dateDiff). "<br>" ;
            }
            else if($newDate == '어제'){
                //echo "case2...";
                $dateDiff = 1;
                $dateOfTenArticles[$idx] = $dateDiff;
                // echo $idx.") 날짜차이: ". $dateDiff." ". gettype($dateDiff). "<br>" ;
            }
            else if(strpos($newDate, '분 전') || strpos($newDate, '시간 전')){
                //echo "case3...";
                $dateDiff = 0;
                $dateOfTenArticles[$idx] = $dateDiff;
                // echo $idx.") 날짜차이: ". $dateDiff." ". gettype($dateDiff). "<br>" ;
            }
            else{
                //echo "case4...";
                $newDate = new DateTime($newDate);
                $dateDiff = $today->diff($newDate);
                $dateOfTenArticles[$idx] = $dateDiff->days;
                // echo $idx.") 날짜차이: ". $dateDiff->days." ". gettype($dateDiff->days). "<br>";
            }
            $idx++;
        }
        else{
            break;
        }
    }
    $html->clear();
    //print_r($dateOfTenArticles);
    $avg = (array_sum($dateOfTenArticles)) / (sizeof($dateOfTenArticles));
    // echo "<br> 평균: ". $avg. "<br>";
    $dateGapAll[$dateGappAllIndex] = $avg;
    $dateGappAllIndex++;
}
//print_r($dateGapAll);
arsort($dateGapAll);
//print_r($dateGapAll);
$dateGapScore = array();
$dateGapScoreValue = 40;
foreach ($dateGapAll as $key => $value){
    $dateGapScore[$key] = $dateGapScoreValue;
    $dateGapScoreValue -= 2;
    if($dateGapScoreValue < 0){
        break;
    }
}

print_r(json_encode($dateGapScore));
?>