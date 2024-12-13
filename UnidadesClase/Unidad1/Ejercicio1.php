<?php
/**
 * @author Alex Abad
 * @date 1er Trimestre 2024
 * @version 1.0
 * Ejercicio de teoría
 */
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
            padding: 0;
        }

        h1 {
            color: #0073e6;
        }

        h2 {
            color: #005bb5;
        }

        .respuesta {
            background: #f4f4f4;
            border-left: 4px solid #0073e6;
            padding: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <h1>Preguntas y Respuestas sobre Tecnologías Web</h1>

    <h2>1. ¿Qué son los servicios web?</h2>
    <div class="respuesta">
        Los servicios web son aplicaciones o interfaces que permiten la comunicación entre diferentes sistemas a través
        de la web utilizando protocolos estándar como HTTP, SOAP o REST. Suelen intercambiar datos en formatos como JSON
        o XML.
    </div>

    <h2>2. ¿Qué son los estándares web?</h2>
    <div class="respuesta">
        Los estándares web son un conjunto de normas y guías definidas por organizaciones como la W3C para asegurar que
        los contenidos y aplicaciones web sean accesibles, interoperables y funcionales en diferentes plataformas y
        dispositivos.
    </div>

    <h2>3. ¿Quién forma la W3C?</h2>
    <div class="respuesta">
        La W3C (World Wide Web Consortium) está formada por empresas, instituciones académicas, investigadores y
        expertos de todo el mundo que colaboran en el desarrollo de estándares para la web.
    </div>

    <h2>4. Tecnologías importantes utilizadas en la web</h2>
    <div class="respuesta">
        <ul>
            <li><strong>HTML:</strong> Lenguaje para estructurar el contenido de la web.</li>
            <li><strong>CSS:</strong> Estilos para mejorar la presentación visual de los sitios web.</li>
            <li><strong>JavaScript:</strong> Lenguaje de programación para interactividad en la web.</li>
            <li><strong>PHP:</strong> Lenguaje del lado del servidor para generar contenido dinámico.</li>
            <li><strong>SQL:</strong> Lenguaje para gestionar bases de datos relacionales.</li>
        </ul>
    </div>

    <h2>5. ¿Qué es un lenguaje de scripts?</h2>
    <div class="respuesta">
        Un lenguaje de scripts es un lenguaje de programación que automatiza tareas dentro de un entorno, como un
        navegador web o un servidor. Por ejemplo, JavaScript en el cliente o Python en el servidor.
    </div>

    <h2>6. Diferencias entre lenguajes del lado del servidor y del lado del cliente</h2>
    <div class="respuesta">
        <ul>
            <li><strong>Lado del cliente:</strong> Se ejecutan en el navegador del usuario, como JavaScript. Son ideales
                para interactividad y diseño dinámico.</li>
            <li><strong>Lado del servidor:</strong> Se ejecutan en el servidor y generan contenido dinámico para el
                cliente, como PHP, Python o Node.js.</li>
        </ul>
    </div>

    <h2>7. Lenguajes más utilizados en aplicaciones web</h2>
    <div class="respuesta">
        <ul>
            <li><strong>JavaScript:</strong> Dominante para desarrollo frontend y backend con frameworks como Node.js.
            </li>
            <li><strong>PHP:</strong> Muy usado en el backend para sitios como WordPress.</li>
            <li><strong>Python:</strong> Popular por su versatilidad y frameworks como Django y Flask.</li>
            <li><strong>Java:</strong> Utilizado en grandes aplicaciones empresariales.</li>
        </ul>
    </div>

    <h2>8. ¿Qué es Apache y cuáles son sus características más importantes?</h2>
    <div class="respuesta">
        Apache es un servidor web de código abierto ampliamente utilizado. Permite a los desarrolladores alojar sitios y
        aplicaciones web. Entre sus características destacan la modularidad, compatibilidad multiplataforma, soporte
        para SSL/TLS y configuración mediante archivos como <code>.htaccess</code>.
    </div>

    <h2>9. Archivos de configuración importantes de Apache</h2>
    <div class="respuesta">
        Los archivos más importantes son:
        <ul>
            <li><strong>httpd.conf:</strong> Archivo principal de configuración del servidor.</li>
            <li><strong>.htaccess:</strong> Archivo usado para configurar ajustes específicos en directorios.</li>
        </ul>
        Ejemplo de configuración en <code>httpd.conf</code>:
        <pre>
            &lt;Directory "/var/www/html"&gt;
                AllowOverride All
                Require all granted
            &lt;/Directory&gt;
        </pre>
    </div>


    <h2>10. ¿Para qué sirve el módulo mod_ssl de Apache?</h2>
    <div class="respuesta">
        El módulo <strong>mod_ssl</strong> permite a Apache manejar conexiones HTTPS, garantizando la seguridad mediante
        cifrado SSL/TLS. Esto protege los datos transmitidos entre el cliente y el servidor.
    </div>

    <h2>11. ¿Qué es una entidad certificadora?</h2>
    <div class="respuesta">
        Una entidad certificadora (CA) es una organización que emite certificados digitales para autenticar la identidad
        de sitios web y usuarios, asegurando la seguridad de las comunicaciones.
    </div>

    <h2>12. Diferencias entre HTTP y HTTPS</h2>
    <div class="respuesta">
        <ul>
            <li><strong>HTTP:</strong> Protocolo no seguro para transferir datos.</li>
            <li><strong>HTTPS:</strong> Versión segura de HTTP que utiliza SSL/TLS para cifrar las comunicaciones.</li>
        </ul>
    </div>

    <h2>13. ¿Qué es un servidor de bases de datos relacional?</h2>
    <div class="respuesta">
        Un servidor de bases de datos relacional es un sistema que almacena datos en tablas relacionadas entre sí
        mediante claves. Ejemplo: MySQL, PostgreSQL, y Oracle DB.
    </div>

    <h2>14. Servidores de bases de datos más utilizados en aplicaciones web</h2>
    <div class="respuesta">
        <ul>
            <li><strong>MySQL:</strong> Muy popular en aplicaciones web como WordPress.</li>
            <li><strong>PostgreSQL:</strong> Ofrece características avanzadas y es altamente escalable.</li>
            <li><strong>MongoDB:</strong> Aunque no es relacional, es muy usado para aplicaciones modernas.</li>
        </ul>
    </div>

    <h2>15. Análisis de servicios de hosting comerciales</h2>
    <div class="respuesta">
        Los servicios de hosting ofrecen alojamiento para aplicaciones web. Algunos tipos incluyen:
        <ul>
            <li><strong>Hosting compartido:</strong> Económico, pero recursos limitados.</li>
            <li><strong>VPS:</strong> Mayor control y rendimiento.</li>
            <li><strong>Hosting en la nube:</strong> Escalabilidad y alta disponibilidad.</li>
        </ul>
    </div>

    <h2>16. Preguntas de opción múltiple</h2>
    <div class="respuesta">
        <strong>a) En las arquitecturas cliente/servidor:</strong><br>
        Respuesta: <strong>a) La parte cliente se conoce como front-end y la servidor como back-end.</strong><br><br>

        <strong>b) ¿Cuál se emplea para programar un cliente web?</strong><br>
        Respuesta: <strong>c) HTML.</strong><br><br>

        <strong>c) ¿Cuál no se emplea para programar un servidor web?</strong><br>
        Respuesta: <strong>b) Applets.</strong><br><br>

        <strong>d) El protocolo HTTP fue creado por:</strong><br>
        Respuesta: <strong>a) Tim Berners-Lee.</strong><br><br>

        <strong>e) JavaScript es un lenguaje de programación:</strong><br>
        Respuesta: <strong>b) Basado en objetos.</strong><br><br>

        <strong>f) Cuando nos referimos a Internet y a la Web:</strong><br>
        Respuesta: <strong>a) Internet incluye a la Web.</strong><br><br>

        <strong>g) La estandarización de la Web es tarea de:</strong><br>
        Respuesta: <strong>c) W3C.</strong><br><br>

        <strong>h) ¿Cuál no se emplea para programar un cliente web?</strong><br>
        Respuesta: <strong>b) SSI.</strong>
    </div>
</body>

</html>