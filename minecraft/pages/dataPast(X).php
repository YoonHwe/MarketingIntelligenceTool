<!DOCTYPE html>
<html lang="ko">

<?php include 'layout.php'; ?>

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <!-- gallery.html참고 -->
            <div class="mb-2">
              <select class="custom-select" style="width: auto;" data-sortOrder>
                <option value="index"> ABC치과 </option>
                <option value="sortData"> 바이런트치과 </option>
              </select>
              <select class="custom-select" style="width: auto;" data-sortOrder>
                <option value="index"> 파워링크 </option>
                <option value="sortData"> 블로그 </option>
              </select>
            </div>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">일주일 단위의 기간별 통계</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th rowspan="2"style="vertical-align:middle">키워드</th>
                    <th rowspan="2"style="vertical-align:middle">작성일자</th>
                    <th colspan="7" style="text-align:center">기간</th>
                  </tr>
                  <tr>
                    <th>11/14</th>
                    <th>11/15</th>
                    <th>11/17</th>
                    <th>11/18</th>
                    <th>11/19</th>
                    <th>11/20</th>
                    <th>11/21</th>

                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>임플란트</td>
                    <td>2021-11-03</td>
                    <td>1</td>
                    <td>1</td>
                    <td>3</td>
                    <td>4</td>
                    <td>3</td>
                    <td>5</td>
                    <td>3</td>
                  </tr>
                  <tr>
                    <td>충치치료</td>
                    <td>2021-11-05</td>
                    <td>10</td>
                    <td>10</td>
                    <td>11</td>
                    <td>12</td>
                    <td>10</td>
                    <td>9</td>
                    <td>9</td>
                  </tr>
                  <tr>
                    <td>교정</td>
                    <td>2021-11-11</td>
                    <td>5</td>
                    <td>5</td>
                    <td>5</td>
                    <td>4</td>
                    <td>4</td>
                    <td>5</td>
                    <td>5</td>
                  </tr>
                  <tr>
                    <td>야간진료</td>
                    <td>2021-11-12</td>
                    <td>5</td>
                    <td>6</td>
                    <td>8</td>
                    <td>11</td>
                    <td>13</td>
                    <td>14</td>
                    <td>11</td>
                  </tr>
                  <tr>
                    <td>강남치과</td>
                    <td>2021-11-03</td>
                    <td>13</td>
                    <td>13</td>
                    <td>14</td>
                    <td>13</td>
                    <td>13</td>
                    <td>17</td>
                    <td>15</td>
                  </tr>
                  <tr>
                    <td>한의원</td>
                    <td>2021-11-07</td>
                    <td>8</td>
                    <td>9</td>
                    <td>9</td>
                    <td>9</td>
                    <td>10</td>
                    <td>13</td>
                    <td>13</td>
                  </tr>
                  <tr>
                    <td>아토피</td>
                    <td>2021-11-05</td>
                    <td>2</td>
                    <td>2</td>
                    <td>3</td>
                    <td>3</td>
                    <td>2</td>
                    <td>3</td>
                    <td>3</td>
                  </tr>
                  <tr>
                    <td>비염</td>
                    <td>2021-11-11</td>
                    <td>4</td>
                    <td>3</td>
                    <td>4</td>
                    <td>4</td>
                    <td>3</td>
                    <td>3</td>
                    <td>3</td>
                  </tr>

                  </tbody>
                  <tfoot>
                  <tr>
                    <th>키워드</th>
                    <th>작성일자</th>
                    <th>11/14</th>
                    <th>11/15</th>
                    <th>11/17</th>
                    <th>11/18</th>
                    <th>11/19</th>
                    <th>11/20</th>
                    <th>11/21</th>
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
<!-- ./wrapper -->



</body>
</html>