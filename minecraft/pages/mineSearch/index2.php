<?php
$conn = mysqli_connect("localhost", "root", "gj987456~!", "project", 3307);
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
                            <div class="row">
                                <h5 class="card-title">
                                <i class="icon fas fa-check"></i> &nbsp
                                    <?php echo $_POST['shopId'] ?>
                                    >
                                    <?php echo $_POST['type'] ?>
                                </h5>
                                <div class="col-6" style="display:none">
                                    <input type="text" class="form-control" name="shopId" id="shopId" value="<?php echo $_POST['shopId'] ?>"> </input>

                                </div>
                                <div class="col-6" style="display:none">
                                    <input type="text" class="form-control" name="type" id="type" value="<?php echo $_POST['type'] ?>"> </input>
                                </div>

                            </div>
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
                            <a href="index1.php"><button type="back" class="btn btn-secondary">뒤로가기</button></a>
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



                let tableSearch = $("#tableSearch").DataTable({
                    ajax: {
                        url: "searchJDB2.php?shopId=" + $('#shopId').val(),
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