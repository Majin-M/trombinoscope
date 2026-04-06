
<?php
 ob_start();?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Promo</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
	<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap"
		rel="stylesheet" />
	<link rel="stylesheet" href="public/css/style.css" />
	<link rel="stylesheet" href="public/css/perso.css" />
</head>

<body>


	<!-- CONTENU PRINCIPAL -->
	<main class="container">
		<section class="promo-section">
			<h1>Notre Promotion 2025</h1>
			<div class="grid">
				<?php foreach ($students as $etudiant){ ?>
				<div class="card">
					<div class="card-img">
						<div class="avatar">
							<img src="<?= BASE_URL ?>public/img/<?= $etudiant->getPhoto() ?>" alt="<?= $etudiant->getNom() . " " . $etudiant->getPrenom() ?>" />
						</div>
					</div>
					<div class="card-info">
						<h3><?= $etudiant->getNom() . " " . $etudiant->getPrenom() ?></h3>
						<div class="card-links">
							<a href="<?= $etudiant->getGithub() ?>" class="card-link github" title="GitHub">
								<i class="fab fa-github"></i>
							</a>

							<a href="<?= $etudiant->getLinkedin() ?>" class="card-link linkedin" title="LinkedIn">
								<i class="fab fa-linkedin-in"></i>
							</a>

							<a href="<?= $etudiant->getPortfolio() ?>" class="card-link portfolio" title="Portfolio">
								<i class="fas fa-globe"></i>
							</a>
						</div>
					</div>
				</div>
				<?php } ?>
					

			</div>
		</section>
	</main>

</body>
<?php $content = ob_get_clean();
require 'template.php';
?>

</html>