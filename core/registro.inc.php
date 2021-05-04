<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['numero']) && isset($_POST['setor']) && isset($_POST['local'])){  

    $sql = "SELECT numero FROM registro WHERE YEAR(datahora) = YEAR(NOW()) AND MONTH(datahora) = MONTH(NOW()) AND numero = " . (int) $_POST['numero'];
    if ($result = $db->query($sql)) { 
        if (!($row = $result->fetch_assoc())) {

            include_once 'resize.inc.php';

            $uploaddir = __DIR__ . "/../fotos/";

            $filename = store_uploaded_image('foto', $uploaddir, 1200,(int) $_POST['numero'] . "__");



            $sql = "INSERT INTO registro (numero, descricao, idsetor, idpessoa, foto) VALUES (?, ?, ?, ?, ?)";
            $stmt2 = $db->prepare($sql);
            $filename = basename($_FILES['foto']['name']);
            $stmt2->bind_param('ssiis', $_POST['numero'], $_POST['descricao'], $_POST['setor'], $_SESSION['pessoa.id'], $filename);
            $stmt2->execute();
            $stmt2->close();
            
            header('Location: ?local=' . $_POST['local'] . '&setor=' . $_POST['setor'] . '&salvo=1'); 

        
        } else {
            header('Location: ?local=' . $_POST['local'] . '&setor=' . $_POST['setor'] . '&repetido=1');        
            //var_dump($sql);
        }
    } else {
        header('Location: ?local=' . $_POST['local'] . '&setor=' . $_POST['setor'] . '&erro=1');       
        
    }
    exit;
}

function render_registros(){
    global $db;
    $setor = (int) $_GET['setor'];
    $sql = "SELECT * FROM registro WHERE YEAR(datahora) = year(now()) AND idsetor = $setor ORDER BY datahora DESC";
    if ($result = $db->query($sql)) {

        while ($row = $result->fetch_assoc()) {

            ?>                
                    <section class="item option"> 
                        <span class="foto">
                            <?php $file_image = $row["numero"]. "__" . $row["foto"]; ?>
                            <?php $foto = __DIR__.'/../fotos/'.  $file_image; ?>                           

                            <?php if ($row["foto"] && file_exists($foto) ): ?>
                                <a target="_blank" href="./fotos/<?= $file_image?>">
                                    <img src="./fotos/<?= $file_image ?>">
                                </a>
                            <?php endif; ?>

                        </span>               

                        <span class="numero"><?= $row["numero"]?></span>
                        <span class="descricao"><?= $row["descricao"]?></span>
                        <br>
                        <small class="data"><?= $row["datahora"]?></small>
                        <?php if ($row["idpessoa"] == $_SESSION['pessoa.id']): ?>     
                            <small class="apagar">
                                <a href="apagar.php?registro_id=<?= $row["id"] ?>&local=<?= (int) $_GET['local'] ?>&setor=<?= (int) $_GET['setor'] ?>">Apagar</a>
                            </small>  
                        <?php endif; ?>     
                    </section>
               
            <?php
        }

        $result->close();
    }    
}


        