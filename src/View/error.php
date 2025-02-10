<?php if (!empty($errorMessage)): ?>
    <!-- Affiche le message d'erreur si disponible -->
    <p class="message-error"><?= htmlspecialchars($errorMessage) ?></p>
<?php else: ?>
    <!-- Affiche un message d'erreur générique si aucun message d'erreur n'est disponible -->
    <p class="message-error">Une erreur est survenue. Redirection en cours...</p>
<?php endif; ?>