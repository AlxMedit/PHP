<?php
// Exportar a PDF
if (isset($_POST["exportar_pdf"])) {
    exportToPDF();
    exit;
}

// Exportar a TXT
if (isset($_POST["exportar_txt"])) {
    exportToTXT();
    exit;
}

// Función para exportar contactos a un archivo PDF
function exportToPDF() {
    // Cabeceras para forzar la descarga del archivo PDF
    header("Content-Type: application/pdf");
    header("Content-Disposition: attachment; filename=agenda.pdf");

    // Contenido básico del archivo PDF
    $pdfContent = "%PDF-1.4\n";
    $pdfContent .= "1 0 obj << /Type /Catalog /Pages 2 0 R >> endobj\n";
    $pdfContent .= "2 0 obj << /Type /Pages /Kids [3 0 R] /Count 1 >> endobj\n";
    $pdfContent .= "3 0 obj << /Type /Page /Parent 2 0 R /MediaBox [0 0 612 792] /Contents 4 0 R >> endobj\n";
    $pdfContent .= "4 0 obj << /Length 5 0 R >> stream\n";

    // Construcción del contenido del PDF
    $content = "BT /F1 24 Tf 50 750 Td (Agenda de Contactos) Tj ET\n";
    $yPosition = 700;
    foreach ($_SESSION["contacts"] as $contact) {
        $line = $contact["nombre"] . " - " . $contact["email"] . " - " . $contact["tfno"];
        $content .= "BT /F1 12 Tf 50 {$yPosition} Td (" . $line . ") Tj ET\n";
        $yPosition -= 20;
    }

    // Agregar contenido al PDF
    $pdfContent .= $content . "endstream endobj\n";
    $pdfContent .= "5 0 obj " . strlen($content) . " endobj\n";
    $pdfContent .= "xref\n0 6\n0000000000 65535 f \n0000000010 00000 n \n0000000077 00000 n \n0000000179 00000 n \n0000000318 00000 n \n0000000458 00000 n \ntrailer << /Root 1 0 R /Size 6 >>\nstartxref\n503\n%%EOF";

    // Enviar el contenido al navegador
    echo $pdfContent;
}

// Función para exportar contactos a un archivo TXT
function exportToTXT() {
    // Cabeceras para forzar la descarga del archivo de texto
    header("Content-Type: text/plain");
    header("Content-Disposition: attachment; filename=agenda.txt");

    // Contenido del archivo de texto
    $txtContent = "Agenda de Contactos\n\n";
    foreach ($_SESSION["contacts"] as $contact) {
        $txtContent .= "Nombre: " . $contact["nombre"] . "\n";
        $txtContent .= "Email: " . $contact["email"] . "\n";
        $txtContent .= "Teléfono: " . $contact["tfno"] . "\n\n";
    }

    // Enviar el contenido al navegador
    echo $txtContent;
}
?>
