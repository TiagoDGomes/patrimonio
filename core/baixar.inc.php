<?php 

if (isset($_POST['ano'])){
    $sql = "SELECT id, datahora, numero, idsetor FROM registro WHERE year(datahora) =  ? ";
    $stmt2 = $db->prepare($sql);    
    $stmt2->bind_param('i', $_POST['ano']);
    $res = $stmt2->execute();   
    $stmt2->store_result();
    if ($stmt2->num_rows >= "1"){
        while($ret = $res->fetch_assoc()){
            var_dump($ret);
        }
    } 
    

    $stmt2->close();
    exit();

}

