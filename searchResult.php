<?php
//セッション開始
session_start();
// $_SESSION['USERNAME'] = "大阪 春子";
$userName = $_SESSION['USERNAME'];
$select =  $_SESSION['SELECT'];
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
// echo $industry."2<br>";
// echo $occupation."2<br>";



// echo "occupation:" . $occupation, "　";

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
    // echo "接続成功　sc=" . $sc . "　";

    //検索条件にあったSQL文作成
    if ($select == "read") {
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
        // echo "<br>" . $sc;

        //検索条件指定表示用クエリの実行
        if ($industry !== "") {
            $in_sql = "SELECT * FROM mt_industry WHERE in_cd = '$industry';";
            // echo "sql文=",$in_sql;
            $in_stmt = $dbh->query($in_sql);
        }
        if ($occupation !== "") {
            $o_sql = "SELECT * FROM mt_occupation WHERE o_cd = '$occupation';";
            // echo "sql文=",$o_sql;
            $o_stmt = $dbh->query($o_sql);
        }

        //検索条件指定表示内容
        if (!empty($in_stmt)) {
            foreach ($in_stmt as $row) {
                $in_name = $row["in_name"];
                // echo "　in_name = " . $in_name;
            }
        } else {
            $in_name = "指定なし";
            // echo "　in_name =" . $in_name;
        }
        if (!empty($o_stmt)) {
            foreach ($o_stmt as $row) {
                $o_name = $row["o_name"];
                // echo "o_name = " . $o_name;
            }
        } else {
            $o_name = "指定なし";
            // echo "　o_name =" . $o_name;
        }

        //入力フォームで指定した業種・職種をセッションに保持    
        $_SESSION['INDUSTRYCD'] = $industry;
        $_SESSION['INDUSTRYNAME'] = $in_name;
        $_SESSION['OCCUPATIONCD'] = $occupation;
        $_SESSION['OCCUPATIONNAME'] = $o_name;
    } else {
        $query = "SELECT * FROM mt_company WHERE c_name LIKE '%$company%' ;";
        //検索クエリの実行
        // echo "sql文=", $query;
        $stmt = $dbh->query($query);
        if (!empty($stmt)) {
            $count = $stmt->rowCount();
        }
        // echo "　" . $count . "件SELECTしました。";
    }
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

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/button.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/backImg.css">
    <link rel="stylesheet" type="text/css" href="css/searchNotFound.css">
    <link rel="stylesheet" type="text/css" href="css/test_search.css">
    <link rel="stylesheet" type="text/css" href="css/readStudentInfo.css">
    <?php
    if ($count == 0) {
        echo "<title>検索失敗</title>";
    } else {
        echo "<title>検索結果</title>";
    }
    ?>
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
    <?php if ($select == "read") { ?>
        <a href="./search.php?select=read" class="backimg"><img src="img/back.png" alt="back"></a>
    <?php } else { ?>
        <a href="./search.php?select=record" class="backimg"><img src="img/back.png" alt="back"></a>
    <?php } ?>
    <section class="main">
        <!-- <form action = "companyTop.php" method = "get"> -->
        <div class="text_mb">
            <h1>検索結果</h1>
            <?php
            // echo "sc=",$sc,"<br>sql文=",$query,"<br>検索結果件数=",$count,"<br>";
            if ($count == 0) {
                echo "<P id=\"noFound\">検索結果がありません</P>";
            } else {
                if ($sc == 0) {
                    echo "<h2>検索条件が指定されていないので全件表示します</h2>";
                } else {
                    echo "<h2><検索条件>　", "企業名：";
                    if ($company == "") {
                        echo "指定なし";
                    } else {
                        echo $company;
                    }
                    if ($select == "read") {
                        echo "　業種：" . $in_name . "　職種：" . $o_name;
                    }
                    echo "</h2>";
                }

                if (!empty($stmt)) {
                    if ($select == "read") {
                        foreach ($stmt as $row) {
                            //データベースのフィールド名で出力する
                            echo "<div class= \"area\">";
                            echo "<a href=\"readStudentInfo.php?c_id=" . $row["c_id"], "&c_name=" . $row["c_name"] . "\" class=\"btn_a\">";
                            echo $row["c_name"];
                            echo "</a>";
                            echo "</div>";
                        }
                    } else {
                        foreach ($stmt as $row) {
                            //データベースのフィールド名で出力する
                            echo "<div class= \"area\">";
                            echo "<a href=\"recodeTop.php?c_id=" . $row["c_id"], "&c_name=" . $row["c_name"] . "\" class=\"btn_a\">";
                            echo $row["c_name"];
                            echo "</a>";
                            echo "</div>";
                        }
                    }
                }
            }
            //検索結果がなかった場合の処理
            if ($count == 0) {
                echo "<p><a class=\"btn\" href=\"newCompany.php\" class=\"button\">新規登録</a></p>";
            } else if ($select == "record") { //記録で検索結果に記録したい企業がなかった場合の処理
                echo "<h2><br>検索条件に登録したい企業がない場合は新規登録してください。<br></h2>";
                echo "<p><a class=\"btn\" href=\"newCompany.php\" class=\"button\">新規登録</a></p>";
                // <p><button type="submit" name="login" id="btn" class="btn" class="button" value="send" disabled>OK</button></p
                // }else{
                //     echo "<a class=\"btn\" href=\"login.jsp\" class=\"button\">決定</a>";
                // echo "<input type=\"submit\" name=\"sb\" value=\"決定\" class=\"btn\">";
            }
            ?>
        </div>
        <!-- </form> -->
    </section>
</body>

</html>