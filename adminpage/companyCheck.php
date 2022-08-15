<?php
//セッション開始
session_start();
//フォームの値をすべてセッション配列に格納
$_SESSION['FORMARRAY'] = array($_POST['form'][0], $_POST['form'][1], $_POST['form'][2], $_POST['form'][3], $_POST['form'][4], $_POST['form'][5], $_POST['form'][6]);

// foreach ($_SESSION['FORMARRAY'] as $row) {
//     echo $row;
// }

//DB接続準備
$dsn      = 'mysql:dbname=db26;host=localhost';
$user     = 'root';
$password = '';

// DBへ接続
try {
    $dbh = new PDO($dsn, $user, $password);

    /***********************************************************/
    //仮企業テーブルのデータ件数を数える
    $aside = "SELECT * FROM new_company WHERE c_id IS NULL;";
    // echo $aside . "\n";

    $stmt0 = $dbh->query($aside);
    $d_count = $stmt0->rowCount();
    // echo $d_count . '件SELECTしました。';
    /***********************************************************/

    //coから始まる企業を取得
    $query = "SELECT * FROM mt_company WHERE c_id LIKE '%co%';";

    echo $query;
    //クエリの実行
    $stmt2 = $dbh->query($query);
    $count = $stmt2->rowCount(); //coの件数を数える
    echo $count . '件SELECTしました。';
} catch (PDOException $e) {
    print("データベースの接続に失敗しました" . $e->getMessage());
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
    <link rel="stylesheet" type="text/css" href="css/aside.css">
    <link rel="stylesheet" type="text/css" href="css/companyCheck.css">
    <title>企業追加確認</title>
</head>

<body>
    <header>
        <div class="headwrrap">
            <div class="flex">
                <p>管理者&nbsp;admin</p>
            </div>

            <nav>
                <ul>
                    <li class="logout"><a href="../index.html" id="logout">ログアウト</a>
                </ul>
            </nav>


        </div>
    </header>

    <section class="main">
        <div class="text">
            <div class="head_flex">
                <h1>企業追加確認</h1>
            </div>


            <form method="POST">
                <table border="1">

                    <tr>
                        <th>企業名</th>
                        <td><?php echo $_SESSION['FORMARRAY'][0]; ?></td>
                    </tr>

                    <tr>
                        <th>略称企業名</th>
                        <td><?php echo $_SESSION['FORMARRAY'][1]; ?></td>
                    </tr>

                    <tr>
                        <th>郵便番号</th>
                        <td><?php echo $_SESSION['FORMARRAY'][2]; ?></td>
                    </tr>

                    <tr>
                        <th>住所</th>
                        <td><?php echo $_SESSION['FORMARRAY'][3]; ?></td>
                    </tr>

                    <tr>
                        <th>電話番号</th>
                        <td><?php echo $_SESSION['FORMARRAY'][4]; ?></td>
                    </tr>

                    <tr>
                        <th>メールアドレス</th>
                        <td><?php echo $_SESSION['FORMARRAY'][5]; ?></td>
                    </tr>

                    <tr>
                        <th>採用課窓口</th>
                        <td><?php echo $_SESSION['FORMARRAY'][6]; ?></td>
                    </tr>

                </table>
            </form>

            <div class="btn_flex">
                <form action="companyAdd.php" method="POST">
                    <button type="submit" name="btn" class="btn btn_add_width" value="return">修正</button>
                </form>

                <form action="complete.php" method="POST">
                    <button type="submit" name="btn" class="btn btn_add_width" value="add">追加</button>
                    <input type="hidden" name="count" value="<?php echo $count ?>">
                </form>
            </div>
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