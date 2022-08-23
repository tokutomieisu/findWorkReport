<?php
session_start();
// $_SESSION["USERNAME"] = "山田";
// $_SESSION["COMPANYNAME"] = "HAL株式会社";
$companyId = $_SESSION["COMPANYID"];
$userName = $_SESSION["USERNAME"];
$userId = $_SESSION['USERID'];
$companyName = $_SESSION["COMPANYNAME"];

if (isset($_GET['j_id'])) {
    $jId = $_GET['j_id'];
    $_SESSION['SELECTJID'] = $jId;
} else {
    $jId = $_SESSION['SELECTJID'];
}

if (isset($_GET['a_id'])) {
    $aId = $_GET['a_id'];
    $_SESSION['SELECTAID'] = $aId;
} else {
    $aId = $_SESSION['SELECTAID'];
}

if (!empty($_SESSION['f_c_name'])) {
    $f_c_name = $_SESSION['f_c_name'];
}

$f_check = "";
$f_judge = "";

foreach ($f_c_name as $c_name) {
    if ($c_name == $companyName) {
        $f_check = "checked";
    }
}






if (isset($_POST['hidden'])) {
    if (isset($_POST['review'])) {
        $f_judge = "del";
    } else {
        $f_judge = "add";
    }
}


//DB接続準備
$dsn    = 'mysql:host=localhost;dbname=db26;charset=utf8';
$user     = 'root';
$password = '';

// DBへ接続
try {
    $dbh = new PDO($dsn, $user, $password);

    // クエリの実行
    if ($aId == '1') {
        $query = "SELECT i.classification , c.c_name, f.day, v.v_name, a.a_name, i.place, i.i_num, i.remarks FROM information_session AS i INNER JOIN findworkreport AS f ON f.j_id = i.j_id INNER JOIN mt_company AS c ON c.c_id = f.c_id INNER JOIN mt_venue AS v ON v.v_cd = f.v_cd INNER JOIN mt_activities AS a ON a.a_cd = f.a_cd WHERE i.j_id = " . $jId . ";";
    } else if ($aId == '2') {
        $query = "SELECT t.classification , c.c_name, f.day, v.v_name, a.a_name, t.question, t.theme, t.timerequired, t.wordcount, t.contents, t.remarks FROM tests AS t INNER JOIN findworkreport AS f ON f.j_id = t.j_id INNER JOIN mt_company AS c ON c.c_id = f.c_id INNER JOIN mt_venue AS v ON v.v_cd = f.v_cd INNER JOIN mt_activities AS a ON a.a_cd = f.a_cd WHERE t.j_id = " . $jId . ";";
    } else if ($aId == '3') {
        $query = "SELECT i.classification , c.c_name, f.day, v.v_name, a.a_name, i.interviewer, i.i_name, i.i_num, i.question, i.remarks FROM interview AS i INNER JOIN findworkreport AS f ON f.j_id = i.j_id INNER JOIN mt_company AS c ON c.c_id = f.c_id INNER JOIN mt_venue AS v ON v.v_cd = f.v_cd INNER JOIN mt_activities AS a ON a.a_cd = f.a_cd WHERE i.j_id = " . $jId . ";";
    } else if ($aId == '4') {
        $query = "SELECT o.classification , c.c_name, f.day, v.v_name, a.a_name, o.o_num, o.contents, o.remarks FROM other AS o INNER JOIN findworkreport AS f ON f.j_id = o.j_id INNER JOIN mt_company AS c ON c.c_id = f.c_id INNER JOIN mt_venue AS v ON v.v_cd = f.v_cd INNER JOIN mt_activities AS a ON a.a_cd = f.a_cd WHERE o.j_id = " . $jId . ";";
    }
    $stmt = $dbh->query($query);

    $sqlpro = "SELECT  p.name FROM findworkreport AS f INNER JOIN report_property AS fp ON f.j_id = fp.j_id INNER JOIN mt_property AS p ON p.id = fp.p_id WHERE f.j_id = " . $jId . ";";
    $stmtpro = $dbh->query($sqlpro);
    $count = $stmtpro->rowCount();

    if ($aId == "1") {
        $sqlflo = "SELECT  fl.name FROM information_session AS f INNER JOIN information_session i ON f.j_id = i.j_id INNER JOIN report_flow AS rf ON i.info_id = rf.i_id INNER JOIN mt_flow AS fl ON rf.f_id = fl.id WHERE f.j_id =" . $jId . ";";
        $stmtflo = $dbh->query($sqlflo);
        $count2 = $stmtflo->rowCount();
    }

    if ($f_judge == "add") {
        $sql1 = "INSERT INTO student_company (s_id, c_id) VALUES('$userId', '$companyId');";
        $f_c_name[] = $companyName;
        $stmtf = $dbh->query($sql1);
        $_SESSION['f_c_name'] = $f_c_name;
    } else if ($f_judge == "del") {
        $sql1 = "DELETE FROM student_company WHERE c_id = '$companyId' AND s_id = '$userId';";
        $stmtf = $dbh->query($sql1);
        $key = array_search($companyName, $f_c_name);
        unset($f_c_name[$key]);
        $f_c_name = array_values($f_c_name);
        $_SESSION['f_c_name'] = $f_c_name;
    }


    // 接続を閉じる(※DBからデータを取得出来た時点で接続を切る)
    $dbh = null;
} catch (PDOException $e) {
    print("データベースの接続に失敗しました" . $e->getMessage());
    die();
}

$f_check = "";

foreach ($f_c_name as $c_name) {
    if ($c_name == $companyName) {
        $f_check = "checked";
    }
}

/****************************
 *        タイトル算出
 *****************************/
$val = $stmt->fetch(PDO::FETCH_ASSOC);
$valpro = $stmtpro->fetchAll();


$classification2 = $val["classification"];


for ($i = 0; $i < $count; $i++) {
    $property[$i] = $valpro[$i]['name'];
}
if (empty($property[0])) {
    $property = array("");
}


if ($aId == "1") {
    $valflo = $stmtflo->fetchAll();
    for ($j = 0; $j < $count2; $j++) {
        $flow[$j] = $valflo[$j]['name'];
        // echo $flow[$j];
    }
    if (empty($flow[0])) {
        $flow = array("");
    }
}




$reportText = array();
$strClassification2_name = array();


//説明会（infosession.php）
if ($classification2 == "合同") {
    $strClassification2_name = array("会場名");
    $reportText = array($val["place"]);
} else if ($classification2 == "学内") {
    $strClassification2_name = array("教室名");
    $reportText = array($val["place"]);
} else if ($classification2 == "学外") {
    $strClassification2_name = array("参加人数");
    $reportText = array($val["i_num"]);
}
//試験（test.php）
else if ($classification2 == "ES") {
    $strClassification2_name = array("質問事項");
    $reportText = array($val["question"]);
} else if ($classification2 == "作文") {
    $strClassification2_name = array("題名", "所要時間", "文字数");
    $reportText = array($val['theme'], $val['timerequired'], $val['wordcount']);
} else if ($classification2 == "筆記") {
    $strClassification2_name = array("内容");
    $reportText = array($val["contents"]);
} else if ($classification2 == "実技") {
    $strClassification2_name = array("内容");
    $reportText = array($val["contents"]);
}
// 面接（interview.php）
else if ($classification2 == "個人") {
    $strClassification2_name = array("面接官", "何次面接", "質問内容");
    $reportText = array($val['interviewer'] . "人", $val['i_name'], $val['question']);
} else if ($classification2 == "集団") {
    $strClassification2_name = array("面接官", "受験者数", "質問内容");
    $reportText = array($val['interviewer'] . "人", $val['i_num'] . "人", $val['question']);
} else if ($classification2 == "役員") {
    $strClassification2_name = array("面接官", "質問内容");
    $reportText = array($val['interviewer'] . "人", $val['question']);
}
// その他（othres.php）
else if ($classification2 == "グループワーク") {
    $strClassification2_name = array("受験者数", "内容");
    $reportText = array($val['o_num'] . "人", $val['contents']);
} else if ($classification2 == "グループディスカッション") {
    $strClassification2_name = array("受験者数", "内容");
    $reportText = array($val['o_num'] . "人", $val['contents']);
} else if ($classification2 == "その他") {
    $strClassification2_name = array("内容");
    $reportText = array($val['contents']);
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>説明会確認画面</title>
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/button.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/backImg.css">
    <link rel="stylesheet" type="text/css" href="css/check.css">
    <link rel="stylesheet" type="text/css" href="css/readStudentInfo.css">
    <link rel="stylesheet" type="text/css" href="css/favorite.css">

</head>

<body>
    <header>
        <div class="headwrrap">
            <div class="flex">
                <p><img src="img/aicon.png" alt="logo"></p>
                <p><?php echo $userName; ?>&nbsp;様</p>
            </div>
            <nav>
                <ul>
                    <li><a href="favoriteCompany.php">検討リスト</a>
                    <li><a href="select.php">TOP</a>
                    <li class="logout"><a href="index.html">ログアウト</a>
                </ul>
            </nav>
        </div>
    </header>

    <a href="findWorkReport.php" class="backimg"><img src="img/back.png" alt="back"></a>

    <section class="main">
        <div class="text">
            <form action="readReport.php" method="post" name="myForm">
                <h1><?= date('Y年n月d日', strtotime($val["day"])) . "&emsp;" . $val['classification'] ?>
                    <span class="star">
                        <input id="review06" type="checkbox" name="review" value="1" <?= $f_check ?>><label for="review06" onclick="runOpenstrt()">★</label>
                    </span>
                </h1>


                <table border="1" class="report">
                    <tr>
                        <th>企業名</th>
                        <td><?= $val['c_name'] ?></td>
                    </tr>

                    <tr>
                        <th>日時</th>
                        <td><?= date('Y年n月d日', strtotime($val["day"])) ?></td>
                    </tr>

                    <tr>
                        <th>形態</th>
                        <td><?= $val['v_name'] ?></td>
                    </tr>

                    <tr>
                        <th>活動内容</th>
                        <td><?= $val['a_name'] ?></td>
                    </tr>

                    <tr>
                        <th>区分</th>
                        <td><?= $val['classification'] ?></td>
                    </tr>
                    <?php $i = 0; ?>
                    <?php foreach ($strClassification2_name as $name) { ?>
                        <tr>
                            <th><?= $name ?></th>
                            <td><?= $reportText[$i] ?></td>
                        </tr>
                        <?php $i++; ?>
                    <?php  } ?>

                    <?php if ($aId == '1') { ?>
                        <tr>
                            <th>選考フロー</th>
                            <td><?php foreach ($flow as $class2) { ?>
                                    <?php $class2 = next($flow) ? $class2 . " →" : $class2 ?>
                                    <?php echo $class2; ?>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <th>持参物</th>
                        <td><?php foreach ($property as $class) { ?>
                                <?php $class = next($property) ? $class . "," : $class ?>
                                <?php echo $class; ?>
                            <?php } ?>
                        </td>
                    </tr>

                    <tr>
                        <th>感想</th>
                        <td><?= $val['remarks'] ?></td>
                    </tr>
                </table>
                <input type="hidden" name="hidden" value="hidden">
            </form>
        </div>
    </section>
    <script src="js/favorite.js"></script>
</body>

</html>