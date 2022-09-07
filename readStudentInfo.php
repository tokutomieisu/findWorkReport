<?php
session_start();

$userName = $_SESSION['USERNAME'];
$userId = $_SESSION['USERID'];

//戻り矢印のとび先
$a_href = "./searchResult.php";

if (!empty($_GET['c_id'])) {
    $_SESSION["COMPANYID"] = $_GET['c_id'];
}

if (!empty($_GET['c_name'])) {
    $_SESSION["COMPANYNAME"] = $_GET['c_name'];
}
if (!empty($_GET['back'])) {
    $a_href = "favoriteCompany.php";
}





$companyId = $_SESSION["COMPANYID"];
$companyName = $_SESSION["COMPANYNAME"];




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

if (isset($_POST['hidden1'])) {
    if (isset($_POST['review'])) {
        $f_judge = "add";
    } else {
        $f_judge = "del";
    }
}




$title = $companyName;


//DB接続準備
$dsn    = 'mysql:host=localhost;dbname=db26;charset=utf8';
$user     = 'root';
$password = '';
$br = '<br>';

// DBへ接続
try {
    $dbh = new PDO($dsn, $user, $password);

    // クエリの実行
    $query = "SELECT f.af_id , f.day , c. curriculum , c.course FROM findworkreport f INNER JOIN affiliation a ON f.af_id = a.id JOIN mt_class c ON a.class_id = c.class_id  WHERE c_id = '$companyId' GROUP BY f.af_id ORDER BY f.day DESC;";
    $stmt = $dbh->query($query);

    if ($f_judge == "add") {
        $sql1 = "INSERT INTO student_company (s_id, c_id) VALUES('$userId', '$companyId');";
        $f_c_name[] = $companyName;
        $stmt1 = $dbh->query($sql1);
        $_SESSION['f_c_name'] = $f_c_name;
    } else if ($f_judge == "del") {
        $sql1 = "DELETE FROM student_company WHERE c_id = '$companyId' AND s_id = '$userId';";
        $stmt1 = $dbh->query($sql1);
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
    <link rel="stylesheet" type="text/css" href="css/backImg.css">
    <link rel="stylesheet" type="text/css" href="css/readStudentInfo.css">
    <link rel="stylesheet" type="text/css" href="css/favorite.css">
    <title>閲覧（学生名）</title>
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

    <a href=<?= $a_href ?> class="backimg"><img src="img/back.png" alt="back"></a>

    <section class="main">
        <div class="text">
            <form action="readStudentInfo.php" method="post" name="myForm">
                <div class="flex starflex">
                    <h1><?= $title ?> </h1>
                    <span class="star ">
                        <input id="review06" type="checkbox" name="review" value="1" <?= $f_check ?> onclick="runOpenstrt()"><label for="review06"><span class="set"><span id="s_star">★</span><span class="block">検討リスト</span></span></label>
                    </span>
                </div>

                <div class="area">
                    <?php foreach ($stmt as $row) { ?>
                        <a href="findWorkReport.php?af_id=<?= $row["af_id"] ?>" class="category2 btn_a a_list"><?= date('Y年n月d日', strtotime($row["day"])) . "&emsp;" . $row["curriculum"] . "&nbsp;" . $row["course"]; ?></a><br>
                    <?php } ?>
                </div>
                <input type="hidden" name="hidden1" value="hidden">
            </form>
        </div>
    </section>
    <script src="js/favorite.js"></script>
</body>

</html>