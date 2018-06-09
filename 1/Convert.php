<?php
require_once 'autoload.php';
$Autoload = new Autoload();
$API = new Requests\API();
$Ex = new Currency\Exchange($API);


$response['result'] = 'null';
$response['error'] = 'Invalid argument list';
if(isset($_GET['currency']) AND isset($_GET['original_value'])) {
    $response['result'] = array();
    try {
        $response['result']['value'] = $Ex->Convert($_GET['original_value'], $_GET['currency']);
    $response['result']['from'] = 'USD';
    $response['result']['to'] = $_GET['currency'];
    $response['result']['original_value'] = $_GET['original_value'];
    $response['error'] = 0;
    }
    catch (Exception $e) {
        $response['error'] = $e;
        $response['result'] = 0;
    }
}

echo json_encode($response);

