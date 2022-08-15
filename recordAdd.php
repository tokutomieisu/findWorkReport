<?php


session_start();


$dsn     = 'mysql:host=localhost;dbname=db26;charset=utf8';
$user     = 'root';
$password = '';
$userName = $_SESSION['USERNAME'];
// $_SESSION['USERID'] = "202112345";
$userId = $_SESSION['USERID'];
// $_SESSION['COMPANYID'] = "co00001";
$c_id = $_SESSION['COMPANYID'];
// $_SESSION['ACTIVE'] = "その他";
$active = $_SESSION['ACTIVE'];
$in_cd = $_SESSION['INDUSTRY'];
$o_cd = $_SESSION['OCCUPATION'];
// $_SESSION['PLACE'] = "対面";
$place = $_SESSION['PLACE'];
// $_SESSION['DAY'] = "2022-06-23";
$day = $_SESSION['DAY'];
$property = $_SESSION['PROPERTY'];
$flow = $_SESSION['FLOW'];
// var_dump($flow);
// $property = array("筆記用具", "履歴書", "卒業見込証明書");



// DBへ接続
try {
    $dbh = new PDO($dsn, $user, $password);

    // 接続を閉じる
    // $dbh = null;
} catch (PDOException $e) {
    print("データベースの接続に失敗しました" . $e->getMessage());
    die();
}

// クエリの実行
$query = "SELECT DISTINCT id FROM affiliation  WHERE student_id = $userId;";
$stmt = $dbh->query($query);

$val = $stmt->fetch();
//2
$af_id = $val['id'];

if ($active == "説明会") {
    $a_cd = "1";
} else if ($active == "試験") {
    $a_cd = "2";
} else if ($active == "面接") {
    $a_cd = "3";
} else if ($active == "その他") {
    $a_cd = "4";
}

if ($place == "対面") {
    $v_cd = "1";
} else {
    $v_cd = "2";
}




if (!$stmt) {
    // echo "select失敗";
} else {

    // クエリの実行
    $query2 = "INSERT INTO findworkreport (af_id,c_id,a_cd,in_cd,o_cd,v_cd,day) VALUES(?,?,?,?,?,?,?);";
    $stmt2 = $dbh->prepare($query2);
    $stmt2->bindParam(1, $af_id, PDO::PARAM_INT);
    $stmt2->bindParam(2, $c_id);
    $stmt2->bindParam(3, $a_cd);
    // $stmt2->bindParam(4, $in_cd, PDO::PARAM_NULL);
    // $stmt2->bindParam(5, $o_cd, PDO::PARAM_NULL);
    $stmt2->bindParam(4, $in_cd);
    $stmt2->bindParam(5, $o_cd);
    $stmt2->bindParam(6, $v_cd);
    $stmt2->bindParam(7, $day);

    //true or falseを返す
    $insertCheck = $stmt2->execute();



    $j_id = $dbh->lastInsertId();

    if ($insertCheck) {
        /**
         * 1.classification
         * 2.place
         * 3.i_num
         * 4.remarks
         * 5.j_id
         */
        if ($property[0] != "") {
            for ($p = 0; $p < count($property); $p++) {
                if ($property[$p] == "筆記用具") {
                    $p_id = 1;
                } else if ($property[$p] == "履歴書") {
                    $p_id = 2;
                } else if ($property[$p] == "健康診断書") {
                    $p_id = 3;
                } else if ($property[$p] == "成績卒見") {
                    $p_id = 4;
                } else if ($property[$p] == "エントリーシート") {
                    $p_id = 5;
                } else if ($property[$p] == "印鑑") {
                    $p_id = 6;
                } else if ($property[$p] == "作品") {
                    $p_id = 7;
                } else if ($property[$p] == "その他") {
                    $p_id = 8;
                }


                // クエリの実行
                $sqlp = "INSERT INTO report_property (j_id,p_id)VALUES(?,?);";
                $pro = $dbh->prepare($sqlp);
                $pro->bindParam(1, $j_id, PDO::PARAM_INT);
                $pro->bindParam(2, $p_id, PDO::PARAM_INT);

                $insertpro = $pro->execute();

                if ($insertpro) {
                    // echo "登録完了：０";
                } else {
                    // echo "登録失敗：０";
                }
            }
        }

        // $_SESSION['CLASSFICATION2'] = "グループディスカッション";
        $classification = $_SESSION['CLASSFICATION2'];
        // $_SESSION['CLASSIFICATION2_TEXT'] = array("3","志望動機、ガクチカ、部活の遍歴、趣味");
        $classification2_text = $_SESSION['CLASSIFICATION_TEXT'];
        // $_SESSION['THOUGHTS'] = "うぉぉぉぉぉ";
        $thoughts = $_SESSION['THOUGHTS'];
        // var_dump($classification2_text);


        if ($a_cd == "1") {
            if ($classification == "合同") {
                $place = $classification2_text[0];
                $i_num = NULL;
            } else if ($classification == "学内") {
                $place = $classification2_text[1];
                $i_num = NULL;
            } else if ($classification == "学外") {
                $place = NULL;
                $i_num = $classification2_text[2];
            }



            // クエリの実行
            $sql1 = "INSERT INTO information_session (classification,place,i_num,remarks,j_id) VALUES(?,?,?,?,?);";
            $activities1 = $dbh->prepare($sql1);
            $activities1->bindParam(1, $classification);
            if ($place == NULL) {
                $activities1->bindParam(2, $place, PDO::PARAM_NULL);
            } else {
                $activities1->bindParam(2, $place);
            }
            if ($i_num == NULL) {
                $activities1->bindParam(3, $i_num, PDO::PARAM_NULL);
            } else {
                $activities1->bindParam(3, $i_num);
            }

            $activities1->bindParam(4, $thoughts);
            $activities1->bindParam(5, $j_id, PDO::PARAM_INT);

            $insert1 = $activities1->execute();

            $i_id = $dbh->lastInsertId();

            if ($insert1) {
                // echo "登録完了：１";
            } else {
                // echo "登録失敗：１";
            }

            if ($flow[0] != "") {
                for ($f = 0; $f < count($flow); $f++) {
                    if ($flow[$f] == "説明会") {
                        $f_id = 1;
                    } else if ($flow[$f] == "適性検査") {
                        $f_id = 2;
                    } else if ($flow[$f] == "1次面接") {
                        $f_id = 3;
                    } else if ($flow[$f] == "2次面接") {
                        $f_id = 4;
                    } else if ($flow[$f] == "3次面接") {
                        $f_id = 5;
                    } else if ($flow[$f] == "4次面接") {
                        $f_id = 6;
                    } else if ($flow[$f] == "最終面接") {
                        $f_id = 7;
                    }
                    // echo $f_id;
    
    
                    // クエリの実行
                    $sqlf = "INSERT INTO report_flow (i_id,f_id)VALUES(?,?);";
                    $flo = $dbh->prepare($sqlf);
                    $flo->bindParam(1, $i_id, PDO::PARAM_INT);
                    $flo->bindParam(2, $f_id, PDO::PARAM_INT);
    
                    $insertflo = $flo->execute();
    
                    if ($insertflo) {
                        // echo "登録完了：11";
                    } else {
                        // echo "登録失敗：11";
                    }
                }
            }

        } else if ($a_cd == "2") {

            /**
             * classification
             * question
             * theme
             * timerequired
             * wordcount
             * 
             */

            if ($classification == "ES") {
                $question = $classification2_text[0];
                $theme = NULL;
                $timerequired = NULL;
                $wordcount = NULL;
                $contents = NULL;
            } else if ($classification == "作文・小論文") {
                $question = NULL;
                $theme = $classification2_text[1];
                $timerequired = $classification2_text[2];
                $wordcount = $classification2_text[3];
                $contents = NULL;
            } else if ($classification == "筆記") {
                $question = NULL;
                $theme = NULL;
                $timerequired = NULL;
                $wordcount = NULL;
                $contents = $classification2_text[4];
            } else if ($classification == "実技") {
                $question = NULL;
                $theme = NULL;
                $timerequired = NULL;
                $wordcount = NULL;
                $contents = $classification2_text[5];
            }


            // クエリの実行
            $sql2 = "INSERT INTO tests (classification,question,theme,timerequired,wordcount,contents,remarks,j_id)VALUES(?,?,?,?,?,?,?,?);";
            $activities2 = $dbh->prepare($sql2);
            $activities2->bindParam(1, $classification);
            if ($question == NULL) {
                $activities2->bindParam(2, $question, PDO::PARAM_NULL);
            } else {
                $activities2->bindParam(2, $question);
            }
            if ($theme == NULL) {
                $activities2->bindParam(3, $theme, PDO::PARAM_NULL);
            } else {
                $activities2->bindParam(3, $theme);
            }
            if ($timerequired == NULL) {
                $activities2->bindParam(4, $timerequired, PDO::PARAM_NULL);
            } else {
                $activities2->bindParam(4, $timerequired);
            }
            if ($wordcount == NULL) {
                $activities2->bindParam(5, $wordcount, PDO::PARAM_NULL);
            } else {
                $activities2->bindParam(5, $wordcount);
            }
            if ($contents == NULL) {
                $activities2->bindParam(6, $contents, PDO::PARAM_NULL);
            } else {
                $activities2->bindParam(6, $contents);
            }
            $activities2->bindParam(7, $thoughts);
            $activities2->bindParam(8, $j_id, PDO::PARAM_INT);

            $insert2 = $activities2->execute();

            if ($insert2) {
                // echo "登録完了：２";
            } else {
                // echo "登録失敗：２";
            }
        } else if ($a_cd == "3") {

            /**
             * classification
             * interviewer
             * i_name
             * i_num
             * question
             * 
             */

            if ($classification == "個人") {
                $interviewer = $classification2_text[0];
                $i_name =  $classification2_text[1] . "次";
                $i_num = NULL;
                $question = $classification2_text[2];
            } else if ($classification == "集団") {
                $interviewer = $classification2_text[3];
                $i_name = NULL;
                $i_num = $classification2_text[4];
                $question = $classification2_text[5];
            } else if ($classification == "役員") {
                $interviewer = $classification2_text[6];
                $i_name = "最終";
                $i_num = NULL;
                $question = $classification2_text[7];
            }




            // クエリの実行
            $sql3 = "INSERT INTO interview (classification,interviewer,i_name,i_num,question ,remarks,j_id) VALUES(?,?,?,?,?,?,?);";
            $activities3 = $dbh->prepare($sql3);
            $activities3->bindParam(1, $classification);
            $activities3->bindParam(2, $interviewer);
            if ($i_name == NULL) {
                $activities3->bindParam(3, $i_name, PDO::PARAM_NULL);
            } else {
                $activities3->bindParam(3, $i_name);
            }
            if ($i_num == NULL) {
                $activities3->bindParam(4, $i_num, PDO::PARAM_NULL);
            } else {
                $activities3->bindParam(4, $i_num);
            }
            $activities3->bindParam(5, $question);
            $activities3->bindParam(6, $thoughts);
            $activities3->bindParam(7, $j_id, PDO::PARAM_INT);

            $insert3 = $activities3->execute();

            if ($insert3) {
                // echo "登録完了：３";
            } else {
                // echo "登録失敗：３";
            }
        } else if ($a_cd == "4") {

            /**
             * classification
             * o_num
             * contents
             */

            if ($classification == "グループワーク") {
                $o_num = $classification2_text[0];
                $contents =  $classification2_text[1];
            } else if ($classification == "グループディスカッション") {
                $o_num = $classification2_text[2];
                $contents =  $classification2_text[3];
            } else if ($classification == "その他") {
                $o_num = NULL;
                $contents =  $classification2_text[4];
            }

            // クエリの実行
            $sql4 = "INSERT INTO other (classification,o_num ,contents,remarks,j_id) VALUES(?,?,?,?,?);";
            $activities4 = $dbh->prepare($sql4);
            $activities4->bindParam(1, $classification);
            if ($o_num == NULL) {
                $activities4->bindParam(2, $o_num, PDO::PARAM_NULL);
            } else {
                $activities4->bindParam(2, $o_num);
            }
            $activities4->bindParam(3, $contents);
            $activities4->bindParam(4, $thoughts);
            $activities4->bindParam(5, $j_id, PDO::PARAM_INT);

            $insert4 = $activities4->execute();

            if ($insert4) {
                // echo "登録完了：４";
            } else {
                // echo "登録失敗：４";
            }
        }
    }

    $dbh = null;
} ?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>記録</title>
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/button.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/backImg.css">
    <link rel="stylesheet" type="text/css" href="css/recodeTop.css">
</head>

<body>
    <header>
        <div class="headwrrap">
            <div class="flex">
                <p><img src="img/aicon.png" alt="logo"></p>
                <p><?php echo $userName ?>&nbsp;様</p>
            </div>
            <nav>
                <ul>
                    <li><a href="search.php?select=record">企業検索</a>
                    <li class="logout"><a href="index.html">ログアウト</a>
                </ul>
            </nav>
        </div>
    </header>
    <!-- <a href="./companyTop.php" class="backimg"><img src="img/back.png" alt="back"></a> -->
    <section class="main">
        <div class="text">
            <h1>登録が完了しました。</h1>
        </div>
        <a href="select.php" class="btn button">TOPへ戻る</a>
    </section>
    <script src="js/recordToop.js"></script>
</body>

</html>