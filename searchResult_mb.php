<?php

//セッション開始
session_start();
// $_SESSION['USERNAME'] = "大阪 春子";
$userName = $_SESSION['USERNAME'];
// $select =  $_SESSION['SELECT'];
// echo $select;

//入力フォームからデータ受け取り
if (!empty($_SESSION['SELECTCOMPANYNAME'])) {
    $company = $_SESSION['SELECTCOMPANYNAME'];
} else if (!empty($_GET['company'])) {
    $company = $_GET['company'];
    $_SESSION['SELECTCOMPANYNAME'] = $company;
    $_SESSION['COMPANYNAME'] = $company;
} else {
    $company = "";
}
// echo "company:" . $company, "　";
$count = 0;

if (!empty($_GET['industry'])) {
    $industry = $_GET['industry'];
    if ($industry == "in000") {
        $industry = "";
    }

    // echo "industry:" . $industry, "　";

    $occupation = $_GET['occupation'];
    if ($occupation == "oc000") {
        $occupation = "";
    }
} else if (!empty($_SESSION['INDUSTRY'])) {
    $industry = $_SESSION['INDUSTRY'];
    $occupation = $_SESSION['OCCUPATION'];
} else {
    $industry = "";
    $occupation = "";
}


$_SESSION['INDUSTRY'] = $industry;
$_SESSION['OCCUPATION'] = $occupation;


// SQL検索条件用変数設定(scはSearch conditionsの略)
$sc = 0;
if ($company !== "") {
    $sc = $sc + 1;
}
if ($industry !== "") {
    $sc = $sc + 2;
}
if ($occupation !== "") {
    $sc = $sc + 4;
}
// echo "sc=", $sc, "　";

//DB接続準備
$dsn      = 'mysql:dbname=db26;host=localhost';
$user     = 'root';
$password = '';

// DB接続
try {
    $dbh = new PDO($dsn, $user, $password);

    //1:企業名のみで検索する場合
    if ($sc == 1) {
        // echo "企業名のみでの検索";
        $query = "SELECT mtc.c_id,mtc.c_name,mti.in_name,mto.o_name FROM findworkreport f LEFT OUTER JOIN mt_company mtc USING(c_id) LEFT OUTER JOIN mt_industry mti USING(in_cd) LEFT OUTER JOIN mt_occupation mto USING(o_cd) WHERE mtc.c_name LIKE '%$company%' GROUP BY mtc.c_name;";
        //2:業種のみで検索する場合
    } else if ($sc == 2) {
        // echo "業種のみでの検索";
        $query = "SELECT mtc.c_id,mtc.c_name,mti.in_name,mto.o_name FROM findworkreport f LEFT OUTER JOIN mt_company mtc USING(c_id) LEFT OUTER JOIN mt_industry mti USING(in_cd) LEFT OUTER JOIN mt_occupation mto USING(o_cd) WHERE mti.in_cd = '$industry' GROUP BY mtc.c_name;";
        //3:企業名＋業種で検索する場合
    } else if ($sc == 3) {
        // echo "企業名＋業種での検索";
        $query = "SELECT mtc.c_id,mtc.c_name,mti.in_name,mto.o_name FROM findworkreport f LEFT OUTER JOIN mt_company mtc USING(c_id) LEFT OUTER JOIN mt_industry mti USING(in_cd) LEFT OUTER JOIN mt_occupation mto USING(o_cd) WHERE mtc.c_name LIKE '%$company%' AND mto.in_cd = '$industry' GROUP BY mtc.c_name;";
        //4:職種のみで検索する場合
    } else if ($sc == 4) {
        // echo "職種のみでの検索";
        $query = "SELECT mtc.c_id,mtc.c_name,mti.in_name,mto.o_name FROM findworkreport f LEFT OUTER JOIN mt_company mtc USING(c_id) LEFT OUTER JOIN mt_industry mti USING(in_cd) LEFT OUTER JOIN mt_occupation mto USING(o_cd) WHERE mto.o_cd = '$occupation' GROUP BY mtc.c_name;";
        //5:企業名＋職種で検索する場合
    } else if ($sc == 5) {
        // echo "企業名＋職種での検索";
        $query = "SELECT mtc.c_id,mtc.c_name,mti.in_name,mto.o_name FROM findworkreport f LEFT OUTER JOIN mt_company mtc USING(c_id) LEFT OUTER JOIN mt_industry mti USING(in_cd) LEFT OUTER JOIN mt_occupation mto USING(o_cd) WHERE mtc.c_name LIKE '%$company%' AND mto.o_cd = '$occupation' GROUP BY mtc.c_name;";
        //6:業種＋職種で検索する場合
    } else if ($sc == 6) {
        // echo "業種＋職種での検索";
        $query = "SELECT mtc.c_id,mtc.c_name,mti.in_name,mto.o_name FROM findworkreport f LEFT OUTER JOIN mt_company mtc USING(c_id) LEFT OUTER JOIN mt_industry mti USING(in_cd) LEFT OUTER JOIN mt_occupation mto USING(o_cd) WHERE mti.in_cd = '$industry' AND mto.o_cd = '$occupation' GROUP BY mtc.c_name;";
        //3:企業名＋業種＋職種で検索する場合
    } else if ($sc == 7) {
        // echo "企業名＋業種＋職種での検索";
        $query = "SELECT mtc.c_id,mtc.c_name,mti.in_name,mto.o_name FROM findworkreport f LEFT OUTER JOIN mt_company mtc USING(c_id) LEFT OUTER JOIN mt_industry mti USING(in_cd) LEFT OUTER JOIN mt_occupation mto USING(o_cd) WHERE mtc.c_name LIKE '%$company%' AND mti.in_cd = '$industry' AND mto.o_cd = '$occupation' GROUP BY mtc.c_name;";
        //検索条件なし（全件表示）
    } else {
        // echo "全件表示";
        $query = "SELECT mtc.c_id,mtc.c_name,mti.in_name,mto.o_name FROM findworkreport f LEFT OUTER JOIN mt_company mtc USING(c_id) LEFT OUTER JOIN mt_industry mti USING(in_cd) LEFT OUTER JOIN mt_occupation mto USING(o_cd)  GROUP BY mtc.c_name;";
    }
    // echo $query;
    //検索クエリの実行
    // echo "sql文=",$query;
    $stmt = $dbh->query($query);
    if (!empty($stmt)) {
        $count = $stmt->rowCount();
    }


    //入力フォームで指定した業種・職種をセッションに保持    
    $_SESSION['INDUSTRYCD'] = $industry;
    $_SESSION['OCCUPATIONCD'] = $occupation;
} catch (PDOException $e) {
    // print("データベースの接続に失敗しました".$e->getMessage());
    die();
}

// 接続を閉じる
$dbh = null;

if ($count == 0) {
    unset($_SESSION['COMPANYNAMES']);
    unset($_SESSION['COMPANYADDRESS']);
    unset($_SESSION['COMPANYPOST']);
    unset($_SESSION['COMPANYTEL']);
    unset($_SESSION['COMPANYMAIL']);
    unset($_SESSION['COMPANYSECTION']);
}

?>

<?php  ?>

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
    <link rel="stylesheet" type="text/css" href="css/searchResult_mb.css">
    <title>検索結果</title>
</head>

<body>
    <header>
        <div class="headwrrap">
            <div class="flex h_textarea">
                <a href="search_mb.php" class="backimg"><img src="img/back_mb.png" alt="back"></a>
                <p class="h_text">検索結果</p>
            </div>
        </div>
    </header>
    <section class="main">

        <form action="searchResult.php" method="get">
            <div class="text">
                <?php if ($count != 0) { ?>
                    <?php foreach ($stmt as $row) { ?>
                        <p class="panel"><a href="readStudentInfo_mb.php?c_id=<?= $row["c_id"] ?> &c_name= <?= $row["c_name"] ?>"><?= $row["c_name"] ?></a></p>
                    <?php } ?>
                <?php } else { ?>
                    <h3>検索結果が見つかりませんでした。</h3>
                    <p id="notbtn" for="back"><a href="./search_mb.php" id="back" class="btn">戻る</a></p>
                <?php } ?>
            </div>
        </form>
        <footer>
            <div class="footerwrrap">
                <p class="icon">
                    <a href="search_mb.php"><img src="img/search.png" alt=""></a>
                </p>
                <p class="icon">
                    <a href="favoriteCompany_mb.php?pass=searchResult_mb.php"><img src="img/company.png" alt=""></a>
                </p>
            </div>
            <div class="footertext">
                <p class="icontext">検索</p>
                <p class="icontext">検討リスト</p>
            </div>
        </footer>
    </section>
</body>

</html>