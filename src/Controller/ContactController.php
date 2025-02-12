<?php

namespace App\Portfolio\Controller;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../env_loader.php'; // Charge les variables d'environnement

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
                // Configuration SMTP Brevo
                $mail->isSMTP();
                $mail->Host       = getenv('SMTP_HOST'); // Serveur SMTP Brevo
                $mail->SMTPAuth   = true;
                $mail->Username   = getenv('SMTP_USERNAME'); // Identifiant SMTP Brevo
                $mail->Password   = getenv('SMTP_PASSWORD'); // Mot de passe SMTP Brevo
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Sécurité TLS
                $mail->Port       = getenv('SMTP_PORT'); // Port SMTP Brevo

                // Expéditeur et destinataire
                $mail->setFrom('raja.yb@outlook.fr', 'Portfolio Contact'); // Mon email vérifié sur Brevo
                $mail->addReplyTo($email, $nom); // Email du visiteur pour répondre directement
                $mail->addAddress('raja.yb@outlook.fr', 'Raja YAABBA'); // Mon email pour recevoir les messages

                // Contenu du mail
                $mail->isHTML(true);
                $mail->Subject = "Nouveau message du portfolio";
                $mail->Body    = "<strong>Nom :</strong> $nom<br>
                                  <strong>Email :</strong> $email<br>
                                  <strong>Message :</strong><br>$message";
                $mail->AltBody = "Nom: $nom\nEmail: $email\n\nMessage:\n$message";

                // Envoi du mail
                $mail->send();
                $messageStatut = "Votre message a bien été envoyé";
            } catch (Exception $e) {
                $messageStatut = "Erreur lors de l'envoi : " . $mail->ErrorInfo;
            }

            static::afficheVue([
                "pagetitle" => "Contact",
                "messageStatut" => $messageStatut,
                "cheminVueBody" => __DIR__ . "/../View/formulaire.php"
            ]);
        }
    }
}
