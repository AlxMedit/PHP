<?php

namespace App\Core;

use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

class SendEmail
{
    public function enviarCorreoVerificacion($email, $token)
    {
        // Configurar el transporte SMTP
        $transport = Transport::fromDsn('smtp://trabajosphpalex@gmail.com:tqzszzkbvfhmicga@smtp.gmail.com:587');
        $mailer = new Mailer($transport);

        // Crear el correo
        $emailMessage = (new Email())
            ->from('trabajosphpalex@gmail.com')
            ->to($email)
            ->subject('Token de Verificación')
            ->text('Valida tu cuenta')
            ->html('<p>Para verificar tu cuenta, haz click en el siguiente enlace <a href="http://portfolio.local/verificar/' . $token . '">VERIFICAR</a></p>');

        // Enviar el correo
        $mailer->send($emailMessage);
    }
}
