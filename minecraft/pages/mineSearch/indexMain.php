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
                            <h1>키워드 목록</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">키워드 목록</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <form role="form" method="post" action="indexContent.php">
                                <div class="row">

                                    <div class="col-6">
                                        <select class="form-control select2" style="width: 100%;" name="shopId" id="shopId">
                                            <option value="shopId">매장 전체(미완)</option>
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
                                    <div class="col-6">
                                        <select class="form-control select2" style="width: 100%;" name="type" id="type">
                                            <option value="">URL 전체(미완)</option>
                                            <option value="VIEW">VIEW</option>
                                            <option value="파워링크">파워링크</option>
                                        </select>
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-primary">등록</button>
                            </form>

                            <!-- <php
                            echo file_get_contents("indexContent.php");
                            ?> -->

                        </div>

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->


            </div>

        </div>


        <?php include '../phpForm/script.php'; ?>
        <script>
            $(function() {

                $("button").click(function() {
                    // let shopId = $('#shopId').val();
                    // let type = $('#type').val();
                    $.ajax({
                        url: 'indexContent.php',
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

                // function changeCondition() {

                //     $.ajax({
                //         type: "GET",
                //         url: ".php",
                //         data: {
                //             shopId: $('#shopId').val(),
                //             type: $('#type').val()
                //         },
                //         contentType: "application/json",
                //         dataType: "json",
                //         success: function(data, status) {},
                //         error: function(status) {}
                //     });

                // let shopId = $('#shopId').val();
                // let type = $('#type').val();
                // location.href = "searchJDB.php?shopId=" + shopId + "&type=" + type;
                // }
            });
        </script>
</body>

</html>