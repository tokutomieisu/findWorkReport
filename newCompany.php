<?php
session_start();            //セッション開始＆必要な変数

$userName = $_SESSION['USERNAME'];

$companyName = $_SESSION['COMPANYNAME'];


if (empty($_SESSION['COMPANYADDRESS'])) {
    $companyNames = "";        //初回を想定  
    $companyPost = "";
    $companyAddress = "";
    $companyTel = "";
    $companyMail = "";
    $companySection = "";
} else {
    $companyNames = $_SESSION['COMPANYNAMES'];      //確認ページから戻ってきたときに受け取る用
    $companyPost = $_SESSION['COMPANYPOST'];
    $companyAddress = $_SESSION['COMPANYADDRESS'];
    $companyTel = $_SESSION['COMPANYTEL'];
    $companyMail = $_SESSION['COMPANYMAIL'];
    $companySection = $_SESSION['COMPANYSECTION'];
}

// if (is_null($returnCompanyName)) {
//     $returnCompanyName = $companyName;       //初回は前ページから受け取った企業名を代入、戻ってきたら入力した値
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/button.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/backImg.css">
    <link rel="stylesheet" type="text/css" href="css/newCompany.css">
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
    <a href="searchResult.php" class="backimg"><img src="img/back.png" alt="back"></a>
    <section class="main">
        <form action="newCompanyRegist.php" method="post">
            <div class="text">
                <h1>企業の新規登録</h1>
                <div class="company">
                    <p>企業名：</p>
                    <input type="text" name="companyName" id="textid" value="<?php if (isset($companyName)) {
                                                                                    echo $companyName;
                                                                                } ?>" placeholder="株式会社HALシステムズ" id="" required>
                </div>
                <div class="company">
                    <p>略称企業名：</p>
                    <input type="text" name="companyNames" value="<?php if (isset($companyNames)) {
                                                                        echo $companyNames;
                                                                    } ?>" placeholder="（株）HALシステムズ" id="">
                </div>
                <div class="company">
                    <p>郵便番号：</p>
                    <input type="text" name="companyPost" value="<?php if (isset($companyPost)) {
                                                                        echo $companyPost;
                                                                    } ?>" placeholder="6011111（半角数字7桁）" id="">
                </div>
                <div class="company">
                    <p>住&emsp;所：</p>
                    <input type="text" name="companyAddress" id="textaddress" value="<?php if (isset($companyAddress)) {
                                                                                            echo $companyAddress;
                                                                                        } ?>" placeholder="大阪府大阪市北区梅田〇－〇－〇" id="">
                </div>
                <div class="company">
                    <p>電話番号：</p>
                    <input type="text" name="companyTel" value="<?php if (isset($companyTel)) {
                                                                    echo $companyTel;
                                                                } ?>" placeholder="0123456789（半角数字10,11桁）" id="">
                </div>
                <div class="company">
                    <p>メールアドレス：</p>
                    <input type="text" name="companyMail" value="<?php if (isset($companyMail)) {
                                                                        echo $companyMail;
                                                                    } ?>" placeholder="abc@hal.co.jp" id="">
                </div>
                <div class="company">
                    <p>採用課窓口：</p>
                    <input type="text" name="companySection" value="<?php if (isset($companySection)) {
                                                                        echo $companySection;
                                                                    } ?>" placeholder="人事部採用課" id="">
                </div>
                <!-- <table border="1">
                        <tr>
                            <th>企業名</th>
                            <td><input type="text" name="companyName" value="<?php if (isset($companyName)) {
                                                                                    echo $companyName;
                                                                                } ?>" placeholder="株式会社HALシステムズ" id="" required></td>
                        </tr>
                        <tr>
                            <th>略称企業名</th>
                            <td><input type="text" name="companyNames" value="<?php if (isset($companyNames)) {
                                                                                    echo $companyNames;
                                                                                } ?>" placeholder="（株）HALシステムズ" id="" required></td>
                        </tr>
                        <tr>
                            <th>郵便番号</th>
                            <td><input type="text" name="companyPost" pattern="\d{7}" title="半角数字7桁でご入力ください。" value="<?php if (isset($companyPost)) {
                                                                                                                            echo $companyPost;
                                                                                                                        } ?>" placeholder="6011111（半角数字7桁）" id="" required></td>
                        </tr>
                        <tr>
                            <th>住所</th>
                            <td><input type="text" name="companyAddress" value="<?php if (isset($companyAddress)) {
                                                                                    echo $companyAddress;
                                                                                } ?>" placeholder="大阪府大阪市北区梅田〇－〇－〇" id="" required></td>
                        </tr>
                        <tr>
                            <th>電話番号</th>
                            <td><input type="tel" name="companyTel" pattern="\d{10,11}" value="<?php if (isset($companyTel)) {
                                                                                                    echo $companyTel;
                                                                                                } ?>" placeholder="0123456789（半角数字10,11桁）" 　 id="" required></td>
                        </tr>

                        <tr>
                            <th>メールアドレス</th>
                            <td><input type="email" name="companyMail" value="<?php if (isset($companyMail)) {
                                                                                    echo $companyMail;
                                                                                } ?>" placeholder="abc@hal.co.jp" id="" required></td>
                        </tr>
                        <tr>
                            <th>採用課窓口</th>
                            <td><input type="text" name="companySection" value="<?php if (isset($companySection)) {
                                                                                    echo $companySection;
                                                                                } ?>" placeholder="人事部採用課" id="" required></td>
                        </tr>
                    </table> -->
            </div>
            <p><button type="submit" name="sb" id="btn" class="btn" class="button" value="send">次へ</button></p>
        </form>
    </section>
    <script src="./js/button_able.js"></script>
</body>

</html>