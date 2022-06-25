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
              <h1>매장목록</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">매장목록</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- 내용 -->
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <!-- <div class="card-header">
                  <h3 class="card-title">일주일 단위의 기간별 통계</h3>
                </div> -->
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="tableShop" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>매장 이름</th>
                        <th>전화번호</th>
                        <th>사업자 번호</th>
                        <th>수정</th>
                        <th>삭제</th>
                      </tr>
                    </thead>
                    <tbody>


                    </tbody>
                    <tfoot>
                      <tr>
                        <th>매장 이름</th>
                        <th>전화번호</th>
                        <th>사업자 번호</th>
                        <th>수정</th>
                        <th>삭제</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
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
  <script>
    $(function() {
      let tableShop = $("#tableShop").DataTable({
        ajax: {
          url: "shopJDB.php",
          dataSrc: ''
        },
        columns: [{
            data: 'shopName'
          },
          {
            data: 'phoneNo'
          },
          {
            data: 'bizNo'
          },
          {

            data: null,
            orderable: false,
            searchable: false,
            defaultContent: '<button class="btn btn-xs btn-block btn-success"> 수정 </button>'

          },
          {
            data: null,
            orderable: false,
            searchable: false,
            defaultContent: '<button class="btn btn-xs btn-block btn-danger">삭제</button>'
          }

        ],
        paging: true,
        lengthChange: false,
        searching: false,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: true,
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>><'row'<'col-sm-12 col-md-4'B>>",
        buttons: [{
          extend: 'excelHtml5',
          text: '엑셀다운로드',
          title: '매장목록'
        }]
        
      });


      $("#tableShop").on('click', 'button.btn-success', function() {
        let data = tableShop.row($(this).parents('tr')).data();
        location.href = "edit.php?getTitle=" + data.shopName + "";
      });
      $("#tableShop").on('click', 'button.btn-danger', function() {
        let data = tableShop.row($(this).parents('tr')).data();
        deleteShop(data.shopName);
      });

    });

    function deleteShop(shopId) {
      if (confirm('정말로 삭제하시겠습니까?')) {
        location.href = "processDelete.php?getTitle=" + shopId;
      }
    }
  </script>


</body>

</html>