<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/styles.css">
    <title>Acceso denegado</title>
</head>

<body>
    <?php include 'include/header.php'; ?>
    <div class="container mt-4">
        <div class="alert alert-danger" role="alert">
            <?php 
            if (isset($data['errorMessage'])) {
                echo $data['errorMessage'];
            } else {
                echo "Acceso denegado";
            }
            ?>    
        </div>
</body>