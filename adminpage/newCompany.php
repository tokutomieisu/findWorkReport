<?php

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
    echo $aside . "\n";

    $stmt0 = $dbh->query($aside);
    $d_count = $stmt0->rowCount();
    echo $d_count . '件SELECTしました。';
    /***********************************************************/

    //クエリの設定
    $query = "SELECT * FROM new_company WHERE c_id IS NULL;";
    echo $query . "\n";

    //クエリの実行
    $stmt = $dbh->query($query);
    $d_count = $stmt->rowCount();
    echo $d_count . '件SELECTしました。';
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
    <link rel="stylesheet" type="text/css" href="css/read.css">
    <link rel="stylesheet" type="text/css" href="css/aside.css">
    <title>企業登録申請</title>
</head>

<body>
    <header>
        <div class="headwrrap">
            <div class="flex">
                <p>管理者&nbsp;admin</p>
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
                <h1>企業登録申請一覧</h1>
            </div>

            <?php if (!empty($d_count)) { ?>
                <table border="1">
                    <tr>
                        <th>ID</th>
                        <th>企業名</th>
                        <th></th>
                    </tr>

                    <?php foreach ($stmt as $row) { ?>

                        <tr>
                            <td><?php echo $row['d_id']; ?></td>
                            <td><?php echo $row['c_name']; ?></td>
                            <td><a href="companyAdd.php?page=<?php echo $row['d_id']; ?>">企業登録</a></td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } else { ?>
                <p>現在、企業登録申請はありません。</p>
            <?php } ?>
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