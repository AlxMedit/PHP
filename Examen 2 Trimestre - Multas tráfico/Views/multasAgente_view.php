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
    ?>
    <p><?php echo $data['promedio'] ?></p>
    <h1>Las multas impuestas son: </h1>
    <table>
        <tr>
            <td style="padding: 0 20px;">Matrícula</td>
            <td style="padding: 0 20px;">Descripción</td>
            <td style="padding: 0 20px;">Fecha</td>
        </tr>

        <?php
        foreach ($data['info'] as $multa) {
            echo "<tr>";
            echo "<td style=\"padding: 0 20px;\">" . $multa['matricula'] . "</td>";
            echo "<td style=\"padding: 0 20px;\">" . $multa['descripcion'] . "</td>";
            echo "<td style=\"padding: 0 20px;\">" . $multa["fecha"] . "</td>";
            echo "</tr>";
        }

        ?>
    </table><br>

    <form action="/ponerMulta" method="POST">
        <input type="submit" value="Poner multa" name="addMulta">
    </form>
</body>

</html>