<?php
//セッションを始める
session_start();

//DB接続準備
$dsn      = 'mysql:dbname=db26;host=localhost';
$user     = 'root';
$password = '';

// DB接続
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

    //URLからd_idを取得（企業申請登録画面から来た場合）
    if (!empty($_GET['page'])) {
        $dummyNo = $_GET['page'];
        echo '新規企業ダミーIDは：' . $dummyNo . "\n";

        // クエリの実行
        $query = "SELECT * FROM new_company WHERE d_id = '$dummyNo';";
        $stmt = $dbh->query($query);
        // echo $query;

        //表示する情報を変数に保持(1社分のみなのでここで変数にしてしまう)
        foreach ($stmt as $row) {
            //セッションに保持する
            $dummyId = $row['d_id'];
            echo $dummyId;
            $_SESSION['DUMMYID'] = $dummyId;

            $companyName = $row['c_name'];
            echo $companyName;
            $companyNames = $row['c_names'];
            echo $companyNames;
            $companyPost = $row['c_post'];
            echo $companyPost;
            $companyAddress = $row['c_address'];
            echo $companyAddress;
            $companyTel = $row['c_tel'];
            echo $companyTel;
            $companyMail = $row['c_mail'];
            echo $companyMail;
            $companySection = $row['c_section'];
            echo $companySection;
        }

        //企業を追加ボタンを押したときにセッションを削除する
    } else if ($_POST['btn'] == "destory") {

        // セッション変数を全て解除する
        $_SESSION = array();
        // 最終的に、セッションを破壊する
        session_destroy();
        // echo "セッション削除";
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
    <link rel="stylesheet" type="text/css" href="css/aside.css">
    <title>企業追加</title>
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
                <h1>企業追加</h1>
            </div>

            <form action="companyCheck.php" method="POST" name="form">
                <table border="1">
                    <tr>
                        <th>企業名</th>
                        <td><input type="text" name="form[0]" value="<?php if (isset($_SESSION['FORMARRAY'][0])) {
                                                                            echo $_SESSION['FORMARRAY'][0];
                                                                        }
                                                                        if (isset($companyName)) {
                                                                            echo $companyName;
                                                                        } ?>" placeholder="株式会社HALシステムズ" id="" required></td>
                    </tr>

                    <tr>
                        <th>略称企業名</th>
                        <td><input type="text" name="form[1]" value="<?php if (isset($_SESSION['FORMARRAY'][1])) {
                                                                            echo $_SESSION['FORMARRAY'][1];
                                                                        }
                                                                        if (isset($companyNames)) {
                                                                            echo $companyNames;
                                                                        } ?>" placeholder="（株）HALシステムズ" id="" required></td>
                    </tr>

                    <tr>
                        <th>郵便番号</th>
                        <td><input type="text" name="form[2]" pattern="\d{7}" title="半角数字7桁でご入力ください。" value="<?php if (isset($_SESSION['FORMARRAY'][2])) {
                                                                                                                    echo $_SESSION['FORMARRAY'][2];
                                                                                                                }
                                                                                                                if (isset($companyPost)) {
                                                                                                                    echo $companyPost;
                                                                                                                } ?>" placeholder="6011111（半角数字7桁）" id="" required></td>
                    </tr>

                    <tr>
                        <th>住所</th>
                        <td><input type="text" name="form[3]" value="<?php if (isset($_SESSION['FORMARRAY'][3])) {
                                                                            echo $_SESSION['FORMARRAY'][3];
                                                                        }
                                                                        if (isset($companyAddress)) {
                                                                            echo $companyAddress;
                                                                        } ?>" placeholder="大阪府大阪市北区梅田〇－〇－〇" id="" required></td>
                    </tr>

                    <tr>
                        <th>電話番号</th>
                        <td><input type="tel" name="form[4]" pattern="\d{10,11}" value="<?php if (isset($_SESSION['FORMARRAY'][4])) {
                                                                                            echo $_SESSION['FORMARRAY'][4];
                                                                                        }
                                                                                        if (isset($companyTel)) {
                                                                                            echo $companyTel;
                                                                                        } ?>" placeholder="0123456789（半角数字10,11桁）" 　 id="" required></td>
                    </tr>

                    <tr>
                        <th>メールアドレス</th>
                        <td><input type="email" name="form[5]" value="<?php if (isset($_SESSION['FORMARRAY'][5])) {
                                                                            echo $_SESSION['FORMARRAY'][5];
                                                                        }
                                                                        if (isset($companyMail)) {
                                                                            echo $companyMail;
                                                                        } ?>" placeholder="abc@hal.co.jp" id="" required></td>
                    </tr>

                    <tr>
                        <th>採用課窓口</th>
                        <td><input type="text" name="form[6]" value="<?php if (isset($_SESSION['FORMARRAY'][6])) {
                                                                            echo $_SESSION['FORMARRAY'][6];
                                                                        }
                                                                        if (isset($companySection)) {
                                                                            echo $companySection;
                                                                        } ?>" placeholder="人事部採用課" id="" required></td>
                    </tr>

                </table>

                <button type="submit" name="check" class="btn btn_width">確認</button>
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