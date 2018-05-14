<?php

$phonebook = array(
    '41235986',
    '41235987',
    '41235886',
    '41225986',
    '49235986',
    '92347637',
    '92347834',
    '92337634',
    '98347634',
    '92377634'
);

if(isset($_POST['fn'], $_POST['en'], $_POST['tlf'], $_POST['fd'])) {
    $conn = require 'dbconn.php';
    
    $ep = mysqli_real_escape_string($conn, $_POST['ep']);
    $fn = mysqli_real_escape_string($conn, $_POST['fn']);
    $en = mysqli_real_escape_string($conn, $_POST['en']);
    $tlf = mysqli_real_escape_string($conn, $_POST['tlf']);
    $fd = mysqli_real_escape_string($conn, $_POST['fd']);

    $err;

    try {
        if(isset($_POST['ep']) && !empty($_POST['ep'])){
            if(!filter_var(trim($ep), FILTER_VALIDATE_EMAIL)){
                throw new Exception("Ugyldig format på e-post", 1);
            }
        } else {
            $ep = null;
        }
    } catch (Exception $e){
        $err[] = array(
            'error' => array(
                'msg' => $e->getMessage(),
                'code' => $e->getCode(),
            ),
        );
    }
    try {
        if(!preg_match('/^([49])([0-9]{7})$/', trim($tlf))){
            throw new Exception('Ugyldig telefonnummer', 2);
        } elseif (!in_array($tlf, $phonebook)) {
            throw new Exception('Telefonnummer ikke i telefonlisten', 5);
        }
    } catch (Exception $e){
        $err[] = array(
            'error' => array(
                'msg' => $e->getMessage(),
                'code' => $e->getCode(),
            ),
        );
    }
    try {
        if(!preg_match('/^(0[0-9]|[12][0-9]|3[01])-(0[0-9]|1[012])-([0-9]{4})$/', trim($fd))) {
            throw new Exception('Ugyldig fødselsdato', 3);
        } elseif (time() < strtotime('+16 years', strtotime($fd))) {
            throw new Exception('Du er for ung', 4);
        }
    } catch (Exception $e){
        $err[] = array(
            'error' => array(
                'msg' => $e->getMessage(),
                'code' => $e->getCode(),
            ),
        );
    }
    if(!empty($err)){
        echo json_encode($err, JSON_PRETTY_PRINT);
        return;
    }
    
    $sql="
        INSERT INTO skjema (fornavn, etternavn, epost, tlf, fødselsdato)
        VALUES ('$fn', '$en', '$ep', '$tlf', STR_TO_DATE('$fd', '%d-%m-%Y'))
    ";
    
    mysqli_query($conn,$sql);
    mysqli_close($conn);
}

?>