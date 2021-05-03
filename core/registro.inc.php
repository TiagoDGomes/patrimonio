<?php

if (isset($_POST['numero']) && isset($_POST['setor']) && isset($_POST['local'])){
    $sql = "INSERT INTO registro (numero, idsetor, idpessoa) VALUES (?, ?, ?)";
    $stmt2 = $db->prepare($sql);
    
    $stmt2->bind_param('sii', $_POST['numero'], $_POST['setor'], $_SESSION['pessoa.id']);
    $stmt2->execute();
    $stmt2->close();
}


        