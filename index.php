<?php
require_once 'connect.php';
 function getExtension1($filename)
{
    return substr(strrchr($filename, '.'), 1);
} 
$first_name = trim($_REQUEST['first_name']);
$personal_data = trim($_REQUEST['personal_data']);
$email = trim($_REQUEST['email']);
$cause = trim($_REQUEST['cause']);
$review = trim($_REQUEST['review']);
 $create = $pdo->prepare("CREATE TABLE IF NOT EXISTS review_list (
    id INT(32) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    first_name VARCHAR(256) NOT NULL,
    cause VARCHAR(11) NOT NULL,
    review VARCHAR(1024),
    personal_data VARCHAR(1) NOT NULL,
    email VARCHAR(128) NOT NULL,
    file VARCHAR(128)
    )");
$create->execute(); 
if (!empty($first_name) && $personal_data == 't' &&  !empty($email) && !($_FILES["userfile"]["error"])) {
    $name = "downloads/" . uniqid();
    $ext = getExtension1($_FILES["userfile"]["name"]); 
    $full_file_name = $name .  "." . $ext;
    move_uploaded_file($_FILES["userfile"]["tmp_name"], $full_file_name);
    $stmt = $pdo->prepare("INSERT INTO review_list (first_name, personal_data, email, cause, review, file) VALUES
    (?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([$first_name, $personal_data, $email, $cause, $review, $full_file_name]);
    echo "Ваше обращение было успешно отправлено";
} else {
    echo ('Ошибка при заполнении формы, проверьте заполнение обязательных(помеченных звёздочкой) полей');
}
require_once 'index.html';
