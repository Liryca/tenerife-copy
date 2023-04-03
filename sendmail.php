 <?php
 
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

if (!error_get_last()) {

    // Переменные, которые отправляет пользователь
    $name = $_POST['name'] ;
    $email = $_POST['email'];
    $phone = $_POST['phone'];
 
    // Формирование самого письма
    $title = "Получить программу путешествия";
    $body = "
    <h1>Письмо с сайта Tenerife</h1>
	<h2>Контактные данные</h2>
    <b>Имя:</b> $name<br>
    <b>Почта:</b> $email<br><br>
	<b>Phone:</b> $phone<br><br>
    ";
    
    // Настройки PHPMailer
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    //$mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['data']['debug'][] = $str;};
    
    // Настройки вашей почты

    $mail->Host = 'smtp.gmail.com'; // SMTP сервер
	$mail->SMTPSecure = 'ssl'; // шифрование
	$mail->Port = 465; // Порт
    $mail->Username   = 'nikonorova6666'; // Логин на почте
    $mail->Password   = 'dudbhkxmhsncgpyf'; // Пароль на почте
    $mail->setFrom('nikonorova6666@gmail.com', 'Anna'); // Адрес самой почты и имя отправителя
    
    // Получатель письма
    $mail->addAddress('agalunia71@gmail.com'); 


    // Отправка сообщения
    $mail->isHTML(true);
    $mail->Subject = $title;
    $mail->Body = $body;    
    
    // Проверяем отправленность сообщения
    if ($mail->send()){
        $data['result'] = "success";
        $data['info'] = "Сообщение успешно отправлено!";
    } else {
        $data['result'] = "error";
        $data['info'] = "Сообщение не было отправлено. Ошибка при отправке письма";
        $data['desc'] = "Причина ошибки: {$mail->ErrorInfo}";
    }
    
} else {
    $data['result'] = "error";
    $data['info'] = "В коде присутствует ошибка";
    $data['desc'] = error_get_last();
}

// Отправка результата
header('Content-Type: application/json');
echo json_encode($data);




	// $mail = new PHPMailer(true);
	// $mail->CharSet = 'UTF-8';
	// $mail->setLanguage('ru', 'phpmailer/language/');
	// $mail->IsHTML(true);
	// $mail->SMTPDebug = 2;

    // $mail->Host = ‘smtp.gmail.com’; // SMTP сервер
	// $mail->SMTPSecure = ‘ssl’; // шифрование
	// $mail->Port = 465; // Порт
    // $mail->Username   = 'nikonorova6666'; // Логин на почте
    // $mail->Password   = 'dudbhkxmhsncgpyf'; // Пароль на почте
    // $mail->setFrom('nikonorova6666@gmail.com', 'Anna'); // Адрес самой почты и имя отправителя
	// $mail->addAddress('tarasavahanna@gmail.com')


    // $mail->Subject = 'Получить программу путешествия';
    // $mail->Body = '<h1>Письмо с сайта Tenerife</h1>';  



	// if(trim(!empty($_POST['name']))){
	// 	$body.='<p><strong>Имя:</strong> '.$_POST['name'].'</p>';
	// }
	// if(trim(!empty($_POST['phone']))){
	// 	$body.='<p><strong>Email:</strong> '.$_POST['import'].'</p>';
	// }

	// if(trim(!empty($_POST['email']))){
	// 	$body.='<p><strong>E-mail:</strong> '.$_POST['email'].'</p>';
	// }

	// $mail->Body = $body;
	// //Отправляем
	// if (!$mail->send()) {
	// 	$message = 'Ошибка';
	// } else {
	// 	$message = 'Данные отправлены!';
	// }
	// $response = ['message' => $message];
	// header('Content-type: application/json');
	// echo json_encode($response);
 ?>