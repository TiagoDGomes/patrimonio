<?php

if (isset($_GET['registro_id'])){ 
    $sql = "DELETE FROM registro WHERE id = ? AND idpessoa = ?";
    $stmt2 = $db->prepare($sql);    
    $stmt2->bind_param('ii', $_GET['registro_id'], $_SESSION['pessoa.id']);
    $res = $stmt2->execute();   
    header('Location: ./?local=' . (int) $_GET['local'] . '&setor=' . (int) $_GET['setor'] . '&apagar_registro=1');
    exit;
} 