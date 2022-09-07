<?php
$array = $_POST['form'];
foreach ($array as $row) {
    echo $row . "\n";
}
//セッション開始
session_start();

$companyName = $_SESSION['COMPANYNAME'];
echo $companyName . "\n";
$companyNames = $_SESSION['COMPANYNAMES'];
echo $companyNames . "\n";
$companyPost = $_SESSION['COMPANYPOST'];
echo $companyPost . "\n";
$companyAddress = $_SESSION['COMPANYADDRESS'];
echo $companyAddress . "\n";
$companyTel = $_SESSION['COMPANYTEL'];
echo $companyTel . "\n";
$companyMail = $_SESSION['COMPANYMAIL'];
echo $companyMail . "\n";
$companySection = $_SESSION['COMPANYSECTION'];
echo $companySection . "\n";

//変数設定
$ep = 0; //epはEdited partの略
$set = "初期値";
echo "ep初期値＝", $ep . "\n";

//編集画面から入力値を受け取る
if (isset($_POST['form'])) {
    echo "データベース変更\n";

    //受け取った名前がセッション保持の名前と一致しているなら処理しない
    if ($companyName !== $array[1]) {
        $companyName = $array[1];
        $ep = $ep + 1; //1
        $name = 'true';
        $set = "c_name = \"" . $companyName . "\"";
        echo "ep1=", $ep . "\n";
    }
    if ($companyNames !== $array[2]) {
        $companyNames = $array[2];

        echo "ep2=", $ep . "\n";
        if ($ep == 0) {
            $set = "c_names = \"" . $companyNames . "\"";
        } else {
            $set = $set . "," . "c_names = \"" . $companyNames . "\"";
        }
        $names = 'true';
        $ep = $ep + 1;
    }
    if ($companyPost !== $array[3]) {
        $companyPost = $array[3];
        echo "ep3=", $ep . "\n";
        if ($ep == 0) {
            $set = "c_post = \"" . $companyPost . "\"";
        } else {
            $set = $set . "," . "c_post = \"" . $companyPost . "\"";
        }
        $post = 'true';
        $ep = $ep + 1;
    }
    if ($companyAddress !== $array[4]) {
        $companyAddress = $array[4];
        echo "ep4=", $ep . "\n";
        if ($ep == 0) {
            $set = "c_address = \"" . $companyAddress . "\"";
        } else {
            $set = $set . "," . "c_address = \"" . $companyAddress . "\"";
        }
        $address = 'true';
        $ep = $ep + 1;
    }
    if ($companyTel !== $array[5]) {
        $companyTel = $array[5];
        echo "ep5=", $ep . "\n";
        if ($ep == 0) {
            $set = "c_tel = \"" . $companyTel . "\"";
        } else {
            $set = $set . "," . "c_tel = \"" . $companyTel . "\"";
        }
        $tel = 'true';
        $ep = $ep + 1;
    }
    if ($companyMail !== $array[6]) {
        $companyMail = $array[6];
        echo "ep6=", $ep . "\n";
        if ($ep == 0) {
            $set = "c_mail = \"" . $companyMail . "\"";
        } else {
            $set = $set . "," . "c_mail = \"" . $companyMail . "\"";
        }
        $mail = 'true';
        $ep = $ep + 1;
    }
    if ($companySection !== $array[7]) {
        $companySection = $array[7];
        echo "ep7=", $ep . "\n";
        if ($ep == 0) {
            $set = "c_section = \"" . $companySection . "\"";
        } else {
            $set = $set . "," . "c_section = \"" . $companySection . "\"";
        }
        $section = 'true';
        $ep = $ep + 1;
    }
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

    // //btnを受け取った場合
    // if (!empty($_POST['btn'])) {

    //     //echo "データベースを変更します";


    //     // foreach ($array as $row) {
    //     //     echo $row;
    //     // }
    //     // SQL文をセット
    //     //企業IDによって企業情報を変更する
    //     $sql = "UPDATE mt_company SET c_name = :name, c_names = :names, c_post = :post, c_address = :address, c_tel = :tel, c_mail = :email, c_section = :section WHERE c_id = '$array[0]';";
    //     //echo $sql;
    //     $stmt = $dbh->prepare($sql);

    //     // 値をセット
    //     $stmt->bindValue(':name', $array[1]);
    //     $stmt->bindValue(':names', $array[2]);
    //     $stmt->bindValue(':post', $array[3]);
    //     $stmt->bindValue(':address', $array[4]);
    //     $stmt->bindValue(':tel', $array[5]);
    //     $stmt->bindValue(':email', $array[6]);
    //     $stmt->bindValue(':section', $array[7]);

    //     // クエリを実行
    //     $stmt->execute();
    // }

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
        $query = "UPDATE mt_company SET " . $set . " WHERE c_id =\"" . $array[0] . "\";";
        echo "sql文：", $query, "　";
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
                <h1>企業編集完了（変更箇所は赤字で表示）</h1>
            </div>

            <table border="1">
                <tr>
                    <th>ID</th>
                    <!--修正した場合フォントカラーを赤色にする-->
                    <td>
                        <?php echo $array[0]; ?>
                    </td>
                </tr>

                <tr>
                    <th>企業名</th>
                    <td <?php
                        if (!empty($name)) {
                            echo " class = \"change\"";
                        }
                        ?>><?php echo $companyName ?>
                    </td>
                </tr>

                <tr>
                    <th>略称企業名</th>
                    <td <?php
                        if (!empty($names)) {
                            echo " class = \"change\"";
                        }
                        ?>><?php echo $companyNames ?>
                    </td>

                </tr>

                <tr>
                    <th>郵便番号</th>
                    <td <?php
                        if (!empty($post)) {
                            echo " class = \"change\"";
                        }
                        ?>><?php echo $companyPost ?>
                    </td>
                </tr>

                <tr>
                    <th>住所</th>
                    <td <?php
                        if (!empty($address)) {
                            echo " class = \"change\"";
                        }
                        ?>><?php echo $companyAddress ?>
                    </td>
                </tr>

                <tr>
                    <th>電話番号</th>
                    <td <?php
                        if (!empty($tel)) {
                            echo " class = \"change\"";
                        }
                        ?>><?php echo $companyTel ?>
                    </td>
                </tr>

                <tr>
                    <th>メールアドレス</th>
                    <td <?php
                        if (!empty($mail)) {
                            echo " class = \"change\"";
                        }
                        ?>><?php echo $companyMail ?>
                    </td>
                </tr>

                <tr>
                    <th>採用課窓口</th>
                    <td <?php
                        if (!empty($section)) {
                            echo " class = \"change\"";
                        }
                        ?>><?php echo $companySection ?>
                    </td>
                </tr>
            </table>
            <a class="btn btn_width btn_margin" href="company.php">完了</a>
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