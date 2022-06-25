<?php
$conn = mysqli_connect("127.0.0.1", "root", "gj987456~!", "project", 3306);
?>

<!DOCTYPE html>
<html lang="ko">
<?php include '../phpForm/head.php'; ?>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php include '../phpForm/navbar.php'; ?>
    <?php include '../phpForm/sidebar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>차트</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">chart</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- 내용 -->
    <!-- Main content(임시 제작 도표) -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- 기존 사이즈는 col-md-6 -->
            <!-- LINE CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Keyword Score</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
              <table id="tableChart" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>word</th>
                        <th>url</th>
                        <th>channel</th>
                        <th>shopname</th>
                        <th>payed</th>
                        <th>date</th>
                        <th>rating</th>
                        <th>score</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>111</td>
                        <td>강남한방병원1</td>
                        <td>https://blog.naver.com/weedahmwin/2226679122441</td>
                        <td>VIEW1</td>
                        <td>위담한방병원1</td>
                        <td>21</td>
                        <td>2022-05-11 19:11:061</td>
                        <td>51</td>
                        <td></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>id</th>
                        <th>word</th>
                        <th>url</th>
                        <th>channel</th>
                        <th>shopname</th>
                        <th>payed</th>
                        <th>date</th>
                        <th>rating</th>
                        <th>score</th>
                      </tr>
                    </tfoot>
                  </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
        <div class="container-fluid score-computation" style="display: none;">
          <div class="row">
            <!-- 기존 사이즈는 col-md-6 -->
            <!-- LINE CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Score Computation</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool remove" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <h1 id="selected-keyword">등록 키워드: </h1>
                  <h3 id="selected-keyword-total" style="border: 1px solid black;">키워드 총점: 계산 중...</h3>
                  <h3 id="selected-keyword-rating" style="border: 1px solid black;">키워드 노출 순위: 계산 중...</h3>
                  <h3 id="selected-keyword-qccount" style="border: 1px solid black;">키워드 검색수: 계산 중...</h3>
                  <h3 id="selected-keyword-clkcount" style="border: 1px solid black;">키워드 클릭수: 계산 중...</h3>
                  <h3 id="selected-keyword-comp" style="border: 1px solid black;">경쟁정도 계산 중: ...</h3>

<?php
ini_set("default_socket_timeout", 30);
require_once 'restapi.php';

$config = parse_ini_file("sample.ini");
//print_r($config);

function debug($obj, $detail = false){}

// #. detail log
$DEBUG = false;

$api = new RestApi($config['BASE_URL'], $config['API_KEY'], $config['SECRET_KEY'], $config['CUSTOMER_ID']);

//echo "Test StatReport\n";
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
while ($status == 'REGIST' || $status == 'RUNNING' || $status == 'WAITING') {
    sleep(5);
    $response = $api->GET("/stat-reports/" . $reportjobid);
    $status = $response["status"];
}
if ($status == 'BUILT') {
    $api->DOWNLOAD($response["downloadUrl"], $reportType . "-" . $statDt . ".tsv");
}

?>
<br>
<form method="POST" id="api-call-form">
    API 검색 키워드: <input id="api-call-keyword" type="text" name="hintkeyword" />
</form>


<?php
$hintKeywords = $_POST['hintkeyword']; 
if($hintKeywords == ""){
  $hintKeywords = "강남한방병원"; //기본값 처리
}
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
?>

<table id="tableShop" class="table table-bordered table-striped" style="border: 1px solid black; border-collapse: collapse;">
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
        <th style="border: 1px solid black;">총점수</th>
      </tr>
    </thead>
    <tbody>
        <?php 
        $index = 0; //연관검색어 추출 위한 index(20까지)
        $qcCntArray[21] = -1; //검색수 배열 초기화
        $clkCntArray[21] = -1; //클릭수 배열 초기화
        $qcCntMin = 0; //검색수 배열 중 최솟값 for 정규화
        $qcCntMax = 0;  //검색수 배열 중 최댓값 for 정규화
        $clkCntMin = 0; //클릭수 배열 중 최솟값 for 정규화
        $clkCntMax = 0;//클릭수 배열 중 최댓값 for 정규화
        while($index <= 20){ //연관검색어 20개 + 등록 검색어 1개까지
            if($tmp_list['keywordList'][$index]['monthlyPcQcCnt'] == "< 10"){
                $tmp_list['keywordList'][$index]['monthlyPcQcCnt'] = 10; //현재 API에서 표기되고 있는 < 문자 제거
            }

            $qcCntArray[$index] = ($tmp_list['keywordList'][$index]['monthlyPcQcCnt'] + $tmp_list['keywordList'][$index]['monthlyMobileQcCnt']); //총 검색수 = 모바일 + PC 검색수
            //검색수 최대 최소 저장
            if(($qcCntArray[$index] < $qcCntMin) && $qcCntArray[$index] >= 0){
                $qcCntMin = $qcCntArray[$index];
            }
            elseif($qcCntArray[$index] > $qcCntMax){
                $qcCntMax = $qcCntArray[$index];
            }

            $clkCntArray[$index] = ($tmp_list['keywordList'][$index]['monthlyAvePcClkCnt'] + $tmp_list['keywordList'][$index]['monthlyAveMobileClkCnt']); //총 클릭수 = 모바일 + PC 클릭수
            //클릭수 최대 최소 저장
            if(($clkCntArray[$index] < $clkCntMin) && $clkCntArray[$index] >= 0){
                $clkCntMin = $clkCntArray[$index];
            }
            elseif($clkCntArray[$index] > $clkCntMax){
                $clkCntMax = $clkCntArray[$index];
            }

            $index++; //다음 연관검색어로 이동
        }
        
        $qcCntDenominator = $qcCntMax - $qcCntMin; // 최대 - 최소 검색수 for 정규화
        $clkCntDenominator = $clkCntMax - $clkCntMin; //최대 - 최소 클릭수 for 정규화

        $qcCntScore; //검색수 점수
        $clckCntScore; //클릭수 점수
        $compIdxScore; //경쟁정도 점수

        $index = 0; //테이블에 점수 등록하기 위한 index

        while($index <= 20){  //테이블에 있는 검색어 수만큼
            echo "<tr>";

            echo "<td style='border: 1px solid black;'>$index</td>"; //순서

            echo "<td style='border: 1px solid black;'>";
            print_r(($tmp_list['keywordList'][$index]['relKeyword'])); //연관검색어
            echo "</td>";

            echo "<td style='border: 1px solid black;'>";
            echo ($qcCntArray[$index]); //검색 수
            echo "</td>";

            echo "<td style='border: 1px solid black;'>";
            echo ($clkCntArray[$index]); //클릭 수
            echo "</td>";

            echo "<td style='border: 1px solid black;'>";
            print_r(($tmp_list['keywordList'][$index]['compIdx'])); //경쟁정도
            echo "</td>";

            echo "<td style='border: 1px solid black;'>";
            //작성일자 점수(우선 공백)
            echo "</td>";

            echo "<td style='border: 1px solid black;'>";
            $qcCntScore = round($qcCntArray[$index] / $qcCntDenominator * 50, 2); //VIEW + 연관 + payed No 비중 적용
            print_r($qcCntScore); //검색수 점수
            echo "</td>";  

            echo "<td style='border: 1px solid black;'>";
            $clkCntScore = round($clkCntArray[$index] / $clkCntDenominator * 10, 2); //VIEW + 연관 + payed No 비중 적용
            print_r($clkCntScore); //클릭수 점수
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
            print_r($compIdxScore * 0); //경쟁정도 비중 적용 점수
            echo "</td>";

            echo "</tr>";

            $index++; //다음 검색어로 이동
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
        <th style="border: 1px solid black;">총점수</th>
      </tr>
    </tfoot>
</table>
<div id="for-new-table"></div> <!-- 새로운 테이블을 화면에 띄우는 작업에 필요한 임시공간 -->
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.1.0
      </div>
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <?php include '../phpForm/script.php'; ?>
  <script src="../../plugins/chart.js/Chart.min.js"></script>
  
  <!-- ChartJS -->
  <script> //chartJDB로부터 MySQL 데이터 가져오기
    $(function() {
      let tableChart = $("#tableChart").DataTable({
        ajax: {
          url: "chartJDB.php",
          dataSrc: ''
        },
        columns: [{
          data: 'id',
        },{
          data: 'word'
        },{
          data: 'url'
        },{
          data: 'channel'
        },{
          data: 'shopname'
        },{
          data: 'payed'
        },{
          data: 'date'
        },{
          data: 'rating'
        },{
          data: null,
          orderable: false,
          searchable: false,
          defaultContent: '<button class="btn btn-xs btn-block btn-score" style="background-color: skyblue; border: 2px solid black; border-radius: 10%;"> 점수 </button>'
        }],
        paging: true,
        lengthChange: false,
        searching: false,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: true
      });
    });
  </script>

  <script> //점수 클릭 -> 
    $("#tableChart").on('click', 'button.btn-score', function(target) {
      
      //선택한 키워드 추출
      let clickedRow = target.currentTarget.parentNode.parentNode; //풀 화면 기준
      let clickedRowKeyword;
      if(clickedRow.nodeName != "TR"){ //풀 화면 아닐 때(위 요소에서 X로 닫지 않았을 경우 작동 오류..)
        clickedRow = target.currentTarget.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.querySelector(".parent");
      }

      const informationOfChannel = clickedRow.childNodes[3].innerText;
      const informationOfPayed = clickedRow.childNodes[5].innerText;

      clickedRowKeyword = clickedRow.childNodes[1].innerText;
      const selectedKeyword = document.querySelector("#selected-keyword");
      selectedKeyword.innerText = `선택된 키워드: ${clickedRowKeyword}`;

      //선택한 키워드 API input에 넣기
      const callAPIKeyword = document.querySelector("#api-call-keyword");
      callAPIKeyword.value = clickedRowKeyword;

      //API 호출
      callAPI();

      //선택한 키워드의 노출 순위 추출
      let clickedRowKeywordRating = clickedRow.childNodes[7].innerText; //노출 순위 in rating

      //등록 키워드 요소 '계산 중'으로 초기화 + 노출 순위만 표시
      const selectedKeywordRating = document.querySelector("#selected-keyword-rating");
      selectedKeywordRating.innerText = "키워드 총점 계산 중...";
      selectedKeywordRating.innerText = `키워드 노출순위: ${clickedRowKeywordRating}위`;
      const selectedKeywordQc = document.querySelector("#selected-keyword-qccount");
      selectedKeywordQc.innerText = "키워드 검색수 계산 중...";
      const selectedKeywordClk = document.querySelector("#selected-keyword-clkcount");
      selectedKeywordClk.innerText = "키워드 클릭수 계산 중...";
      const selectedKeywordComp = document.querySelector("#selected-keyword-comp");
      selectedKeywordComp.innerText = "경쟁정도 계산 중...";

      //선택한 키워드의 검색수 / 클릭수 추출
      const contentWrapper = document.querySelector(".content .container-fluid");
      const scoreComputation = document.querySelector(".score-computation");
      scoreComputation.style.display = "block";
      const scoreComputationCard = scoreComputation.querySelector(".card-info");
      scoreComputationCard.style.display = "block";
      contentWrapper.style.opacity = ".1";
    });
  </script>
  
  <script>
    //기존 테이블
    const originalTable = document.querySelector("#tableShop");
    originalTable.style.display = "none";
    //테이블 복사를 위한 새로운 공간 생성
    const divForNewTable = document.querySelector("#for-new-table");
    divForNewTable.style.display = "none";
          
    //NAVER API 호출 함수
    function callAPI(){
      const apiCallForm = $("#api-call-form")[0];
      let data = new FormData(apiCallForm);

      $.ajax({
        type: 'POST',
        url: "keywordScore.php",
        data: data,
        processData: false,
        contentType: false,
        cache: false,

        success: function(data){
          // console.log(data)
          divForNewTable.innerHTML = data;
          const newTable = divForNewTable.querySelector("#tableShop");
          originalTable.innerHTML = newTable.innerHTML;
          originalTable.style.display = "block";
          const selectedKeywordTotal = document.querySelector("#selected-keyword-total");
          const selectedKeywordQcCount = document.querySelector("#selected-keyword-qccount");
          const selectedKeywordClkCount = document.querySelector("#selected-keyword-clkcount");
          const selectedKeywordComp = document.querySelector("#selected-keyword-comp");
          //22:10 테스트
          
          //console.dir(newTable);
          //console.log(newTable.childNodes[3].childNodes);
          const getRelatedKeyword = newTable.childNodes[3].childNodes;
          let index = 0;
          let relatedKeywordArray = new Object();
          getRelatedKeyword.forEach(function(value, key, parent){
            if(value.nodeName != "#text"){            
              let urlWord = value.childNodes[1].innerText;
              // console.log(urlWord); //단어 추출
              let urlAddress = `https://m.search.naver.com/search.naver?sm=tab_hty.top&where=m_view&query=${urlWord}`;
              // console.log(urlAddress);
              relatedKeywordArray[key] = urlAddress;
             
              const table = document.querySelector("#tableShop tbody");
              const tableDateGap = table.childNodes[key].childNodes[5]
              tableDateGap.innerText = "계산중..."; 
            }
          });
          console.log(relatedKeywordArray);
          relatedKeywordArray = JSON.stringify(relatedKeywordArray);
          $.ajax({
            type: 'POST',
            url: 'test.php',
            data: {val: relatedKeywordArray},
            error: function(){
              alert("작성 일자 호출 실패");
            },
            success: function(result){
              // console.log(result);
              const resultDecode = JSON.parse(result);
              console.log(resultDecode);
              // console.log(typeof(resultDecode));
              resultDecodeIndex = 0;
              getRelatedKeyword.forEach(function(value, key, parent){
                if(value.nodeName != "#text"){
                  const table = document.querySelector("#tableShop tbody");
                  const tableDateGap = table.childNodes[key].childNodes[5];
                  tableDateGap.innerText = resultDecode[resultDecodeIndex];
                  //resultDecode[resultDecodeIndex] * 0.4;
                  resultDecodeIndex++; 
                }
              });
              const table = document.querySelector("#tableShop tbody");
              const totalScoreArray = [];
              //console.dir(table.children);
              for(let i = 0; i < table.children.length; i++){
                const targetChildren = table.children[i];
                const targetDateGapScore = parseFloat(targetChildren.childNodes[5].innerText);
                const targetQcScore = parseFloat(targetChildren.childNodes[6].innerText);
                const targetClkScore = parseFloat(targetChildren.childNodes[7].innerText);
                const targetTotalScore = Math.round((targetDateGapScore + targetQcScore + targetClkScore) * 100) / 100;
                // console.log(`총 점수: ${targetTotalScore}`);
                const totalScoreOnTable = document.createElement("td");
                totalScoreArray.push(targetTotalScore);
                console.log("targetscore 형식: ", typeof(targetTotalScore));
                totalScoreOnTable.innerText = targetTotalScore;
                totalScoreOnTable.style.border = "1px solid black";
                targetChildren.appendChild(totalScoreOnTable);
              }
              totalScoreArray.sort(function(a, b){
                if(a > b) return -1;
                if(a === b) return 0;
                if(a < b) return 1;
              });
              console.log(totalScoreArray);
              const totalScoreFirstPlace = totalScoreArray[0];
              const totalScoreSecondPlace = totalScoreArray[1];
              const totalScoreThirdPlace = totalScoreArray[2];
              const totalScoreFourthPlace = totalScoreArray[3];
              const totalScoreFifthPlace = totalScoreArray[4];
              for(let i = 0; i < table.children.length; i++){
                const targetChildren = table.children[i];
                const targetScoreValue = parseFloat(targetChildren.childNodes[9].innerText);
                console.log(targetScoreValue);
                if(targetScoreValue == totalScoreFirstPlace || targetScoreValue == totalScoreSecondPlace || targetScoreValue == totalScoreThirdPlace || targetScoreValue == totalScoreFourthPlace || targetScoreValue == totalScoreFifthPlace){
                  targetChildren.style.backgroundColor = "yellowgreen";
                }
              }
            }
          });
          
          const table = document.querySelector("#tableShop tbody");
          const qcScoreForTotal = Math.round(parseFloat(table.children[0].childNodes[6].innerText) * 40 / 50 * 100) / 100;
          console.log(`변환 점수: ${qcScoreForTotal}`);
          const clkScoreForTotal = Math.round(parseFloat(table.children[0].childNodes[7].innerText) * 10 / 10 * 100) / 100;
          console.log(`변환 점수: ${clkScoreForTotal}`);
          const selectedKeywordRating = document.querySelector("#selected-keyword-rating");
          selectedKeywordString = selectedKeywordRating.innerText;
          const regex = /[^0-9]/g;
          const selectedKeywordOnlyNum = selectedKeywordString.replace(regex, "");
          const ratingForTotal = parseInt(selectedKeywordOnlyNum);
          let ratingScoreForTotal = 25;
          for(let i  = 1; i <= 20; i++){
            if(i == ratingForTotal){
              break;
            }
            else{
              ratingScoreForTotal -= 1;
              if(i == 6){
                ratingScoreForTotal -= 3;
              }
              if(i == 11){
                ratingScoreForTotal -= 2;
              }
            }
          }
          ratingScoreForTotal *= 2;
          console.log(`변환점수: ${ratingScoreForTotal}`);
          const scoreTotal = Math.round((ratingScoreForTotal + qcScoreForTotal + clkScoreForTotal) * 100) / 100;
          console.log(`최종 점수: ${scoreTotal}`);
          selectedKeywordQcCount.innerText = `키워드 검색수: ${originalTable.childNodes[3].childNodes[1].childNodes[2].innerText}`;
          selectedKeywordClkCount.innerText = `키워드 클릭수: ${originalTable.childNodes[3].childNodes[1].childNodes[3].innerText}`;
          selectedKeywordComp.innerText = `경쟁정도: ${originalTable.childNodes[3].childNodes[1].childNodes[4].innerText}`;
          selectedKeywordTotal.innerText = `키워드 총점: ${scoreTotal}`;
        },
        error: function(error){
          alert(error);
        }
      });
    }
  </script>
  <script>
    const selectedKeyword = document.querySelector("#selected-keyword");
    const scoreComputationRemove = document.querySelector(".remove");
    scoreComputationRemove.addEventListener("click", hideScore);
    function hideScore(){ //점수 산출부 안보이게 하는 함수
      const scoreComputation = document.querySelector(".score-computation");
      scoreComputation.style.display = "none"
      const contentWrapper = document.querySelector(".content .container-fluid");
      contentWrapper.style.opacity = "1";
    }
  </script>
</body>