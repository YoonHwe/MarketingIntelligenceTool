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
              <h1>검색어 수정</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">검색어 수정</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>


      <div class="row">
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">검색어 - <?php echo $_GET['title'] ?></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="post" action="processEdit.php">
              <input type="hidden" name="_method" value="PUT">
              <div class="card-body">
                <div class="form-group">
                  <label for="keyword">매장이름</label>
                  <input type="text" class="form-control" name="shopName" id="shopName" placeholder="매장이름" value="<?php echo $_GET['title'] ?>" required>
                </div>
                <div class="form-group">
                  <label for="keyword">검색어</label>
                  <input type="text" class="form-control" name="keyword" id="keyword" placeholder="검색어" value="<?php echo $_GET['keyword'] ?>" required>
                </div>
                <div class="form-group">
                  <label for="keyword">새로운 검색어</label>
                  <input type="text" class="form-control" name="newKeyword" id="newKeyword" placeholder="새로운 검색어" value="<?php echo $_GET['newKeyword'] ?>" required>
                </div>
                <div class="form-group">
                  <label for="orgUrl">URL</label>
                  <input type="text" class="form-control" name="orgUrl" id="orgUrl" placeholder="URL (ex: https://blog.naver.com/jkbhnppjgiv/221684438806)" required>
                </div>

                <div class="form-group">
                  <label for="type">종류</label>
                  <select class="form-control select2" style="width: 100%;" name="type" id="type" required>
                    <option value="view">VIEW</option>
                    <option value="powerlink">파워링크</option>
                  </select>
                </div>
                
                <div class="form-group">
                  <label for="payed">입찰 여부</label>
                  <input type="text" class="form-control" name="payed" id="payed" placeholder="Yes or No" required>
                </div>


                <div class="form-group">
                  <label for="sort">순서</label>
                  <input type="number" class="form-control" name="sort" id="sort" placeholder="순서" value="<?php echo $sort; ?>">
                </div>

                <!-- <div class="form-group">
                  <label for="issueDate">작성일자</label>
                  <input type="text" class="form-control" name="issueDate" id="issueDate" value="<?php echo $issueDate; ?>" required>
                </div>

                <div class="form-group">
                  <label for="memo">메모</label>
                  <input type="text" class="form-control" name="memo" id="memo" placeholder="메모" value="<?php echo $memo; ?>">
                </div> -->

                <!-- <div class="form-group">
                  <label for="active">자동업데이트</label>
                  <select class="form-control select2" style="width: 100%;" name="active" id="active" required>
                    <option></option>
                    <option value="Y">활성화</option>
                    <option value="N">비활성화</option>
                  </select>
                </div> -->

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">수정</button>
              </div>
            </form>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->

      </div>


    </div>

    <?php include '../phpForm/script.php'; ?>

    <script>

    </script>

</body>

</html>