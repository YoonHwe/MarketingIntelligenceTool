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
              <h1>통계</h1>
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

      <form role="form" method="post" action="rankLine2.php">
        <section>
          <div class="row">
            <div class="col-3">
              <select class="form-control select2" name="shopId" id="shopId">
                <option value="0">매장 전체</option>
                <?php
                $sql = "SELECT * FROM hospitals";
                $res = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($res)) {
                  $filtered = array(
                    'title' => htmlspecialchars($row['name'])

                  );
                ?>
                  <option value="<?php echo $filtered['title']; ?>">
                    <?php echo $filtered['title']; ?>
                  </option>
                <?php } ?>

              </select>
              
            </div>
            <div class="col-3">
              <select class="form-control select2" name="type" id="type">
                <option value="">URL 전체</option>
                <option value="view_ratings">VIEW</option>
              <option value="powerlink_ratings">파워링크</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary">검색</button>
          </div>

        </section>

      </form>
      <!-- <php
      echo file_get_contents("graph.php" . $_GET["shopId"]);
      ?> -->

      <!-- 내용 -->
      <!-- Main content -->

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
  <script>
    $(function() {
      $("button").click(function() {
        $.ajax({
          url: 'rankLine2.php',
          type: 'post',
          dataType: 'json',
          data: {
            shopId: $('#shopId').val(),
            type: $('#type').val()

          },
          success: function(data) {
            console.log("성공");
          }
        });
      });
    });
  </script>

  <!-- ChartJS -->
  <script src="../../plugins/chart.js/Chart.min.js"></script>




</body>

</html>