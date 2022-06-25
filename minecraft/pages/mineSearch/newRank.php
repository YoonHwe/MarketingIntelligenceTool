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

        <div class="content-wrapper">

            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>키워드 등록</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">키워드 등록</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <div class="row">

                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">검색어</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="processNew.php">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="shopId">매장 이름</label>
                                    <select class="form-control select2" style="width: 100%;" name="shopName" id="shopName" required>
                                        <option></option>
                                        <?php
                                        $sql = "SELECT * FROM hospitals";
                                        $res = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_array($res)) {
                                            $filtered = array(
                                                'title' => htmlspecialchars($row['name'])

                                            );
                                        ?>
                                            <option value="<?php echo $filtered['title']; ?>"><?php echo $filtered['title']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="keyword">검색어</label>
                                    <input type="text" class="form-control" name="keyword" id="keyword" placeholder="검색어" required>
                                </div>

                                <div class="form-group">
                                    <label for="orgUrl">URL</label>
                                    <input type="text" class="form-control" name="orgUrl" id="orgUrl" placeholder="URL (ex: https://blog.naver.com/song_ceo/221672299970)" required>
                                </div>

                                <div class="form-group">
                                    <label for="type">종류</label>
                                    <select class="form-control select2" style="width: 100%;" name="type" id="type" required>
                                        <option></option>
                                        <option value="view">VIEW</option>
                                        <option value="powerlink">파워링크</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="payed">입찰 여부</label>
                                    <input type="text" class="form-control" name="payed" id="payed" placeholder="Yes or No" required>
                                </div>

                                <div class="form-group">
                                    <label for="value">중요도</label>
                                    <select class="form-control select2" style="width: 100%;" name="value" id="value" required>
                                        <option></option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    <!-- <input type="number" class="form-control" name="sort" id="sort" value="1" placeholder="순서"> -->
                                </div>
                                <!-- 작성일자, 메모, 업데이트 제거 -->
                                <!-- <div class="form-group">
                                    <label for="issueDate">작성일자</label>
                                    <input type="text" class="form-control" name="issueDate" id="issueDate" required>
                                </div> -->


                                <!-- <div class="form-group">
                    <label for="memo">메모</label>
                    <input type="text" class="form-control" name="memo" id="memo" placeholder="메모">
                </div>



                <div class="form-group">
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