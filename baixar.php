<?php include 'core.php' ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Baixar</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <script src='main.js'></script>
    <script></script>
</head>

<body>
    <div id="main">
        <form action="" method="post">
            <h1>Baixar</h1>
            <p>Ano: 
                <select name="ano" id="ano">                
                    <?php for($i = (int) date("Y") ; $i > 2020; $i--) : ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                    <?php endfor; ?>
                </select>
            </p>
            <p><input type="submit" value="Baixar"></p>
        </form>
    </div>
</body>

</html>