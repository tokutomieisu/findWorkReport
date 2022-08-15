<?php ?>
<?php 
mb_language("Japanese");
mb_internal_encoding("UTF-8");
// 受信者
$to = "tokutomi.eisu@gmail.com";
// タイトル
$subject = "新規企業について";
// 本文
$message = "Hello!\r\nThis is TEST MAIL.";
// ヘッダー
$headers = "From: from@gmial.com";

if (mb_send_mail($to, $subject, $message, $headers)) {
    echo "メールを送信しました";
} else {
    echo "メールの送信に失敗しました";
}
?>

