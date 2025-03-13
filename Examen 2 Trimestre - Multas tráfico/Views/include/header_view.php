<header>
    <?php
    if (isset($_SESSION['error'])){
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }
    if (isset($_SESSION['success'])){
        echo $_SESSION['success'];
        unset($_SESSION['success']);
    }
    if ($_SESSION['perfil'] == 'invitado') {
        $numCaptcha1 = random_int(1, 9);
        $numCaptcha2 = random_int(1, 9);
        $resCaptcha = $numCaptcha1 + $numCaptcha2;
        ?>
        <div style="display:flex; justify-content: space-between;">
            <a href="/">Inicio</a>
            <form action='/login' method='POST'>
                <input type='text' name='usuario' placeholder='Usuario'>
                <input type='password' name='password' placeholder='Contraseña'>
                <label><?php echo $numCaptcha1 . " + " . $numCaptcha2 . " = " ?></label>
                <input type="number" name="captcha">
                <input type="hidden" name="resCaptcha" value="<?php echo $resCaptcha ?>">
                <input type='submit' name='iniciarSesion' value='Iniciar sesión'>
                <!-- <input type='submit' name='register' value='Registrarse'> -->
            </form>
        </div>
        <?php
    } elseif ($_SESSION['perfil'] == 'conductor') {
        ?>
        <div style="display:flex; justify-content: space-between;">
            <span> Bienvenido <?php echo $_SESSION['usuario']['nombre'] ?></span>
            <a href="/">Inicio</a>
            <a href="/multas">Multas</a>
            <a href="/logout">Cerrar sesión</a>
        </div>
        <?php
    } elseif ($_SESSION['perfil'] == 'agente'){
        ?>
        <div style="display:flex; justify-content: space-between;">
            <span> Bienvenido <?php echo $_SESSION['usuario']['nombre'] ?></span>
            <a href="/">Inicio</a>
            <a href="/multasAgente">Multas</a>
            <a href="/logout">Cerrar sesión</a>
        </div>
        <?php
    } elseif ($_SESSION['perfil'] == 'admin'){
        ?>
        <div style="display:flex; justify-content: space-between;">
            <span> Bienvenido <?php echo $_SESSION['usuario']['nombre'] ?></span>
            <a href="/">Inicio</a>
            <a href="/adminPanel">Listado conductores</a>
            <a href="/logout">Cerrar sesión</a>
        </div>
        <?php
    }
    ?>
</header>

<!-- 
<div style="display:flex; justify-content: space-between;">
            <span> Bienvenido <?php echo $_SESSION['usuario']['nombre'] ?></span>
            <a href="/">Inicio</a>
            <a href="/tests">Tests</a>
            <a href="/logout">Cerrar sesión</a>
        </div> -->