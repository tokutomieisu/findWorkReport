<?php
//セッション開始
session_start();
// $_SESSION['USERNAME'] = "管理者 admin";
$userName = $_SESSION['USERNAME'];
//戻る画面
$back;
//編集画面から入力値を受け取る
// if (!empty($_POST['t_id'])) {
//     $teacherId = $_POST['t_id'];
// }
// if (!empty($_POST['t_name'])) {
//     $teacherName = $_POST['t_name'];
// }
// if (!empty($_POST['sb'])) {
//     //教員情報更新の場合
//     if ($_POST['sb'] == "completion") {
//         $sql = "UPDATE mt_teacher SET t_name='$teacherName' WHERE t_id='$teacherId'";
//         // echo "教員名更新SQL＝", $sql;
//     } else if ($_POST['sb'] == "add") {
//         // echo "教員データ追加SQL＝", $sql;
//     }
// }


//DB接続準備
$dsn      = 'mysql:dbname=db26;host=localhost';
$user     = 'root';
$password = '';
$count = -1;

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

    // クエリの実行(教員名変更を反映するためのもの)
    // if (!empty($_POST['btn'])) {
    //     $stmt0 = $dbh->query($sql);
    //     // echo "教員名更新SQL＝", $sql;
    // }
    // クエリの実行(検索指定なしor検索結果なしの場合に全件表示するためのもの)
    $query = "SELECT * FROM mt_teacher";
    $stmt = $dbh->query($query);
    // echo "検索指定なしor検索結果なしの場合に利用するsql文：", $query, "　";
    // クエリの実行(受け取った検索指定と一致するデータを抽出するためのもの)

    if (!empty($_POST['teacher'])) {
        $teacherId = $_POST['teacher'];
        $query1 = "SELECT * FROM mt_teacher WHERE t_id LIKE '%$teacherId%'";
        // echo "受け取った検索指定と一致するデータを抽出するためのsql文：",$query1,"　";
        $stmt1 = $dbh->query($query1);
        $count = $stmt1->rowCount();
        // echo "　", $count . "件SELECTしました。";
    } else {
        // echo "教官ID未指定";
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
    <link rel="stylesheet" type="text/css" href="css/button.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/read.css">
    <link rel="stylesheet" type="text/css" href="css/aside.css">
    <title>教官管理</title>
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
                <h1>教官管理</h1>
            </div>

            <div class="tb_flex">
                <a class="btn btn_add_width" href="#" role="button">教官を追加する</a>
                <div class="input-group mb-3">
                    <form action="teacher.php" method="post">
                        <?php
                        if (0 <= $count) {
                            echo "<input type=\"text\" placeholder=\"教官IDで部分一致検索　", $teacherId, "\" name=\"teacher\" value=\"\">";
                        } else {
                            echo "<input type=\"text\" placeholder=\"教官IDで部分一致検索\" name=\"teacher\" value=\"\">";
                        }
                        ?>
                        <!-- <input type="submit" name="sb" value="検索" class="btn btn-outline-secondary"> -->
                        <button type="submit" name="search" class="btn btn-outline-secondary">検索</button>
                    </form>
                </div>
            </div>

            <!--PHP動作確認用-->
            <?php
            // echo "count=", $count;
            // if ($count < 0) {
            //     echo "<p>検索指定なしor検索結果なしの場合に利用するsql文：", $query, "</p>";
            // } else if ($count == 0) {
            //     echo "<p>該当する教官はいません。再度教官IDを入力して検索してください。</p>";
            // } else if (0 < $count) {
            //     echo "<p>受け取った検索指定と一致するデータを抽出するためのsql文：", $query1, "</p>";
            // }
            // if (!empty($sql)) {
            //     echo "<p>教員データ更新のためのsql", $sql, "</p>";
            // }
            ?>

            <?php
            if ($count == 0) {
                echo "<h2>該当する教官はいません。再度教官IDを入力して検索してください。</h2>";
            }
            ?>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>名前</th>
                    <th></th>
                </tr>

                <?php if ($count <= 0) { ?>
                    <?php foreach ($stmt as $row) { ?>
                        <tr>
                            <td><?php echo $row["t_id"]; ?></td>
                            <td><?php echo $row["t_name"]; ?></td>
                            <td><a href="teacherEd.php?page=<?php echo $row["t_id"]; ?>">編集</a></td>
                            <!--↑セキュリティを考えてあえて変数名をteacher_idではなくpageにしてみた-->
                        </tr>
                    <?php } ?>
                <?php } else if (0 < $count) { ?>
                    <?php foreach ($stmt1 as $row) { ?>
                        <tr>
                            <td><?php echo $row["t_id"]; ?></td>
                            <td><?php echo $row["t_name"]; ?></td>
                            <td><a href="teacherEd.php?page=<?php echo $row["t_id"]; ?>">編集</a></td>
                        </tr>
                    <?php } ?>
                <?php } ?>


            </table>
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