<?php
//編集画面から入力値を受け取る
if (!empty($_POST['t_id'])) {
    $teacherId = $_POST['t_id'];
}
if (!empty($_POST['t_name'])) {
    $teacherName = $_POST['t_name'];
}

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

    //btnを受け取った場合
    if (!empty($_POST['btn'])) {

        if ($_POST['btn'] == 'add') {  //btnの値が追加の場合、登録処理を行う
            echo "データベースに登録します\n";

            //セッションを始める
            session_start();

            //登録前のレコード件数を取得
            $cId = $_POST['count'];
            echo "IDの最大値：" . $cId . "\n";
            $cId = $cId + 1;
            echo "IDの最大値+1：" . $cId . "\n";
            echo "IDの桁数は：" . strlen($cId) . "\n";

            if (isset($_SESSION['DUMMYID'])) {
                $dummyId = $_SESSION['DUMMYID'];
                echo "ダミーID：" . $dummyId . "\n";

                if (strlen($cId) == 1) { //企業IDの値が一桁（1～9）の場合
                    $cId = 'co0000' . $cId;
                    echo $cId;
                    $sql = "UPDATE new_company SET c_id ='$cId' WHERE d_id='$dummyId'";
                } else { //企業IDの値が二桁（10以上）の場合
                    $cId = 'co000' . $cId;
                    echo $cId;
                    $sql = "UPDATE new_company SET c_id ='$cId' WHERE d_id='$dummyId';";
                }
                echo $sql . "\n";
                $stmt = $dbh->query($sql);

                $name = $_SESSION['FORMARRAY'][0];
                $names = $_SESSION['FORMARRAY'][1];
                $post = $_SESSION['FORMARRAY'][2];
                $address = $_SESSION['FORMARRAY'][3];
                $tel = $_SESSION['FORMARRAY'][4];
                $mail = $_SESSION['FORMARRAY'][5];
                $section = $_SESSION['FORMARRAY'][6];

                $sql1 = "UPDATE mt_company SET c_id = '$cId', c_name = '$name', c_names = '$names',c_post = '$post',c_address = '$address', c_tel = '$tel', c_mail = '$mail', c_section = '$section' WHERE c_id = '$dummyId';";
                echo $sql1;
                $stmt2 = $dbh->query($sql1);
            } else {

                // SQL文をセット
                //企業を追加登録する
                $sql = "INSERT INTO mt_company (c_id,c_name,c_names,c_post,c_address,c_tel,c_mail,c_section) VALUES(:id,:name,:names,:post,:address,:tel,:email,:section);";
                echo $sql;
                $stmt = $dbh->prepare($sql);

                // 値をセット
                if (strlen($cId) == 1) { //企業IDの値が一桁（1～9）の場合
                    $stmt->bindValue(':id', 'co0000' . $cId);
                } else { //企業IDの値が二桁（10以上）の場合
                    $stmt->bindValue(':id', 'co000' . $cId);
                }
                $stmt->bindValue(':name', $_SESSION['FORMARRAY'][0]);
                $stmt->bindValue(':names', $_SESSION['FORMARRAY'][1]);
                $stmt->bindValue(':post', $_SESSION['FORMARRAY'][2]);
                $stmt->bindValue(':address', $_SESSION['FORMARRAY'][3]);
                $stmt->bindValue(':tel', $_SESSION['FORMARRAY'][4]);
                $stmt->bindValue(':email', $_SESSION['FORMARRAY'][5]);
                $stmt->bindValue(':section', $_SESSION['FORMARRAY'][6]);
                // クエリを実行
                $stmt->execute();
            }
            // セッション変数を全て解除する
            $_SESSION = array();
            // 最終的に、セッションを破壊する
            session_destroy();
            // echo "セッション削除";

        } else {
            $sql = "UPDATE mt_teacher SET t_name='$teacherName' WHERE t_id='$teacherId'";
            // echo "教員名更新SQL＝", $sql;

            $stmt2 = $dbh->query($sql);
        }
    }
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
    <title>完了画面</title>
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
            <?php if ($_POST['btn'] == 'add') { ?>
                <div class="head_flex">
                    <h1>企業追加</h1>
                </div>

                <h3>企業の追加が完了しました。</h3>

                <a href="company.php" class="btn btn_add_width">戻る</a>

            <?php } else { ?>

                <div class="head_flex">
                    <h1>教官編集</h1>
                </div>

                <h3>変更が完了しました。</h3>

                <a href="teacher.php" class="btn btn_add_width">戻る</a>

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
                    <span>未処理<?php echo $d_count ?>件</span>
                <?php } ?>
            </li>
        </ul>
    </aside>

</body>

</html>