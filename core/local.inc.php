<?php 


function render_locais(){
    global $db;
    $sql = "SELECT id, descricao FROM local";
    if ($result = $db->query($sql)) {

        while ($row = $result->fetch_assoc()) {

            ?>
                
                    <section class="local option">
                        <a href="?local=<?= $row["id"] ?>"> 
                            <?= $row["descricao"]?>
                        </a>
                    </section>
               
            <?php
        }

        $result->close();
    }    
}

if (isset($_GET['local']) && !isset($_SESSION['local.descricao'])){
    $id = (int) $_GET['local'];
    $sql = "SELECT id, descricao FROM local WHERE id = $id" ;
    $result = $db->query($sql);
    while ($row = $result->fetch_assoc()) {
        $_SESSION['local.id'] = $row['id'];
        $_SESSION['local.descricao'] = $row['descricao'];        
    }
}
if (!isset($_GET['local'])){
    unset($_SESSION['local.id']);    
    unset($_SESSION['local.descricao']);    
}