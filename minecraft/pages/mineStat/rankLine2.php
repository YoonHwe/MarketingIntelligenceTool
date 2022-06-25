<?php
$conn = mysqli_connect("localhost", "root", "kio134679", "mineshare", 3307);
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
              <h1>

                 <?php echo $_POST['shopId'] ?>&nbsp>
                  <?php
                  
                    if(strcmp($_POST['type'] ,"view_ratings")){
                      echo "파워링크";
                    } else if(strcmp($_POST['type'] ,"powerlink_ratings")){
                      echo "VIEW";
                    } else{
                      echo "error";
                    }
                  ?>
              </h1>                   
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">통계</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>



      </section>

      <div class="col-3" style="display:none">
        <input type="text" class="form-control" name="shopId" id="shopId" value="<?php echo $_POST['shopId'] ?>"> </input>
        <input type="text" class="form-control" name="type" id="type" value="<?php echo $_POST['type'] ?>"> </input>
      </div>

      <section>
        <!-- 내용 -->
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">

              <!-- 기존 사이즈는 col-md-6 -->
              <!-- LINE CHART -->
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">
                  일주일 노출 순위
               
                    <text id="mon"></text>
                  </h3>


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
                  <div class="chart">
                    <canvas id="lineChart" style="min-height: 300px; height: 300px; max-height: 300px; width:500px; max-width: 100%;"></canvas>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <a href="rankLine1.php"><button type="back" class="btn btn-secondary">뒤로가기</button></a>
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



  <!-- url: "searchJDB2.php?shopId=" + $('#shopId').val(), -->

  <?php include '../phpForm/script.php'; ?>

  <!-- ChartJS -->
  <script src="../../plugins/chart.js/Chart.min.js"></script>

  <script>
    var dayArr = [7]; //날짜 등록

    var datasetArr = []; // 동적선언

    var countKey; //키워드 개수 

    var dataRank;

    $.ajax({
      url: "statDB2.php?shopId=" + $('#shopId').val() +"&&channel=" + $('#type').val(),
      type: "get",
      datatype: "json",
      success: function(obj) {
        var month;
        var intId; //정렬된 DB에서 initial k_id
        var countId;
        var countWord = 1;
        var count = 0;
        var dayCount = 0;
        var ask;
        var str;
        //DB기준 최근 7일의 날짜 가져오기
        $.each(obj, function(index, item) { // 데이터 =item
          if (index == 0) {
            intId = item.k_id;
          }
          if (dayCount < 7) {
            //날짜 삽입
            var dt = new Date(item.date);
            dayArr[dayCount] = (dt.getMonth() + 1) + '/' + dt.getDate();
            month = item.date[6]; //개선필요
            dayCount++;
          } else {
            count = 0;
          }
        });

        countId = intId;
        //키워드 개수 확인
        $.each(obj, function(index, item) { // 데이터 =item
          if (item.k_id != countId) {
            countWord++;
            countId++;
          }
        });
        countKey = countWord;

        //키워드 삽입
        var keywords = [countKey]; //각 키워드 담을 배열
        countId = intId;
        var kc = 0;
        $.each(obj, function(index, item) { // 데이터 =item
          if (item.k_id == countId) {
            keywords[kc] = item.word;
          } else {
            kc++;
            countId++;
          }
        });

        //datasetArr = [countKey]; //dataset옵션 넣은 개수 선언
        count = 0;
        countWord = 0;

        dataRank = new Array(countKey); //키워드만큼 행 생성
        for (var i = 0; i < dataRank.length; i++) {
          dataRank[i] = new Array(); //일 해당, 동적해도 됨
        }


        $.each(obj, function(index, item) {
          if (count < 6) {
            dataRank[countWord][count] = item.rank;
            count++;

          } else {
            dataRank[countWord][count] = item.rank;
            count = 0;
            countWord++;
          }
        });


        for (var i = 0; i < countKey; i++) {
          var r1 = Math.floor(Math.random() * 256);
          var r2 = Math.floor(Math.random() * 256);
          var r3 = Math.floor(Math.random() * 256);
          var col = 'rgba(' + r1 + ',' + r2 + ',' + r3 + ',1)';
          var opt = {
            label: keywords[i],
            data: dataRank[i],
            backgroundColor: col,
            borderColor: col,
            pointRadius: false,
            pointColor: '#3b8bba',
            pointStrokeColor: col,
            pointHighlightFill: '#fff',
            pointHighlightStroke: col,
            fill: false
          }
          datasetArr.push(opt);
        }

        // $("#demo").append("키워드개수= " + countKey + "<br>");
        // $("#demo").append("마지막k_id= " + intId + "<br>");
        // $("#demo").append("일자확인= " + dayArr + "<br>");
        // $("#demo").append("@3번라인 <br>");
        // $("#demo").append(dataRank + "<br>");
        // $("#demo").append(keywords + "<br>");

      },

      error: function() {
        alert("error2");
      }

    });




    $(function() {

      let chartOptions = {
        maintainAspectRatio: true,
        responsive: true,
        legend: {
          display: true
        },
        scales: {

          xAxes: [{
            gridLines: {
              display: true,
            }
          }],
          yAxes: [{
            gridLines: {
              display: false,
            },
            ticks: {
              reverse: true,
              stepSize: 1,
              max: 7
            }
          }]
        }
        
      }

      var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
      chartOptions.datasetFill = false
      var lineChart = new Chart(lineChartCanvas, {
        type: 'line',
        options: chartOptions,
        data: {
          labels: dayArr,
          datasets: datasetArr
        }

      })
      

    });




    // //파란색 옵션
    // var dsetArrary = new Array();
    // var dsetObj = new Object();
    // dsetObj.label = '파란색';
    // dsetObj.data = d1_rank;
    // dsetObj.backgroundColor = 'rgba(60,141,188,0.9)';
    // dsetObj.borderColor = 'rgba(60,141,188,0.8)';
    // dsetObj.pointRadius = false;
    // dsetObj.pointColor = '#3b8bba';
    // dsetObj.pointStrokeColor = 'rgba(60,141,188,1)';
    // dsetObj.pointHighlightFill = '#fff';
    // dsetObj.pointHighlightStroke = 'rgba(60,141,188,1)';
    // dsetObj.fill = false;
    // // JSON.stringify(dsetObj);
    // // // String 형태로 파싱한 객체를 다시 json으로 변환
    // // dsetArray.push(JSON.parse(JSON.stringify(dsetObj)));

    // //회색옵션
    // var dsetArrary2 = new Array();
    // var dsetObj2 = new Object();
    // dsetObj2.label = '회색';
    // dsetObj2.data = d2_rank;
    // dsetObj2.backgroundColor = 'rgba(210, 214, 222, 1)';
    // dsetObj2.borderColor = 'rgba(210, 214, 222, 1)';
    // dsetObj2.pointRadius = false;
    // dsetObj2.pointColor = '#c1c7d1';
    // dsetObj2.pointStrokeColor = 'rgba(210, 214, 222, 1)';
    // dsetObj2.pointHighlightFill = '#fff';
    // dsetObj2.pointHighlightStroke = 'rgba(220,220,220,1)';
    // dsetObj2.fill = false;

        //차트js 클릭이벤트
          // document.getElementById("lineChart").onclick = function(evt) {

      //   var activePoints = lineChart.getElementsAtEvent(evt);

      //   if(activePoints.length > 0)
      //     {
      //       //get the internal index of slice in pie chart
      //       var clickedElementindex = activePoints[0]["_index"];

      //       //get specific label by index 
      //       var label = lineChart.data.labels[clickedElementindex];

      //       //get value by index      
      //       var value = lineChart.data.datasets[0].data[clickedElementindex];

      //       // label and value Process
            
      //     }
      // };
      // alert(label + "  :  " + value + "  :  " );
    
  </script>



</body>

</html>