<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['name']) ? strip_tags(trim($_POST['name'])) : '';
    $phone = isset($_POST['phone']) ? strip_tags(trim($_POST['phone'])) : '';

    if (empty($name) || empty($phone)) {
        http_response_code(400);
        echo "Пожалуйста, заполните все поля.";
        exit;
    }

    // Email для получения заявок
    $recipient = "761431@bk.ru";
    $subject = "Новая заявка с сайта МЕТАЛЛОБАЗА 73";
    
    $content = "Новая заявка на обратный звонок!\n\n";
    $content .= "Имя: $name\n";
    $content .= "Телефон: $phone\n";
    
    // Заголовки письма
    $headers = "From: noreply@".$_SERVER['HTTP_HOST']."\r\n";
    $headers .= "Reply-To: $recipient\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    if (mail($recipient, $subject, $content, $headers)) {
        http_response_code(200);
        echo "Заявка успешно отправлена.";
    } else {
        http_response_code(500);
        echo "Ошибка отправки.";
    }
} else {
    http_response_code(403);
    echo "Доступ запрещен.";
}
?>
