
<?php 
    $site = 'EFON';
    $name = $_POST['name'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $plans = $_POST['plans'];
// Файлы phpmailer
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

// Формирование самого письма
$title = "Application from the website";
$body = "
<b>Name:</b> $name<br>
<b>E-mail:</b> $email<br>
<b>Phone:</b> $tel<br>
<b>Plans select:</b> $plans<br>
";
// Настройки PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    //$mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

    $mail->Host       = 'smtp.mail.ru'; 
    $mail->Username   = 'ltd.world@mail.ru'; 
    $mail->Password   = 'eu9pz7xkFx3Zv9dHvNbK';
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('ltd.world@mail.ru', 'EFON'); 
    // Получатель письма 
    $mail->addAddress('hi@efon.ae'); 
    
// Отправка сообщения
$mail->isHTML(true);
$mail->Subject = $title;
$mail->Body = $body;    

// Проверяем отравленность сообщения
if ($mail->send()) {$result = "success";} 
else {$result = "error";}

} catch (Exception $e) {
    $result = "error";
    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}

// Отображение результата
echo json_encode(["result" => $result, "resultfile" => $rfile, "status" => $status]);

if ($sendToTelegram) {$result = "success";} 
else {$result = "error";}
?>