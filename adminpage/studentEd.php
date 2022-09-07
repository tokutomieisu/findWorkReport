<?php
//セッション開始
session_start();
// $_SESSION['USERNAME'] = "管理者 admin";
$userName = $_SESSION['USERNAME'];
//戻る画面
$back;
//入力値を受け取る
$studentId = $_GET['page'];
// echo "studentID = ",$studentId,"　";

//DB接続準備
$dsn      = 'mysql:dbname=db26;host=localhost';
$user     = 'root';
$password = '';

// DB接続
try {
    $dbh = new PDO($dsn, $user, $password);
    // echo "DB接続成功　";

    /***********************************************************/
    //仮企業テーブルのデータ件数を数える
    $aside = "SELECT * FROM new_company WHERE c_id IS NULL;";
    // echo $aside . "\n";

    $stmt0 = $dbh->query($aside);
    $d_count = $stmt0->rowCount();
    // echo $d_count . '件SELECTしました。';
    /***********************************************************/

    // クエリの実行(検索指定なしor検索結果なしの場合に全件表示するためのもの)
    $query = "SELECT mts.student_id,mts.no,mts.name,mts.date_of_birth,mts.admission,mts.graduation,mta.class_id,mtc.season,mtc.curriculum,mtt.t_name,mtc.year FROM mt_student mts LEFT OUTER JOIN affiliation mta USING(student_id) LEFT OUTER JOIN mt_class mtc USING(class_id) LEFT OUTER JOIN mt_teacher mtt USING(t_id) 
        WHERE mts.student_id='$studentId';";
    $stmt = $dbh->query($query);
    // echo "sql文：",$query,"　";
} catch (PDOException $e) {
    // print("データベースの接続に失敗しました".$e->getMessage());
    die();
}

// 接続を閉じる
$dbh = null;

//表示する情報を変数とセッションに保持(1人分のみなのでここで変数にしてしまう)
foreach ($stmt as $row) {
    $_SESSION['STUDENTID'] = $row["student_id"];
    // echo "　ID = ", $studentId;
    $studentNo = $row["no"];
    $_SESSION['STUDENTNO'] = $studentNo;
    // echo "　学籍番号 = ", $studentNo;
    $studentName = $row["name"];
    $_SESSION['STUDENTNAME'] = $studentName;
    // echo "　名前 = ", $studentName;
    $studentPass = $row["date_of_birth"];
    // $_SESSION['STUDENTPASS'] = $studentPass;
    // echo "　パスワード = ", $studentPass;
    $admission = $row["admission"];
    $_SESSION['ADMISSION'] = $admission;
    // echo "　入学年度 = ", $admission;
    $graduation = $row["graduation"];
    $_SESSION['GRADUATION'] = $graduation;
    // echo "　卒業年度 = ", $graduation;
    $class = $row["class_id"];
    $_SESSION['CLASS'] = $class;
    // echo "　クラス = ", $class;
    $season = $row["season"];
    $_SESSION['SEASON'] = $season;
    // echo "　入学時期 = ", $season;
    $curriculum = $row["curriculum"];
    $_SESSION['CURRICULUM'] = $curriculum;
    // echo "　課程 = ", $curriculum;
    $teacherName = $row["t_name"];
    $_SESSION['TEACHERNAME'] = $teacherName;
    // echo "　担任 = ", $teacherName;
    $year = $row["year"];
    $_SESSION['YEAR'] = $year;
    // echo "　クラス情報年度 = ", $year;
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/button.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/aside.css">
    <title>学生編集</title>
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
                <h1>学生編集</h1>
            </div>

            <form action="studentCheck.php" method="post">
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
                        <td><input type="text" name="name" id="" value="<?php echo $studentName ?>"></td>
                    </tr>

                    <tr>
                        <th>パスワード</th>
                        <!--mt_studentに生年月日欄があれば初期値を入力すること可能 -->
                        <td>
                            <!-- <input type="text" name="pass" id="" value=" -->
                            <?php
                            // echo "B" . $studentPass 
                            ?>
                            <!-- "> -->
                            <label for="pass" class="check">
                                <input type="checkbox" name="pass" class="check" value="<?php echo "B" . $studentPass ?>" id="pass">パスワードを初期化する
                            </label>
                        </td>
                    </tr>

                    <tr>
                        <th>入学年度</th>
                        <td><?php echo $admission ?></td>
                    </tr>

                    <tr>
                        <th>卒業（退学）年度</th>
                        <td><input type="text" name="graduation" id="" value="<?php echo $graduation ?>"></td>
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
                <!-- <a class="btn" href="student.php">完了</a> -->
                <button type="submit" name="sb" value="confirmation" class="btn btn-outline-secondary btn_width">完了</button>
            </form>
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