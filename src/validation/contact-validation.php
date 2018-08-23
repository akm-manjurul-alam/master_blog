<?php
require_once "valid-email.php";
require_once "no-html.php";
require_once "char-validation.php";
require_once "send-mail.php";

header('Content-Type: application/json');
if (!$_POST['fullname'] || !$_POST['emailadresse'] || !$_POST['phone'] || !$_POST['desk']) {
    header('Location: /');
    return;
}

if ($_SERVER['SERVER_NAME'] !== 'coworking.pixolith.test' && $_SERVER['SERVER_NAME'] !== 'coworking.pixolith.de') {
    return;
}

$fullname = $_POST['fullname'];
$emailadresse = $_POST['emailadresse'];
$phone = $_POST['phone'];
$msg = $_POST['msg'];
$radio_value = $_POST['desk'];
$trap = isset($_POST['trap']) ? $_POST['trap'] : false;
$char_test = $fullname . "" . $emailadresse . "" . $phone . "" . $msg;

$response = array(
    'honeypotTriggered' => $trap,
    'success' => false,
    'sent' => false,
);

if (charValidation($char_test) && validEmail($emailadresse) && noHtmlPhp($char_test) && !$trap && $radio_value) {
    $response['success'] = true;

    try {
        sendMail($fullname, $emailadresse, $phone, $msg, $radio_value);
        $response['sent'] = true;
    } catch (Exception $e) {
        throw new $e->getMessage();
        header("HTTP/1.1 500 Internal Server Error");
        $response['error'] = $e->getMessage();
        echo json_encode($response);

        return;
    }

    $response['sent'] = true;
    header("HTTP/1.1 200 Ok");
    echo json_encode($response);

    return;
} else {
    header("HTTP/1.1 400 Bad Request");
    $response['error'] = true;
    echo json_encode($response);

    return;
}
