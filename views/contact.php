<?php ob_start();?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Trombinoscope — Accueil</title>
  <link rel="stylesheet" href="public/css/style.css" />
  <link rel="stylesheet" href="public/css/form.css" />
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;800;900&display=swap" rel="stylesheet" />
</head>

<body>
  <main class="container">
    <section class="contact-section">
  <div class="section-title">
    <h2>Nous Contacter</h2>
  </div>
  <form class="contact-form" action="#">
    <div class="form-row">
      <div class="form-group">
        <label for="nom">Nom *</label>
        <input id="nom" type="text" placeholder="Votre nom" required/>
      </div>
      <div class="form-group">
        <label for="email">Email *</label>
        <input id="email" type="email" placeholder="votre@email.fr" required/>
      </div>
    </div>
    <div class="form-group">
      <label for="sujet">Sujet</label>
      <input id="sujet" type="text" placeholder="Objet de votre message"/>
    </div>
    <div class="form-group">
      <label for="msg">Message *</label>
      <textarea id="msg" rows="6" placeholder="Votre message..."></textarea>
    </div>
    <button type="submit" class="btn-primary">Envoyer →</button>
  </form>
</section>
  </main>

</body>

<?php $content= ob_get_clean();
require 'template.php';
?>
</html>