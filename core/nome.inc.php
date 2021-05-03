<?php 

if (isset($_POST['nome']) && isset($_SESSION['pessoa.senha'])){
    $_SESSION['goto'] = 'update_nome';
    echo("Tem nome");
    $sql = "UPDATE pessoa SET nome = ? WHERE codigo = ?";
    $stmt2 = $db->prepare($sql);
    $stmt2->bind_param('si',$_POST['nome'], $_SESSION['pessoa.codigo']);
    $stmt2->execute();
    $stmt2->fetch();
    $stmt2->close();
    $_SESSION['pessoa.nome'] = $_POST['nome'];
    session_unset();
    session_destroy();
}