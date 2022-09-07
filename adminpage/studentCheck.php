<?php
//セッション開始
session_start();
// $_SESSION['USERNAME'] = "管理者 admin";
$userName = $_SESSION['USERNAME'];

$studentId = $_SESSION['STUDENTID'];
// echo "　ID = ",$studentId;
$studentNo = $_SESSION['STUDENTNO'];
// echo "　学籍番号 = ",$studentNo;
$studentName = $_SESSION['STUDENTNAME'];
// echo "　名前 = ",$studentName;
// $studentPass = $_SESSION['STUDENTPASS'];
// echo "　パスワード = ", $studentPass;
$admission = $_SESSION['ADMISSION'];
// echo "　入学年度 = ",$admission;
$graduation = $_SESSION['GRADUATION'];
// echo "　卒業年度 = ",$graduation;
$class = $_SESSION['CLASS'];
// echo "　クラス = ",$class;
$season = $_SESSION['SEASON'];
// echo "　入学時期 = ",$season;
$curriculum = $_SESSION['CURRICULUM'];
// echo "　課程 = ",$curriculum;
$teacherName = $_SESSION['TEACHERNAME'];
// echo "　担任 = ",$teacherName;
$year = $_SESSION['YEAR'];
// echo "　クラス情報年度 = ",$year;

//変数設定
$ep = 0; //epはEdited partの略
$set = "初期値";
// echo "　ep初期値＝", $ep;

//編集画面から入力値を受け取る
if (!empty($_POST['name'])) {
    //受け取った名前がセッション保持の名前と一致しているなら処理しない
    if ($studentName !== $_POST['name']) {
        $studentName = $_POST['name'];
        $ep = $ep + 1;
        $set = "name = \"" . $studentName . "\"";
        // echo "　ep1=", $ep;
    }
}
if (isset($_POST['pass'])) {
    //チェックが入ったらパスワードを初期化する（B＋生年月日）
    $pass = $_POST['pass'];
    // echo "　ep2=", $ep;
    if ($ep == 0) {
        $set = "pass = \"" . $pass . "\"";
    } else {
        $set = $set . "," . "pass = \"" . $pass . "\"";;
    }
    $ep = $ep + 2;
}
if (!empty($_POST['graduation'])) {
    $graduation = $_POST['graduation'];
    // echo "　ep3=", $ep;
    if ($ep == 0) {
        $set = "graduation = \"" . $graduation . "\"";
    } else {
        $set = $set . "," . "graduation = \"" . $graduation . "\"";
    }
    $ep = $ep + 4;
}
// echo "　　set:", $set;
//戻る画面
$back;

//DB接続準備
$dsn      = 'mysql:dbname=db26;host=localhost';
$user     = 'root';
$password = '';

// DB接続
try {
    $dbh = new PDO($dsn, $user, $password);
    // echo "接続成功　";

    /***********************************************************/
    //仮企業テーブルのデータ件数を数える
    $aside = "SELECT * FROM new_company WHERE c_id IS NULL;";
    // echo $aside . "\n";

    $stmt0 = $dbh->query($aside);
    $d_count = $stmt0->rowCount();
    // echo $d_count . '件SELECTしました。';
    /***********************************************************/

    // クエリの実行(上書き保存)
    if ($set !== "初期値") {
        $query = "UPDATE mt_student SET " . $set . " WHERE student_id =\"" . $studentId . "\";";
        // echo "sql文：", $query, "　";
        $stmt = $dbh->query($query);
    }
} catch (PDOException $e) {
    // print("データベースの接続に失敗しました".$e->getMessage());
    die();
}

// 接続を閉じる
$dbh = null;

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/read.css">
    <link rel="stylesheet" type="text/css" href="css/button.css">
    <link rel="stylesheet" type="text/css" href="css/aside.css">
    <link rel="stylesheet" type="text/css" href="css/change.css">
    <title>学生編集完了</title>
</head>

<body>
    <header>
        <div class="headwrrap">
            <div class="flex">
                <p><?php echo $userName; ?>&nbsp;</p>
            </div>
            <nav>
                <ul>
                    <li class="logout"><a href="../index.html">ログアウト</a>
                </ul>
            </nav>
        </div>
    </header>

    <section class="main">
        <div class="text">
            <div class="head_flex">
                <h1>学生編集完了（変更箇所は赤字で表示）</h1>
            </div>

            <table border="1">
                <tr>
                    <th>学生ID</th>
                    <td><?php echo $studentId ?></td>
                </tr>

                <tr>
                    <th>学籍番号</th>
                    <td><?php echo $studentNo ?></td>
                </tr>

                <tr>
                    <th>名前</th>
                    <!--修正した場合フォントカラーを赤色にする-->
                    <td <?php
                        if ($ep == 1 || $ep == 3 || $ep == 5 || $ep == 7) {
                            echo " class = \"change\"";
                        }
                        ?>><?php echo $studentName ?></td>
                </tr>

                <tr>
                    <th>パスワード</th>
                    <?php
                    if ($ep == 2 || $ep == 3 || $ep == 6 || $ep == 7) {
                        echo "<td class = \"change\">初期設定B＋生年月日8桁</td>";
                    } else {
                        echo "<td>変更なし</td>";
                    }
                    ?>
                </tr>

                <tr>
                    <th>入学年度</th>
                    <td><?php echo $admission ?></td>
                </tr>

                <tr>
                    <th>卒業（退学）年度</th>
                    <td <?php
                        if (4 <= $ep) {
                            echo " class = \"change\"";
                        }
                        ?>><?php echo $graduation ?></td>
                </tr>

                <tr>
                    <th>クラス</th>
                    <td><?php echo $class ?></td>
                </tr>

                <tr>
                    <th>入学時期</th>
                    <td><?php echo $season ?></td>
                </tr>

                <tr>
                    <th>課程</th>
                    <td><?php echo $curriculum ?></td>
                </tr>

                <tr>
                    <th>担任</th>
                    <td><?php echo $teacherName ?></td>
                </tr>

                <tr>
                    <th>最終クラス年度</th>
                    <td><?php echo $year ?></td>
                </tr>
            </table>
            <a class="btn btn_width btn_margin" href="student.php">戻る</a>
        </div>
    </section>

    <aside id="sub">
        <h2>管理メニュー</h2>
        <ul>
            <li><a href="index.php">トップ</a></li>
            <li><a href="student.php">学生管理</a></li>
            <li><a href="teacher.php">教官管理</a></li>
            <li><a href="company.php">企業管理</a></li>
            <li><a href="#">クラス管理</a></li>
            <li><a href="#">就職管理</a></li>
            <li><a href="newCompany.php">企業申請登録</a>
                <?php if (!empty($d_count)) { ?>
                    <br><span>未処理<?php echo $d_count ?>件</span>
                <?php } ?>
            </li>
        </ul>
    </aside>

</body>

</html>