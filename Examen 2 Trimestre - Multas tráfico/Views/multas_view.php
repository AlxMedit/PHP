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

    <h1>Tus multas son</h1>

    <table>
        <tr>
            <td style="padding: 0 20px;">Matrícula</td>
            <td style="padding: 0 20px;">Descripción</td>
            <td style="padding: 0 20px;">Fecha</td>
            <td style="padding: 0 20px;">Estado</td>
            <td style="padding: 0 20px;">Acción</td>
        </tr>

        <?php
        foreach ($data as $multa) {
            echo "<tr>";
            echo "<td style=\"padding: 0 20px;\">" . $multa['matricula'] . "</td>";
            echo "<td style=\"padding: 0 20px;\">" . $multa['descripcion'] . "</td>";
            echo "<td style=\"padding: 0 20px;\">" . $multa["fecha"] . "</td>";
            echo "<td style=\"padding: 0 20px;\">" . $multa["estado"] . "</td>";
            echo "<td style=\"padding: 0 20px;\"> <a href=\"/pagarMulta/" . $multa['id'] . "\">Pagar</a></td>";
            echo "</tr>";
        }

        ?>
    </table>

</body>

</html>