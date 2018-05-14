<?php

    $conn = require 'dbconn.php';
    
    $sql='
        SELECT fornavn, etternavn, epost, tlf, fødselsdato FROM skjema ORDER BY timestamp DESC
    ';
    $result = mysqli_query($conn,$sql);
    
    $entries = array();
    while($row = mysqli_fetch_assoc($result)) {
        array_push($entries, $row);
    }

    mysqli_close($conn);
    
    echo json_encode($entries, JSON_PRETTY_PRINT);

?>