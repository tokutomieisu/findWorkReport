<?php
session_start();
$companyId = $_SESSION["COMPANYID"];
$userName = $_SESSION["USERNAME"];
$companyName = $_SESSION["COMPANYNAME"];
$a_name = $_SESSION["a_name"];
$aId = $_SESSION["a_cd"];

if (isset($_GET['j_id'])) {
    $jId = $_GET['j_id'];
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


    // 接続を閉じる(※DBからデータを取得出来た時点で接続を切る)
    $dbh = null;
} catch (PDOException $e) {
    print("データベースの接続に失敗しました" . $e->getMessage());
    die();
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
    <link rel="stylesheet" type="text/css" href="css/base_mb.css">
    <link rel="stylesheet" type="text/css" href="css/button_mb.css">
    <link rel="stylesheet" type="text/css" href="css/header_mb.css">
    <link rel="stylesheet" type="text/css" href="css/footer_mb.css">
    <link rel="stylesheet" type="text/css" href="css/readReport_mb.css">
    <title>レポート選択</title>
</head>

<body>
    <header>
        <div class="headwrrap">
            <div class="flex h_textarea">
                <a href="findWorkReport_mb.php" class="backimg"><img src="img/back_mb.png" alt="back"></a>
                <p class="h_text"><?= $val['c_name'] ?>&ensp; <?= $a_name ?></p>
            </div>

        </div>
    </header>
    <section class="main">
        <form action="searchResult.php" method="get">
            <div class="text">
                <table class="report">
                    <tr>
                        <th>企業名</th>
                    </tr>
                    <tr>
                        <td>
                            <?= $val['c_name'] ?>
                        </td>
                    </tr>


                    <tr>
                        <th>日時</th>
                    </tr>
                    <tr>
                        <td>
                            <?= date('Y年n月d日', strtotime($val["day"])) ?>
                        </td>
                    </tr>



                    <tr>
                        <th>形態</th>
                    </tr>
                    <tr>
                        <td>
                            <?= $val['v_name'] ?>
                        </td>
                    </tr>



                    <tr>
                        <th>活動内容</th>
                    </tr>
                    <tr>
                        <td>
                            <?= $val['a_name'] ?>
                        </td>
                    </tr>



                    <tr>
                        <th>区分</th>
                    </tr>
                    <tr>
                        <td>
                            <?= $val['classification'] ?>
                        </td>
                    </tr>



                    <?php $i = 0; ?>
                    <?php foreach ($strClassification2_name as $name) { ?>
                        <tr>
                            <th><?= $name ?></th>
                        </tr>
                        <tr>
                            <td><?= $reportText[$i] ?></td>
                        </tr>
                        <?php $i++; ?>
                    <?php  } ?>

                    <?php if ($aId == '1') { ?>
                        <tr>
                            <th>選考フロー</th>
                        </tr>
                        <tr>
                            <td><?php foreach ($flow as $class2) { ?>
                                    <?php $class2 = next($flow) ? $class2 . " →" : $class2 ?>
                                    <?php echo $class2; ?>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <th>持参物</th>
                    </tr>
                    <tr>
                        <td>
                            <?php foreach ($property as $class) { ?>
                                <?php $class = next($property) ? $class . "," : $class ?>
                                <?php echo $class; ?>
                            <?php } ?>
                        </td>
                    </tr>

                    <tr>
                        <th>感想</th>
                    </tr>
                    <tr>
                        <td><?= $val['remarks'] ?></td>
                    </tr>

                </table>


            </div>
        </form>
        <footer>
            <div class="footerwrrap">
                <p class="icon"><a href="search_mb.php"><img src="img/search.png" alt=""></a></p>
            </div>
            <div class="footertext">
                <p class="icontext">検索</p>
            </div>
        </footer>
    </section>
</body>

</html>