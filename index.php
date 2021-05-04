<?php include 'core.php';
header('Content-type: text/html; charset=UTF-8'); 
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Patrimônio</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
    
</head>

<body>
    <div id="main">
        <section id="pessoa">
            <span class="descricao"><?= @$_SESSION['pessoa.nome'] ?></span>
            <i class="close"><a href="logout.php">&times</a></i>
        </section>
        <?php if (isset($_SESSION['pessoa.nome'])):  ?>
            <?php require 'core/local.inc.php'; ?>
            <?php if (isset($_GET['local'])):  ?>
                
                <section id="local">
                    <span class="descricao"><?= @$_SESSION['local.descricao'] ?></span>
                    <i class="close"><a href="./">&times</a></i>
                </section>

                <?php require 'core/setor.inc.php'; ?>
                <?php if (isset($_GET['setor'])):  ?>
                        <section id="setor">
                            <span class="descricao"><?= @$_SESSION['setor.descricao'] ?></span>
                            <i class="close"><a href="./?local=<?= $_GET['local'] ?>">&times</a></i>
                        </section>
                        <section id="item">
                            <span class="descricao">O que você encontrou?</span>
                            <i class="close"></i>
                        </section>
                        <section class="setor option">
                            <form action="" method="post" enctype="multipart/form-data">
                                <?php if(isset($_GET['repetido'])) :?>
                                    <span class="erro">Este número já foi registrado neste mês.</span>
                                <?php endif; ?>
                                <input type="hidden" name="local" value="<?= $_GET['local'] ?>">
                                <input type="hidden" name="setor" value="<?= $_GET['setor'] ?>">                            
                                <p><label for="numero">Número:</label>
                                <input type="number" autofocus id="numero" name="numero">&nbsp;</p>
                                <p><label>Descrição:</label>
                                <textarea name="descricao" id="descricao"></textarea>
                                </p>
                                <p><label>Foto:

                                </label>
                                <label class="upload-foto" for="foto">📷</label>
                                <input class="escondido" accept="image/*" id="foto" type="file" name="foto">
                                </p>
                                <p><label>&nbsp;</label>
                                <input type="submit" value="Salvar"></p>
                            </form>
                        </section>
                        <?php render_registros(); ?>   
                    <?php else: ?>
                    <section id="setor">
                        <span class="descricao">Onde você está?</span>
                    </section>
                    
                    <?php render_setores(); ?>   
                <?php endif; ?>

            <?php else: ?>

                <section id="local">
                    <span class="descricao">Escolha o local onde você trabalha: </span>
                </section>
                <?php render_locais(); ?> 

            <?php endif; ?>
            
        <?php else: ?>
            <section id="acoes">
                <form action="" method="post">
                    <span>Quem é você?</span>                    
                    <?php if (!isset($cadastrar_novo)) : ?>
                        <p><label for="codigo">Seu código: </label><input id="codigo" type="text" name="codigo" value="<?= @$_POST['codigo'] ?>"></p>
                        <p><label for="senha">Sua senha: </label><input id="senha" type="password" name="senha" value="<?= @$_POST['senha'] ?>"></p>
                        <p><label for="verificar">&nbsp;</label><input id="verificar" type="submit" value="Verificar"></p>
                    <?php else: ?>
                        <p><label for="nome">Seu nome: </label><input  id="nome" type="text" name="nome"></p>
                        <p><label for="continuar">&nbsp;</label><input id="continuar"  type="submit" value="Continuar"></p>
                    <?php endif; ?>
                </form>
            </section>
        
        <?php endif; ?>
    </div>
</body>

</html>