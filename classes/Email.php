<?php 
namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;


class Email {
    protected $email;
    protected $nombre;
    protected $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;

    }

    public function enviarConfirmacion() {

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 587;
        $mail->Username = '2e637ea235f1f1';
        $mail->Password = '8f0ba72e3afc25';

        $mail->setFrom('cuentas@appsalon.com', 'AppSalon.com');
        $mail->addAddress($this->email);
        $mail->Subject = 'Confirma tu Cuenta';

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has Creado tu cuenta en UpTask, solo debes confirmarla en el siguiente enlace</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/confirmar?token=" . $this->token . "'>Confirmar Cuenta</a></p>";
        $contenido .= "<p>Si tu no creaste esta cuenta, puedes ignorar este mensaje</p>";
        $contenido .= '</html>';

        $mail->Body = $contenido;


        // Enviar el email
        $mail->send();
    }


    public function enviarInstrucciones() {

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 587;
        $mail->Username = '2e637ea235f1f1';
        $mail->Password = '8f0ba72e3afc25';

        $mail->setFrom('cuentas@appsalon.com', 'AppSalon.com');
        $mail->addAddress($this->email);
        $mail->Subject = 'Reestablece tu password';

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has solicitado restablecer tu password en UpTask, entra en el siguiente enlace para cambiarlo</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/reestablecer?token=" . $this->token . "'>Reestablecer password</a></p>";
        $contenido .= "<p>Si tu no solicitaste este cambio, puedes ignorar este mensaje</p>";
        $contenido .= '</html>';

        $mail->Body = $contenido;


        // Enviar el email
        $mail->send();
    }
}

