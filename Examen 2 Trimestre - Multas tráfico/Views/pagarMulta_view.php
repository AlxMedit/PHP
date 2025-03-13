<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>

<?php
include('include/header_view.php');
?>

<form action="/pagarMulta" method="post">
    <h1>Detalles de la multa</h1>
    <p>IdMulta: <?php echo $data[0]['id']; ?> </p>
    <p>Matricula: <?php echo $data[0]['matricula']; ?> </p>
    <p>Conductor: <?php echo $data[0]['id_conductor']; ?> </p>
    <p>Tipo Infracción: <?php echo $data[0]['id_tipo_sanciones']; ?> </p>
    <p>Descripción: <?php echo $data[0]['descripcion']; ?> </p>
    <p>Fecha: <?php echo $data[0]['fecha']; ?> </p>
    <p>Importe: <?php echo $data[0]['importe']; ?> </p>
    <p>Bonificación: <?php echo $data[0]['descuento']; ?> </p>
    

    <?php
    if ($_SESSION['pagada'] == 0){
        echo "<input type='submit' name='pagar' value='Pagar'>";
    } else {
        echo "<input type='submit' value='Ya pagada' disabled>";
    }
    ?>

    <?php
        if (isset($_SESSION['descuento'])){
            echo $_SESSION['descuento'];
        }
    ?>
</form>

</body>