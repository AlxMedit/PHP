<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Color Seleccionado</title>
  <style>
    .color-page {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 24px;
      color: white;
    }
  </style>
</head>
<body style="margin: 0;">

<?php
  if (isset($_GET['color'])) {
      $color = '#' . htmlspecialchars($_GET['color']);
      echo "<div class='color-page' style='background-color: $color;'>Color seleccionado: $color</div>";
  } else {
      echo "<div class='color-page'>No se seleccionó ningún color</div>";
  }
?>

</body>
</html>
