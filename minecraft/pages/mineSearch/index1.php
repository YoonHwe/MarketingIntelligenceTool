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
                            <form role="form" method="post" action="index2.php">
                                <div class="row">
                                    <div class="col-5">
                                        <select class="form-control select2" style="width: 100%;" name="shopId" id="shopId">
                                            <option value="0">매장 선택</option>
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
                                    <div class="col-5">
                                        <select class="form-control select2" style="width: 100%;" name="type" id="type">
                                            <option value="">URL 선택</option>
                                            <option value="VIEW">VIEW</option>
                                            <option value="파워링크">파워링크</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">검색</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-header -->
                        <div class=" card-body">
                            <table id="tableSearch" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>매장 이름</th>
                                        <th>중요도</th>
                                        <th>검색어</th>
                                        <th>종류</th>
                                        <!-- <th>메모</th> -->
                                        <th data-priority="20000">URL</th>
                                        <th>작성일자</th>
                                        <!-- <th>최종업데이트</th> -->
                                        <!-- <th>업데이트</th> -->
                                        <!-- <th>갱신</th> -->
                                        <th>수정</th>
                                        <th>삭제</th>
                                    </tr>
                                </thead>
                                <tbody>


                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>매장 이름</th>
                                        <th>중요도</th>
                                        <th>검색어</th>
                                        <th>종류</th>
                                        <!-- <th>메모</th> -->
                                        <th data-priority="20000">URL</th>
                                        <th>작성일자</th>
                                        <!-- <th>최종업데이트</th> -->
                                        <!-- <th>업데이트</th> -->
                                        <!-- <th>갱신</th> -->
                                        <th>수정</th>
                                        <th>삭제</th>
                                    </tr>
                                </tfoot>
                            </table>

                            <form name="formDeleteSearch" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                            </form>
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
                        url: 'index2.php',
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


                let tableSearch = $("#tableSearch").DataTable({
                    ajax: {
                        url: "searchJDB.php",
                        dataSrc: ''
                    },
                    columns: [{
                            data: 'shopName'
                        },
                        {
                            data: 'sort'
                        },
                        {
                            data: 'keyword'
                        },
                        {
                            data: 'type'
                        },
                        {
                            data: 'url'
                        },
                        {
                            data: 'created'
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
                    responsive: true
                });
                $("#tableSearch").on('click', 'button.btn-success', function() {
                    let data = tableSearch.row($(this).parents('tr')).data();
                    location.href = "edit.php?title=" + data.shopName + "&&keyword=" + data.keyword;
                });
                $("#tableSearch").on('click', 'button.btn-danger', function() {
                    let data = tableSearch.row($(this).parents('tr')).data();
                    deleteShop(data.created);
                });

            });

            function deleteShop(datatime) {
                if (confirm('정말로 삭제하시겠습니까?')) {
                    location.href = "processDelete.php?created=" + datatime;
                }
            }

            // function changeCondition() {

            //     $.ajax({
            //         type: "GET",
            //         url: "aaa.php",
            //         data: {
            //             shopId: $('#shopId').val(),
            //             type: $('#type').val()
            //         },
            //         contentType: "application/json",
            //         dataType: "json",
            //         success: function(data, status) {},
            //         error: function(status) {}
            //     });

            //     // let shopId = $('#shopId').val();
            //     // let type = $('#type').val();
            //     // location.href = "searchJDB.php?shopId=" + shopId + "&type=" + type;
            // }
        </script>
</body>

</html>