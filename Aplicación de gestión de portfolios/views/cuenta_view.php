<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../js/script.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/styles.css">
    <title>Mi cuenta</title>
</head>

<body>

    <?php include 'include/header.php';
    if (isset($_SESSION['data'])) {
        echo "<div class='alert alert-success' role='alert'>";
        echo $_SESSION['data'];
        unset($_SESSION['data']);
        echo "</div>";
    }
    if (isset($_SESSION['error'])) {
        echo "<div class='alert alert-danger' role='alert'>";
        echo $_SESSION['error'];
        unset($_SESSION['error']);
        echo "</div>";
    }
    ?>
    <div class="container mt-4">
        <?php
        $cadena = $_SERVER['REQUEST_URI'];
        $partes = explode('/', $cadena);
        $id = $partes[2];
        ?>
        <!-- Usuario Información -->
        <div class="text-center">
            <img src="/img/<?php echo $data['usuario']['usuario']['foto']; ?>" alt="Imagen de usuario"
                class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px;">
            <?php if ($_SESSION['usuarioActivo']['id'] == $id) { ?>
                <form action="/subirImagen" method="post" enctype="multipart/form-data">
                    <input type="file" name="imagen" id="file"></input>
                    <input type="submit" name="subirImagen" value="submit">
                </form>
            <?php } ?>
            <h1><?= htmlspecialchars($data['usuario']['usuario']['nombre'] . ' ' . $data['usuario']['usuario']['apellidos']) ?>
            </h1>
            <h4 class="text-muted"><?= htmlspecialchars($data['usuario']['usuario']['categoria_profesional']) ?>
            </h4>
            <p><?= htmlspecialchars($data['usuario']['usuario']['resumen_perfil']) ?></p>
            <?php
            if ($_SESSION['usuarioActivo']['id'] == $id) {
                // Mostrar o ocultar el perfil según la visibilidad
                $perfilVisibleTexto = $data['usuario']['usuario']['visible'] == 1 ? "Ocultar perfil" : "Mostrar perfil";
                $perfilVisibleLink = $data['usuario']['usuario']['visible'] == 1 ? "/ocultarCuenta/" . $data['usuario']['usuario']['id'] : "/mostrarCuenta/" . $data['usuario']['usuario']['id'];
                echo "<a href='$perfilVisibleLink'>$perfilVisibleTexto</a>";
            }
            ?>
        </div>
    </div>

    <div class="usuariosContenido mx-auto">
        <!-- Skills -->
        <h2 class="mt-4">Skills</h2>
        <?php
        if (empty($data['skills']['skills'])) {
            echo "<p>No se encontraron habilidades</p>";
        } else {
            $data['skills'] = $data['skills']['skills'];
            $skillsByCategory = [];

            foreach ($data['skills'] as $skill) {
                if (!empty($skill['categorias_skills_categoria']) && isset($skill['visible']) && $skill['visible'] != 0) {
                    $categoria = $skill['categorias_skills_categoria'];

                    if (!isset($skillsByCategory[$categoria])) {
                        $skillsByCategory[$categoria] = [];
                    }

                    $skillsByCategory[$categoria][] = $skill;
                } else if (empty($skill['categorias_skills_categoria']) && isset($skill['visible']) && $skill['visible'] != 0) {
                    $skillsByCategory['Sin categoría'][] = $skill;
                }
            }

            foreach ($skillsByCategory as $categoria => $skills) {
                if (count($skills) > 0) {
                    echo "<h5>" . htmlspecialchars($categoria) . "</h5>";
                    foreach ($skills as $skill) {
                        echo "<span 
                            class='badge bg-primary me-2 skill-badge' 
                            data-id='" . htmlspecialchars($skill['id']) . "' 
                            data-categoria='" . htmlspecialchars($skill['categorias_skills_categoria'] ?? 'Sin categoría') . "' 
                            data-habilidad='" . htmlspecialchars($skill['habilidades']) . "'>
                            " . htmlspecialchars($skill['habilidades']) . "
                          </span>";
                    }
                }
            }
        }
        ?>

        <?php
        if ($id == $_SESSION['usuarioActivo']['id']) {
            ?>
            <!-- Modal -->
            <div class="modal fade" id="skillModal" tabindex="-1" aria-labelledby="skillModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="skillModalLabel">Acción requerida</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p id="skillModalMessage"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" id="editSkillButton">Editar</button>
                            <button type="button" class="btn btn-danger" id="deleteSkillButton">Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>

        <?php
        if ($_SESSION['usuarioActivo']['id'] == $id) {
            echo "<br /><br />";
            echo '<a href="/addSkill" class="btn btn-primary">Añadir skill</a>';
        }
        ?>


        <!-- Trabajos -->
        <h2 class="mt-4">Trabajos</h2>
        <?php
        if (empty($data['trabajos']['trabajos'])) {
            echo "<p>No se encontraron trabajos previos</p>";
        } else {
            foreach ($data['trabajos']['trabajos'] as $trabajo) {
                echo "<div class='contenidoPerfil'>";
                if ($trabajo['fecha_inicio'] != NULL && $trabajo['fecha_final'] != NULL) {
                    echo "<h4>" . htmlspecialchars($trabajo['titulo']) . " / Inicio: " . htmlspecialchars($trabajo['fecha_inicio']) . " - Fin: " . htmlspecialchars($trabajo['fecha_final']);
                } else {
                    echo "<h4>" . htmlspecialchars($trabajo['titulo']);
                }

                if ($id == $_SESSION['usuarioActivo']['id']) {
                    echo "<form action='/editarTrabajo' method='POST' style='display:inline;'>";
                    echo "<input type='hidden' name='idTrabajo' value='" . htmlspecialchars($trabajo['id']) . "'>";
                    echo "<button type='submit' class='btn btn-primary ms-2' name='editarTrabajo'>✎</button>";
                    echo "</form>";

                    echo "<form action='/eliminarTrabajo' method='POST' style='display:inline;'>";
                    echo "<input type='hidden' name='idTrabajo' value='" . htmlspecialchars($trabajo['id']) . "'>";
                    echo "<button type='submit' class='btn btn-danger ms-2' name='eliminarTrabajo'>🗑</button>";
                    echo "</form>";
                }

                echo "</h4>";

                echo "<h6> Descripción: " . htmlspecialchars($trabajo['descripcion']) . "</h6>";
                echo "<h6> Logros: " . htmlspecialchars($trabajo['logros']) . "</h6>";
                echo "</div>";
            }
        }
        if ($_SESSION['usuarioActivo']['id'] == $id) {
            echo "<br />";
            echo '<a href="/anadirTrabajo" class="btn btn-primary">Añadir trabajo</a>';
        } ?>

        <!-- Redes Sociales -->
        <h2 class="mt-4">Redes Sociales</h2>
        <?php
        if (empty($data['redesSociales']['redesSociales'])) {
            echo "<p>No se encontraron redes sociales</p>";
        } else {
            $data['redesSociales'] = $data['redesSociales']['redesSociales'];
            foreach ($data['redesSociales'] as $redSocial) {
                echo "<div class='contenidoPerfil'>";
                echo "<div style='display: flex; align-items: center; gap: 10px;'>"; // Contenedor para alineación horizontal
                echo "<h4 style='margin: 0;'><a class ='vinculo' href='" . htmlspecialchars($redSocial['url']) . "'><p style='display: inline; margin: 0;'>" . htmlspecialchars($redSocial['red_social']) . "</p></a></h4>";

                if ($id == $_SESSION['usuarioActivo']['id']) {
                    echo "<form action='/editarRRSS' method='POST' style='display: inline; margin: 0;'>";
                    echo "<input type='hidden' name='idRRSS' value='" . htmlspecialchars($redSocial['id']) . "'>";
                    echo "<button type='submit' class='btn btn-primary' name='editarRRSS'>✎</button>";
                    echo "</form>";

                    echo "<form action='/eliminarRRSS' method='POST' style='display: inline; margin: 0;'>";
                    echo "<input type='hidden' name='idRRSS' value='" . htmlspecialchars($redSocial['id']) . "'>";
                    echo "<button type='submit' class='btn btn-danger' name='eliminarRRSS'>🗑</button>";
                    echo "</form>";
                }
                echo "</div>";
                echo "</div>";
                echo "<br/>";
            }
        }


        if ($_SESSION['usuarioActivo']['id'] == $id) {
            echo "<br />";
            echo '<a href="/anadirRRSS" class="btn btn-primary">Añadir red social</a>';
        } ?>
        <!-- Proyectos -->
        <h2 class="mt-4">Proyectos</h2>
        <?php
        if (empty($data['proyectos']['proyectos'])) {
            echo "<p>No se encontraron proyectos</p>";
        } else {
            foreach ($data['proyectos']['proyectos'] as $proyecto) {
                echo "<div class='contenidoPerfil'>";
                echo "<div style='display: flex; align-items: center; gap: 10px;'>"; // Contenedor para alineación horizontal
                echo "<h4 class='ayuda'>" . htmlspecialchars($proyecto['titulo']) . "</h4>";
                if ($id == $_SESSION['usuarioActivo']['id']) {
                    echo "<form action='/editarProyecto' method='POST' style='display: inline; margin: 0;'>";
                    echo "<input type='hidden' name='id_proyecto' value='" . htmlspecialchars($proyecto['id']) . "'>";
                    echo "<button type='submit' class='btn btn-primary' name='editarProyecto'>✎</button>";
                    echo "</form>";

                    echo "<form action='/eliminarProyecto' method='POST' style='display: inline; margin: 0;'>";
                    echo "<input type='hidden' name='id_proyecto' value='" . htmlspecialchars($proyecto['id']) . "'>";
                    echo "<button type='submit' class='btn btn-danger' name='eliminarProyecto'>🗑</button>";
                    echo "</form>";
                }
                echo "</div>";
                echo "<h5> - Acerca del proyecto </h5>";
                echo "<span>" . htmlspecialchars($proyecto['descripcion']) . "</span>";
                echo "</br></br>";
                echo "<h5> - Tecnologías utilizadas </h5>";
                echo "<span>" . htmlspecialchars($proyecto['tecnologias']) . "</span>";
                echo "</br></br>";
                echo "</div>";
            }
        }

        if ($_SESSION['usuarioActivo']['id'] == $id) {
            echo '<a href="/anadirProyecto" class="btn btn-primary">Añadir proyecto</a>';
        }
        ?>


    </div>
</body>

</html>