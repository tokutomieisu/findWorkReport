<?php
//セッション開始
session_start();
// $_SESSION['USERNAME'] = "管理者 admin";
$userName = $_SESSION['USERNAME'];
//戻る画面
$back;
//入力値を受け取る
$teacherId = $_GET['page'];

// echo "teacherID = ",$teacherId,"　";

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
    $query = "SELECT * FROM mt_teacher WHERE t_id='$teacherId';";
    $stmt = $dbh->query($query);
    // echo "sql文：",$query,"　";
} catch (PDOException $e) {
    // print("データベースの接続に失敗しました".$e->getMessage());
    die();
}

// 接続を閉じる
$dbh = null;

//表示する情報を変数に保持(1人分のみなのでここで変数にしてしまう)
foreach ($stmt as $row) {
    $teacherId = $row["t_id"];
    // echo "　ID = ",$teacherId;
    $teacherName = $row["t_name"];
    // echo "　名前 = ",$teacherName;      
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
    <title>教官編集</title>
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
                <h1>教官編集</h1>
            </div>

            <!-- 変更完了に飛ぶ -->
            <form action="complete.php" method="post">
                <table border="1">
                    <tr>
                        <th>教官ID</th>
                        <td><input type="hidden" name="t_id" value="<?php echo $teacherId ?>"><?php echo $teacherId ?></td>
                    </tr>

                    <tr>
                        <th>名前</th>
                        <td><input type="text" name="t_name" id="" value="<?php echo $teacherName ?>"></td>
                    </tr>
                </table>

                <!-- <a class="btn" href="teacher.php">完了</a> -->
                <!-- <input type="submit" name="sb" value="完了" class="btn btn-outline-secondary"> -->
                <!-- nameをsbからbtnに変更した -->
                <button type="submit" name="btn" value="completion" class="btn btn-outline-secondary btn_width">完了</button>
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
                    <span>未処理<?php echo $d_count ?>件</span>
                <?php } ?>
            </li>
        </ul>
    </aside>

</body>

</html>