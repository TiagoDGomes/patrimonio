<?php


if (isset($_POST['codigo']) && isset($_POST['senha'])){
    unset($_SESSION['pessoa.codigo']);
    unset($_SESSION['pessoa.nome']);
    unset($_SESSION['pessoa.id']);
    unset($_SESSION['pessoa.senha']);
    unset($_SESSION['goto']);

    $sql = "SELECT id FROM pessoa WHERE codigo = ?";   
    $stmt = $db->prepare($sql);
    $stmt->bind_param('s', $_POST['codigo']);
    $stmt->execute();
    $stmt->bind_result($id);
    $stmt->fetch();
    $stmt->close();


    $senha_h = hash('tiger192,3', $_POST['senha']);
    if($id !== NULL){ // se ja existe, precisa verificar a senha
            
        
        $sql = "SELECT id, codigo, nome FROM pessoa WHERE codigo = ? AND senha = ?";
        $stmt2 = $db->prepare($sql);
        $stmt2->bind_param('ss', $_POST['codigo'], $senha_h);
        $stmt2->execute();
        $stmt2->bind_result($id, $codigo, $nome);
        $stmt2->fetch();
        $stmt2->close();


        if($codigo !== NULL){ // se validar, registrar sessão
            $_SESSION['pessoa.codigo'] = $codigo;
            $_SESSION['pessoa.nome'] = $nome;
            $_SESSION['pessoa.id'] = $id;
            $_SESSION['goto'] = 'registrar_sessao';
        } else {
            $_SESSION['goto'] = 'senha_invalida';
        }
        

    } else { // senao, cadastrar nome, se houver
        $_SESSION['pessoa.codigo'] = $_POST['codigo'];
        $_SESSION['pessoa.nome'] = NULL;
        $_SESSION['pessoa.senha'] = $_POST['senha'];
        $_SESSION['goto'] = 'cadastrar_novo';
        $cadastrar_novo = TRUE;
        
        $sql = "INSERT INTO pessoa (codigo, senha) VALUES (?, ?)";
        $stmt2 = $db->prepare($sql);
        $stmt2->bind_param('ss', $_POST['codigo'], $senha_h);
        $stmt2->execute();
        $stmt2->close();

        $sql = "SELECT max(id) FROM pessoa";
        $stmt2 = $db->prepare($sql);        
        $stmt2->execute();
        $stmt2->bind_result($id);
        $stmt2->close();

        

    }
}