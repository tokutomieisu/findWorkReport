<?php

// $property = array("筆記用具", "履歴書", "作s品");

// for ($p = 0; $p < count($property); $p++) {
//     if ($property[$p] == "筆記用具") {
//         $property[$p] = 1;
//     } else if ($property[$p] == "履歴書") {
//         $property[$p] = 2;
//     } else if ($property[$p] == "健康診断書") {
//         $property[$p] = 3;
//     } else if ($property[$p] == "成績卒見") {
//         $property[$p] = 4;
//     } else if ($property[$p] == "エントリーシート") {
//         $property[$p] = 5;
//     } else if ($property[$p] == "印鑑") {
//         $property[$p] = 6;
//     } else if ($property[$p] == "作品") {
//         $property[$p] = 7;
//     } else if ($property[$p] == "その他") {
//         $property[$p] = 8;
//     }
// }

// var_dump($property);


//DB接続準備
$dsn    = 'mysql:host=localhost;dbname=db26;charset=utf8';
$user     = 'root';
$password = '';

$jId = 1;
$aId = "1";
// DBへ接続
try {
    $dbh = new PDO($dsn, $user, $password);


        // クエリの実行

        //     $sqlpro = "SELECT  p.name FROM findworkreport AS f INNER JOIN report_property AS fp ON f.j_id = fp.j_id INNER JOIN mt_property AS p ON p.id = fp.p_id WHERE f.j_id = " . $jId . ";";
        // $stmtpro = $dbh->query($sqlpro);
        $sqlflo = "SELECT  fl.name FROM information_session AS f INNER JOIN information_session i ON f.j_id = i.j_id INNER JOIN report_flow AS rf ON i.info_id = rf.i_id INNER JOIN mt_flow AS fl ON rf.f_id = fl.id WHERE f.j_id =" . $jId .";";
        $stmt = $dbh->query($sqlflo);
    
        
    
        // 接続を閉じる(※DBからデータを取得出来た時点で接続を切る)
        $dbh = null;
    } catch (PDOException $e) {
        print("データベースの接続に失敗しました" . $e->getMessage());
        die();
    }
    $val = $stmt->fetchAll();
foreach($val as $date){
echo $date["name"] ."<br>";
}

// for ($p = 0; $p < count($property); $p++) {
//     $propertys = $p != 0 ? $propertys . "," . $property[$p] : $property[$p];
// }
