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

    <div class="content-wrapper">

      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>통계순위 등록(임시)</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">통계순위 등록(임시)</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <div class="row">

        <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">VIEW순위</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="post" action="processNew.php">
              <div class="card-body">
                <!-- <div class="form-group">
                  <label for="shopId">매장 이름</label>
                  <select class="form-control select2" style="width: 100%;" name="shopName" id="shopName" required>
                    <option></option>
                    <?php
                    $sql = "SELECT * FROM hospitals";
                    $res = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($res)) {
                      $filtered = array(
                        'title' => htmlspecialchars($row['name']),
                      );
                    ?>
                      <option value="<?php echo $filtered['title']; ?>"><?php echo $filtered['title']; ?></option>
                    <?php } ?>
                  </select>
                </div> -->
                <div class="col-3">
                  <label for="k_id">외래키(키워드id)</label>
                  <select class="form-control select2" style="width: 100%;" name="k_id" id="k_id" required>
                    <option></option>
                    <?php
                    $sql = "SELECT * FROM keywords WHERE channel='VIEW'";
                    $res = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($res)) {
                      $filtered = array(
                        'word' => htmlspecialchars($row['word']),
                        'shopname' => htmlspecialchars($row['shopname']),
                        'id' => htmlspecialchars($row['id']),

                      );
                    ?>
                      <option value="<?php echo $filtered['id']; ?>">
                        <?php echo $filtered['shopname'];
                        echo " ";
                        echo $filtered['word'];
                        echo "id=";
                        echo $filtered['id']; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-3">
                  <label for="rating">검색채널</label>
                  <select class="form-control select2" style="width: 100%;" name="channel" id="channel" required>
                    <option></option>
                    <option value="view_ratings">VIEW</option>
                    <option value="powerlink_ratings">파워링크</option>

                  </select>
                </div>

                <div class="col-3">
                  <label for="rating">순위</label>
                  <select class="form-control select2" style="width: 100%;" name="rating" id="rating" required>
                    <option></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>

                  </select>
                </div>
                <div class="col-3">
                  <label for="s_date">작성일자</label>
                  <input type="date" class="form-control" name="s_date" id="s_date" required>
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