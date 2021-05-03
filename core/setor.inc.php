<?php

function render_setores(){
    global $db;
    $sql = "SELECT id, idlocal, descricao FROM setor WHERE idlocal = " . (int) $_GET['local'] . ' ORDER BY descricao';
    if ($result = $db->query($sql)) {

        while ($row = $result->fetch_assoc()) {
            ?>
                
                <section class="setor option">
                    <a href="?local=<?= $row["idlocal"] ?>&setor=<?= $row["id"] ?>"> 
                        <?= $row["descricao"]?>
                    </a>
                </section>
               
            <?php
        }

        $result->close();

    }   
    ?>
        <section class="setor option">
            <form action="?local=<?=  (int) $_GET['local'] ?>" method="post">
                <input type="text" name="setor_descricao">&nbsp;<input type="submit" value="Salvar">
            </form>
        </section> 
    <?php
}


if (isset($_POST['setor_descricao']) && isset($_GET['local'])){    

    $sql = "INSERT INTO setor (idlocal, descricao) VALUES (?, ?)";
    $stmt2 = $db->prepare($sql);
    $stmt2->bind_param('is', $_GET['local'], $_POST['setor_descricao']);
    $stmt2->execute();
    $stmt2->close();

    $sql = "SELECT max(id) as idmax FROM setor";
    if ($result = $db->query($sql)) {
        $row = $result->fetch_assoc();
        header("Location: ?local=" . (int) $_GET['local'] . "&setor=" . $row['idmax']);        
    }
    exit();
}

if (isset($_GET['setor']) && isset($_GET['local'])){  

    $sql = "SELECT * FROM setor WHERE id = " .  (int) $_GET['setor'];
    if ($result = $db->query($sql)) {
        while ($row = $result->fetch_assoc()) {
            $_SESSION['setor.descricao'] = $row['descricao'];       
        }
    }
}  