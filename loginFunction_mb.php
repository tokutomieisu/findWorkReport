<?php
session_start();
$uId = $_POST['id'];
$uPass = $_POST['pass'];

//両方入力されてないとき
if (empty($uId) && empty($uPass)) {
    $msg = "IDとパスワードを入力してください。";
}

//ID入力されてないとき
if (empty($uId) && !empty($uPass)) {
    $msg = "IDを入力してください。";
}

//PASS入力されてないとき
if (!empty($uId) && empty($uPass)) {
    $msg = "パスワードを入力してください。";
}

//両方入力されている時
if (!empty($uId) && !empty($uPass)) {
    $dsn = "mysql:host=localhost; dbname=db26; charset=utf8";
    $username = 'root';
    $password = '';

    try {
        $dbh = new PDO($dsn, $username, $password);

        $sql = "SELECT * FROM mt_student WHERE no = '$uId' AND pass = '$uPass'";
        $stmt = $dbh->query($sql);
        $count = $stmt->rowCount();
    } catch (PDOException $e) {
        $msg = $e->getMessage();
    }


    // 接続を閉じる
    $dbh = null;


    if ($count == 0) {
        $msg = "入力情報が違います。";
    } else {
        foreach ($stmt as $row) {
            $_SESSION['USERID'] = $row['student_id'];
            $_SESSION['USERNO'] = $row['no'];
            $_SESSION['USERNAME'] = $row['name'];
            header('Location: ./search_mb.php');
            exit();     //以後の処理をしない
        }
    }
}
?>

<!-- 内容が違うときのみ表示(合ってたらexitでその先の処理がされないため)-->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/button.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <title>トップページ</title>
</head>

<body>
    <div class="text">
        <h1><?php echo $msg; ?></h1> <!-- エラー内容-->
    </div>
    <p><button type="button" class="btn" class="button" onclick="location.href='login_mb.php'">戻る</button></p>
</body>

</html>