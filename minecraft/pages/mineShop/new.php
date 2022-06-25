<!DOCTYPE html>
<html lang="ko">
<?php include '../phpForm/head.php'; ?>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php include '../phpForm/navbar.php'; ?>
    <?php include '../phpForm/sidebar.php'; ?>

    <div class="content-wrapper">

      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>매장 등록</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">매장 등록</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <div class="row">

        <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">매장</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="post" action="processNew.php">
              <div class="card-body">
                <div class="form-group">
                  <label for="shopName">매장 이름</label>
                  <input type="text" class="form-control" name="shopName" id="shopName" placeholder="매장 이름" required>
                </div>
                <div class="form-group">
                  <label for="phoneNo">전화번호</label>
                  <input type="text" class="form-control" name="phoneNo" id="phoneNo" placeholder="전화번호 (하이픈 없이 숫자만)" required>
                </div>
                <div class="form-group">
                  <label for="bizNo">사업자 번호</label>
                  <input type="number" class="form-control" name="bizNo" id="bizNo" placeholder="사업자 번호 (하이픈 없이 숫자만)">
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">등록</button>
              </div>
            </form>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->

      </div>
    </div>

    <?php include '../phpForm/script.php'; ?>

</body>

</html>