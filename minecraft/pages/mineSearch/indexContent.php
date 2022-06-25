<?php
$conn = mysqli_connect("127.0.0.1", "root", "gj987456~!", "project", 3306);
?>

<!DOCTYPE html>
<html lang="ko">
<?php include '../phpForm/head.php'; ?>

<body class="hold-transition sidebar-mini">
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
        <input type="text" class="form-control" name="shopId" id="shopId" value="<?php echo $_POST['shopId'] ?>"> </input>
        <input type="text" class="form-control" name="type" id="type" value="<?php echo $_POST['type'] ?>"> </input>
        <h2>didi</h2>
    </div>

    <?php include '../phpForm/script.php'; ?>
    <script>
        $(function() {


            let tableSearch = $("#tableSearch").DataTable({
                ajax: {
                    url: "searchJDB.php?shopId=" + $('#shopId').val(),
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
    </script>
</body>

</html>