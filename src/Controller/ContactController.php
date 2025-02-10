<?php

namespace App\Portfolio\Controller;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../../vendor/autoload.php';

class ContactController extends MainController
{
    public function sendMessage()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nom = htmlspecialchars($_POST['nom']);
            $email = htmlspecialchars($_POST['email']);
            $message = htmlspecialchars($_POST['message']);

            $mail = new PHPMailer(true);

            try {
                // Configuration SMTP Mailtrap
                $mail->isSMTP();
                $mail->Host       = 'sandbox.smtp.mailtrap.io'; // ✅ Host Mailtrap
                $mail->SMTPAuth   = true;
                $mail->Username   = '35db268c055bc8';  // ✅ Ton username Mailtrap
                $mail->Password   = '02915817ed4bce';  // ✅ Ton password Mailtrap
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // ✅ Sécurité TLS
                $mail->Port       = 2525; // ✅ Port recommandé

                // Expéditeur et destinataire
                $mail->setFrom('noreply@monportfolio.com', 'Portfolio Contact');
                $mail->addAddress('test@example.com', 'Test Mailtrap'); // Remplace par un email fictif

                // Contenu du mail
                $mail->isHTML(true);
                $mail->Subject = "Nouveau message portfolio";
                $mail->Body    = "<strong>Nom :</strong> $nom<br>
                                  <strong>Email :</strong> $email<br>
                                  <strong>Message :</strong><br>$message";
                $mail->AltBody = "Nom: $nom\nEmail: $email\n\nMessage:\n$message";

                // Envoi du mail
                $mail->send();
                $messageStatut = "✅ Votre message a bien été envoyé via Mailtrap.";
            } catch (Exception $e) {
                $messageStatut = "❌ Erreur lors de l'envoi : " . $mail->ErrorInfo;
            }

            static::afficheVue([
                "pagetitle" => "Contact",
                "messageStatut" => $messageStatut,
                "cheminVueBody" => __DIR__ . "/../View/formulaire.php"
            ]);
        }
    }
}
