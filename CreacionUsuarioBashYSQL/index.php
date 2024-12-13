<?php
/**
 * 
 * @author Alex Abad
 * Creación de usuarios mediante en ficheros
 * 
 */


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Creación de usuarios</h1>

    <form method="post" action="uploadFile.php" enctype="multipart/form-data">
        <select name="SO" id="">
            <option>SQL</option>
            <option>Bash</option>
        </select> <br/><br/>

        <input type="file" name="archivo"> <br/> <br/>
        <input type="submit" value="Procesar fichero" name="enviar">
    </form>
</body>

</html>