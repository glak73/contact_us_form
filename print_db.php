<?php
require 'connect.php';

$reviews_output = $pdo->prepare("SELECT * FROM review_list");
$reviews_output->execute();
while ($result = $reviews_output->fetch(PDO::FETCH_ASSOC)) {
    $rewiews_array[] = $result;
}
require 'output.html';



