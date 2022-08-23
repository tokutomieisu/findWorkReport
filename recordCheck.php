<?php

session_start();
//会社名
$companyName = $_SESSION['COMPANYNAME'];
//ユーザー名
$userName = $_SESSION['USERNAME'];
//日付を取得
$day = $_SESSION['DAY'];
//対面・オンライン
$place = $_SESSION['PLACE'];
//活動内容
$active = $_SESSION['ACTIVE'];
//戻る画面
$back;
$i = 0;


/**
 * 学生IDから所属ID取得(af_id)
 * 活動内容から活動コードを割り当てる(a_cd)
 */

/**
 * 学生IDから所属ID取得(af_id)
 * $userId = $_SESSION['USERID'];
 * SELECT a.id
 * FROM affiliation a
 * WHERE a.student_id = $userId
 * ;
 */

/**
 * 企業ID取得(c_id)
 * $c_id = $_SESSION['COMPANYID'];
 */

/**
 * 活動内容から活動コードを割り当てる(a_cd)
 * if($active == "説明会"){
 *  $a_cd = "1";
 * }else if($active == "試験"){
 *  $a_cd = "2";
 * }else if($active == "面接"){
 *  $a_cd = "3";
 * }else if($active == "その他"){
 *  $a_cd = "4";
 * }
 */

/**
 * in_cd（業界）とo_cd（職種）はnullとする
 */


/**
 * 対面orオンライン(v_cd)
 * if($place == "対面"){
 * $v_cd = "1";
 * }else{
 * $v_cd = "2";
 * }
 */

/**
 * 日付(day)
 * そのまま使用
 */

/**
 * 持参物（property）
 * for($p=0;$p<count($property);$p++){
 * $propertys = $p!=0 ? $propertys . "," $property[$p] : $property[$p]
 * }
 */


/**
 * 任意の画面の区分を取得する
 */
if (!empty($_GET["classification"])) {
    $classification2 = $_GET['classification'];
    $back = "test.php";
} else if (!empty($_GET["classification2"])) {
    $classification2 = $_GET['classification2'];
    $back = "infosession.php";
} else if (!empty($_GET["classification3"])) {
    $classification2 = $_GET['classification3'];
    $back = "interview.php";
} else if (!empty($_GET["classification4"])) {
    $classification2 = $_GET['classification4'];
    $back = "others.php";
}
//区分をセッションに格納
$_SESSION['CLASSFICATION2'] = $classification2;


/****************************
 *        タイトル算出
 *****************************/
$strClassification2_name = array("参加人数");

//説明会（infosession.php）
if ($classification2 == "合同") {
    $strClassification2_name = array();
    $strClassification2_name = array("会場名");
} else if ($classification2 == "学内") {
    $strClassification2_name = array();
    $strClassification2_name = array("教室名");
}
//試験（test.php）
else if ($classification2 == "ES") {
    $strClassification2_name = array();
    $strClassification2_name = array("質問事項");
} else if ($classification2 == "作文・小論文") {
    $strClassification2_name = array();
    $strClassification2_name = array("題名", "所要時間", "文字数");
} else if ($classification2 == "筆記") {
    $strClassification2_name = array();
    $strClassification2_name = array("内容");
} else if ($classification2 == "実技") {
    $strClassification2_name = array();
    $strClassification2_name = array("内容");
}
// 面接（interview.php）
else if ($classification2 == "個人") {
    $strClassification2_name = array();
    $strClassification2_name = array("面接官", "何次面接", "質問内容");
} else if ($classification2 == "集団") {
    $strClassification2_name = array();
    $strClassification2_name = array("面接官", "受験者数", "質問内容");
} else if ($classification2 == "役員") {
    $strClassification2_name = array();
    $strClassification2_name = array("面接官", "質問内容");
}
// その他（othres.php）
else if ($classification2 == "グループワーク") {
    $strClassification2_name = array();
    $strClassification2_name = array("受験者数", "内容");
} else if ($classification2 == "グループディスカッション") {
    $strClassification2_name = array();
    $strClassification2_name = array("受験者数", "内容");
} else if ($classification2 == "その他") {
    $strClassification2_name = array();
    $strClassification2_name = array("内容");
}

//タイトルに対する回答
$classification2_text = $_GET['classification2text'];

//回答をセッションに格納。
$_SESSION['CLASSIFICATION2_TEXT'] = $classification2_text;


/**
 * 配列内の空白を削除する処理
 */
foreach ($classification2_text as $key => $val) {
    if ($classification2_text[$key] == "") {
        //削除実行
        unset($classification2_text[$key]);
    }
    //Indexを詰める
    array_values($classification2_text);
}
$_SESSION['CLASSIFICATION_TEXT'] = $classification2_text;

//持参物
if (!empty($_GET['property'])) {
    $property = $_GET['property'];
} else {
    $property = array("");
}

//選考フロー
if (!empty($_GET['flow'])) {
    $flow = $_GET['flow'];
} else {
    $flow = array("");
}


//持参物をセッションに格納
$_SESSION['PROPERTY'] = $property;

//選考フローをセッションに格納
$_SESSION['FLOW'] = $flow;

/**
 * 配列の中身を確認
 * var_dump($property);
 */
//感想
$thoughts = $_GET['thoughts'];
//感想をセッションに格納
$_SESSION['THOUGHTS'] = $thoughts;

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>入力確認</title>
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/button.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/backImg.css">
    <link rel="stylesheet" type="text/css" href="css/check.css">
    <link rel="stylesheet" type="text/css" href="css/readStudentInfo.css">
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

    <a href="<?php echo $back ?>" class="backimg"><img src="img/back.png" alt="back"></a>

    <section class="main">
        <div class="text">
            <h1>記録内容確認</h1>
            <table border="1" class="report report_another">
                <tr>
                    <th>企業名</th>
                    <td><?php echo $companyName; ?></td>
                </tr>

                <tr>
                    <th>日時</th>
                    <td><?php echo date('Y年n月d日', strtotime($day)); ?></td>
                </tr>

                <tr>
                    <th>形態</th>
                    <td><?php echo $place; ?></td>
                </tr>

                <tr>
                    <th>活動内容</th>
                    <td><?php echo $active; ?></td>
                </tr>

                <tr>
                    <th>区分</th>
                    <td><?php echo $classification2; ?></td>
                </tr>



                <?php foreach ($classification2_text as $date) { ?>
                    <tr>
                        <th><?php echo $strClassification2_name[$i]; ?></th>
                        <td>
                        <?php echo $date;
                        $i++;
                    } ?>
                        </td>
                    </tr>

                    <?php if ($active == "説明会") { ?>
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
                        <td><?php echo $thoughts; ?></td>
                    </tr>
            </table>
        </div>
        <a class="btn" href="recordAdd.php" class="button">登録</a>
    </section>
</body>

</html>