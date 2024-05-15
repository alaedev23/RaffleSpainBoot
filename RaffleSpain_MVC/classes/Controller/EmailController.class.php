<?php

require 'vendor/autoload.php';

// Contrasenña mail: RaffleSpain_2024
// Key: rhze gwvp bgvh kzzj

class EmailController extends Controller
{

    public function sendMail($client, $deliver = null)
    {

        $mPdf = new MpdfController();

        $to = $client->email;

        $from = 'rafflespaintm@gmail.com';
        $fromName = 'rafflespainTM';

        $hash = Crypto::encrypt_hash($client->email);
        $encodedEmail = urlencode($hash);
        $domain = "localhost";
        $activationLink = "http://{$domain}/M12/RaffleSpainTM/RaffleSpain_MVC/?Email/validate/{$encodedEmail}";

        $mail = new PHPMailer\PHPMailer\PHPMailer;

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $from;
        $mail->Password = 'rhzegwvpbgvhkzzj';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $params = $mPdf->generateAndSavePDF($deliver);


        if (isset($deliver)) {
            $subject = 'Pedido realizado con éxito';
            $htmlContent = "
            <body style='font-family: Verdana, Geneva, sans-serif; background-color: #e8e8e8; margin: 0; padding: 0;'>
                <div style='background-color: #f8f8f8; padding: 30px; border-radius: 10px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); position: relative;'>
                    <h2 style='color: #444444; margin-bottom: 15px;'>¡Saludos desde RaffleSpain!</h2>
                    <p style='color: #666666; line-height: 1.6; margin-bottom: 25px;'>Tu pedido ha sido realizado con éxito. Adjuntamos la factura a continuación:</p>
                    <p style='color: #666666; line-height: 1.6;'>Agradecemos tu participación.</p>
                    <p style='color: #444444; line-height: 1.6; margin-top: 25px;'>Cordialmente,<br>El Equipo de Soporte</p>
                </div>
            </body>";

            $mail->addAttachment($params[0], $params[1] . '.pdf');

        } else {
            $subject = 'Activa tu cuenta de RaffleSpain';
            $htmlContent = "
        <body style='font-family: Verdana, Geneva, sans-serif; background-color: #e8e8e8; margin: 0; padding: 0;'>
            <div style='background-color: #f8f8f8; padding: 30px; border-radius: 10px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); position: relative;'>
                <h2 style='color: #444444; margin-bottom: 15px;'>¡Saludos des de RaffleSpain!</h2>
                <p style='color: #666666; line-height: 1.6; margin-bottom: 25px;'>Para activar tu cuenta, por favor sigue el enlace a continuación:</p>
                <p style='margin: 20px 0;'><a href='{$activationLink}' style='color: #008cff; text-decoration: none; font-weight: bold;'>Activar Cuenta</a></p>
                <p style='color: #666666; line-height: 1.6;'>Agradecemos tu participación.</p>
                <p style='color: #444444; line-height: 1.6; margin-top: 25px;'>Cordialmente,<br>El Equipo de Soporte</p>
            </div>
        </body>";
        }

        $mail->setFrom($from, $fromName);
        $mail->addAddress($to);

        $mail->isHTML(true);

        $mail->Subject = $subject;
        $mail->Body = $htmlContent;

        if (!$mail->send()) {
            throw new Exception("Email sending failed.");
        }

        $mPdf->deletePDF($params[0]);

    }

    public function sendMailContactUs($contact)
    {

        $to = 'rafflespaintm@gmail.com';
        $from = 'rafflespaintm@gmail.com';
        $fromName = 'rafflespainTM';

        $subject = 'Contact Us Soporte';

        $htmlContent = "
        <body style='font-family: Verdana, Geneva, sans-serif; background-color: #e8e8e8; margin: 0; padding: 0;'>
            <div style='background-color: #f8f8f8; padding: 30px; border-radius: 10px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); position: relative;'>
                <h1 style='color: #444444; margin-bottom: 15px;'>Contact Us Soporte</h1>
                <h2>Asunto:</h2>
                <p style='color: #666666; line-height: 1.6; margin-bottom: 25px;'> " . $contact['titulo'] . "</p>
                <h2>Email:</h2>
                <p style='color: #666666; line-height: 1.6; margin-bottom: 25px;'> " . $contact['email'] . "</p>
                <h2>Mensaje:</h2>
                <p style='color: #666666; line-height: 1.6; margin-bottom: 25px;'>" . $contact['mensaje'] . "</p>
            </div>
        </body>";

        $mail = new PHPMailer\PHPMailer\PHPMailer;

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $from;
        $mail->Password = 'rhzegwvpbgvhkzzj';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom($from, $fromName);
        $mail->addAddress($to);

        $mail->isHTML(true);

        $mail->Subject = $subject;
        $mail->Body = $htmlContent;

        if (!$mail->send()) {
            throw new Exception("Email sending failed.");
        }
    }

    // public function sendDelivery($client, $delivery)
    // {
    //     $to = $client->email;

    //     $from = 'rafflespaintm@gmail.com';
    //     $fromName = 'rafflespainTM';

    //     $subject = 'Factura Pedido';
    //     $hash = Crypto::encrypt_hash($client->email);
    //     $encodedEmail = urlencode($hash);
    //     $domain = "192.168.119.18";
    //     $activationLink = "http://{$domain}/M12/RaffleSpainTM/RaffleSpain_MVC/?Email/validate/{$encodedEmail}";

    //     $htmlContent = "
    //     <body style='font-family: Verdana, Geneva, sans-serif; background-color: #e8e8e8; margin: 0; padding: 0;'>
    //         <div style='background-color: #f8f8f8; padding: 30px; border-radius: 10px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); position: relative;'>
    //             <h1 style='color: #444444; margin-bottom: 15px;'>Factura Pedido</h1>
    //             <h2>Asunto:</h2>
    //             <p style='color: #666666; line-height: 1.6; margin-bottom: 25px;'> " . $contact['titulo'] . "</p>
    //             <h2>Email:</h2>
    //             <p style='color: #666666; line-height: 1.6; margin-bottom: 25px;'> " . $contact['email'] . "</p>
    //             <h2>Mensaje:</h2>
    //             <p style='color: #666666; line-height: 1.6; margin-bottom: 25px;'>" . $contact['mensaje'] . "</p>
    //         </div>
    //     </body>";

    //     $mail = new PHPMailer\PHPMailer\PHPMailer;

    //     $mail->isSMTP();
    //     $mail->Host = 'smtp.gmail.com';
    //     $mail->SMTPAuth = true;
    //     $mail->Username = $from;
    //     $mail->Password = 'rhzegwvpbgvhkzzj';
    //     $mail->SMTPSecure = 'tls';
    //     $mail->Port = 587;

    //     $mail->setFrom($from, $fromName);
    //     $mail->addAddress($to);

    //     $mail->isHTML(true);

    //     $mail->Subject = $subject;
    //     $mail->Body = $htmlContent;

    //     if (!$mail->send()) {
    //         throw new Exception("Email sending failed.");
    //     }
    // }

    public function validate($hash)
    {
        $implodedhash = implode("/", $hash);
        $email = Crypto::decrypt_hash($implodedhash);
        if ($email === false) {
            throw new Exception("Invalid hash.");
        }
        $mClient = new ClientModel();
        $client = $mClient->getByEmail($email);
        $mClient->validateType($client);
        ValidateController::showCorrectValidate($email);
    }

}