<?php
ini_set("default_socket_timeout", 30);
require_once 'restapi.php';

$config = parse_ini_file("sample.ini");
print_r($config);

function debug($obj, $detail = false)
{
    if (is_array($obj)) {
        echo "size : " . count($obj) . "\n";
    }
    if ($detail) {
        print_r($obj);
    }
}

// #. detail log
$DEBUG = false;

$api = new RestApi($config['BASE_URL'], $config['API_KEY'], $config['SECRET_KEY'], $config['CUSTOMER_ID']);

echo "Test StatReport\n";
$reportType = "AD_DETAIL";
$statDt = date('Ymd',strtotime("-1 days"));;
$stat_req = array(
    "reportTp" => $reportType,
    "statDt" => $statDt
);

$response = $api->POST("/stat-reports", $stat_req);
debug($response, $DEBUG);
$reportjobid = $response["reportJobId"];
$status = $response["status"];
echo "registed : reportJobId = $reportjobid, status = " . $status . "\n";
while ($status == 'REGIST' || $status == 'RUNNING' || $status == 'WAITING') {
    echo "waiting a report..\n";
    sleep(5);
    $response = $api->GET("/stat-reports/" . $reportjobid);
    $status = $response["status"];
    echo "check : reportJobId = $reportjobid, status = " . $status . "\n";
}
if ($status == 'BUILT') {
    echo "downloadUrl => " . $response["downloadUrl"] . "\n";
    $api->DOWNLOAD($response["downloadUrl"], $reportType . "-" . $statDt . ".tsv");
} else if ($status == 'ERROR') {
    echo "failed to build stat report\n";
} else if ($status == 'NONE') {
    echo "report has no data\n";
} else if ($status == 'AGGREGATING') {
    echo "stat aggregation not yet finished\n";
}

echo "\nTest End\n";
echo "==============================================================================================================================";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>네이버 API</h1>
    <form method="POST">
        검색 키워드: <input type="text" name="hintkeyword" />
    </form>
</body>
</html>

<?php 
$hintKeywords = $_POST['hintkeyword']; 
$param = array (
    'format' => 'json', 
    'hintKeywords' => $hintKeywords, 
    'includeHintKeywords' => 0, 
    'siteId' => '', 
    'biztpId' => '', 
    'month' => '', 
    'event' => '', 
    'showDetail' => 1, 
    'keyword' => '' 
); 
$tmp_list = $api->GET('/keywordstool', $param); 
debug($tmp_list, $DEBUG);

// $i = 0;

// while($i<=20) {
//     echo "<br />";
// 	echo $i."번 연관검색어: ";
//     print_r(($tmp_list['keywordList'][$i]['relKeyword']));
//     echo " / ";
//     if($tmp_list['keywordList'][$i]['monthlyPcQcCnt'] == "< 10"){
//         $tmp_list['keywordList'][$i]['monthlyPcQcCnt'] = 10;
//     }
//     echo ($tmp_list['keywordList'][$i]['monthlyPcQcCnt'] + $tmp_list['keywordList'][$i]['monthlyMobileQcCnt']);
//     echo " / ";
//     //print_r(($tmp_list['keywordList'][$i]['monthlyPcQcCnt']));
//     //print_r(($tmp_list['keywordList'][$i]['monthlyMobileQcCnt']));
//     echo ($tmp_list['keywordList'][$i]['monthlyAvePcClkCnt'] + $tmp_list['keywordList'][$i]['monthlyAveMobileClkCnt']);
//     // print_r(($tmp_list['keywordList'][$i]['monthlyAvePcClkCnt']));
//     // print_r(($tmp_list['keywordList'][$i]['monthlyAveMobileClkCnt']));
//     echo " / ";
//     print_r(($tmp_list['keywordList'][$i]['compIdx']));

// 	$i++; 
// }
?>

<table id="tableShop" class="table table-bordered table-striped" style="border: 1px solid black; border-collapse:collapse;">
    <thead style="border: 1px solid black;">
      <tr>
        <th style="border: 1px solid black;">순서</th>
        <th style="border: 1px solid black;">연관검색어</th>
        <th style="border: 1px solid black;">검색수</th>
        <th style="border: 1px solid black;">클릭수</th>
        <th style="border: 1px solid black;">경쟁정도</th>
        <th style="border: 1px solid black;">작성일자점수</th>
        <th style="border: 1px solid black;">검색수점수</th>
        <th style="border: 1px solid black;">클릭수점수</th>
        <th style="border: 1px solid black;">경쟁정도점수</th>
      </tr>
    </thead>
    <tbody>
        <?php 
        $index = 0;
        $qcCntArray[21] = -1;
        $clkCntArray[21] = -1;
        //$qcCntArray[0] = 0;
        //$clkCntArray[0] = 0;
        $qcCntMin = 0; 
        $qcCntMax = 0; 
        $clkCntMin = 0; 
        $clkCntMax = 0;
        while($index <= 20){
            if($tmp_list['keywordList'][$index]['monthlyPcQcCnt'] == "< 10"){
                $tmp_list['keywordList'][$index]['monthlyPcQcCnt'] = 10;
            }
            $qcCntArray[$index] = ($tmp_list['keywordList'][$index]['monthlyPcQcCnt'] + $tmp_list['keywordList'][$index]['monthlyMobileQcCnt']);
            if(($qcCntArray[$index] < $qcCntMin) && $qcCntArray[$index] >= 0){
                $qcCntMin = $qcCntArray[$index];
            }
            elseif($qcCntArray[$index] > $qcCntMax){
                $qcCntMax = $qcCntArray[$index];
            }
            $clkCntArray[$index] = ($tmp_list['keywordList'][$index]['monthlyAvePcClkCnt'] + $tmp_list['keywordList'][$index]['monthlyAveMobileClkCnt']);
            if(($clkCntArray[$index] < $clkCntMin) && $clkCntArray[$index] >= 0){
                $clkCntMin = $clkCntArray[$index];
            }
            elseif($clkCntArray[$index] > $clkCntMax){
                $clkCntMax = $clkCntArray[$index];
            }
            $index++;
        }
        
        $qcCntDenominator = $qcCntMax - $qcCntMin;
        $clkCntDenominator = $clkCntMax - $clkCntMin;

        $qcCntScore;
        $clckCntScore;
        $compIdxScore;

        $index = 0;
        while($index <= 20){
            echo "<tr>";
            echo "<td style='border: 1px solid black;'>$index</td>";
            echo "<td style='border: 1px solid black;'>";
            print_r(($tmp_list['keywordList'][$index]['relKeyword']));
            echo "</td>";            
            echo "<td style='border: 1px solid black;'>";
            echo ($qcCntArray[$index]) ;
            echo "</td>";  
            echo "<td style='border: 1px solid black;'>";
            echo ($clkCntArray[$index]);
            echo "</td>";  
            echo "<td style='border: 1px solid black;'>";
            print_r(($tmp_list['keywordList'][$index]['compIdx']));
            echo "</td>";  
            echo "<td style='border: 1px solid black;'>";
            echo "</td>";  
            echo "<td style='border: 1px solid black;'>";
            $qcCntScore = round($qcCntArray[$index] / $qcCntDenominator * 50, 2);
            print_r($qcCntScore);
            echo "</td>";  
            echo "<td style='border: 1px solid black;'>";
            $clkCntScore = round($clkCntArray[$index] / $clkCntDenominator * 10, 2);
            print_r($clkCntScore);
            echo "</td>";
            echo "<td style='border: 1px solid black;'>";
            if($tmp_list['keywordList'][$index]['compIdx'] == '높음'){
                $compIdxScore = 10;
            }
            elseif($tmp_list['keywordList'][$index]['compIdx'] == '중간'){
                $compIdxScore = 15;
            }
            else{
                $compIdxScore = 20;
            }
            print_r($compIdxScore * 0);
            echo "</td>";  
            echo "</tr>";
            $index++;
        }
        ?>
    </tbody>
    <tfoot>
      <tr>
        <th style='border: 1px solid black;'>순서</th>
        <th style='border: 1px solid black;'>연관검색어</th>
        <th style='border: 1px solid black;'>검색수</th>
        <th style='border: 1px solid black;'>클릭수</th>
        <th style='border: 1px solid black;'>경쟁정도</th>
        <th style='border: 1px solid black;'>작성일자점수</th>
        <th style='border: 1px solid black;'>검색수점수</th>
        <th style='border: 1px solid black;'>클릭수점수</th>
        <th style="border: 1px solid black;">경쟁정도점수</th>
      </tr>
    </tfoot>
</table>