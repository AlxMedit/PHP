<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>

<body>
    <?php
    include('include/header_view.php');
    $conductores = $data;
    ?>
    <h1>Las multas impuestas son: </h1>
    <form action="/ponerMulta" method="POST">
        <input type="text" name="matricula" placeholder="Matrícula" required><br><br>
        <select name="conductor">
            <?php
            foreach($conductores as $conductor){
                echo "<option>" . $conductor['usuario'] . "</option>";
            }
    
            ?>
        </select><br><br>
        <input type="date" name="fecha" placeholder="Fecha" required><br><br>
        <label><input type="radio" name="sancion" value="1" required> Leve</label><br>
        <label><input type="radio" name="sancion" value="2" required> Grave</label><br>
        <label><input type="radio" name="sancion" value="3" required> Muy grave</label><br><br>
        <input type="text" name="descripcion" placeholder="Descripción" required><br><br>


        <input type="submit" value="Poner multa" name="addMultaFilled">
    </form>
</body>

</html>