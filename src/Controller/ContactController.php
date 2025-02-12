<?php

namespace App\Portfolio\Controller;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../env_loader.php'; // Charge les variables d'environnement

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
                $mail->Host       = getenv('SMTP_HOST'); // Serveur SMTP Mailtrap
                $mail->SMTPAuth   = true;
                $mail->Username   = getenv('SMTP_USERNAME'); // Identifiant SMTP Mailtrap
                $mail->Password   = getenv('SMTP_PASSWORD'); // Mot de passe SMTP Mailtrap
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Sécurité TLS
                $mail->Port       = getenv('SMTP_PORT'); // Port SMTP Mailtrap

                // Expéditeur et destinataire
                $mail->setFrom('contact@rajay.online', 'Portfolio Contact'); // Email vérifié sur Mailtrap
                $mail->addReplyTo($email, $nom); // Réponse au visiteur
                $mail->addAddress('contact@rajay.online', 'Raja YAABBA'); // Mon email pour recevoir les messages
                $mail->addAddress('raja.yb@outlook.fr', 'Raja YAABBA');  // Mon adresse mail personnelle

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
