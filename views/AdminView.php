<?php
ob_start(); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Administration — Scholia</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet" />
</head>

<body>


  <main class="container">
    <section class="admin-section">

      <!-- ── EN-TÊTE ── -->
      <div class="admin-header">
        <div>
          <h1>Administration <span>Étudiants</span></h1>
          <p class="admin-sub">Gérez les fiches de la promotion 2025</p>
        </div>
        <a href="#form-ajout" class="btn-primary">
          <i class="fas fa-plus"></i> Ajouter un étudiant
        </a>
      </div>

      <!-- ── STATS ── -->
      <div class="stats-row">
        <div class="stat-card">
          <div class="stat-icon"><i class="fas fa-users"></i></div>
          <div>
            <div class="stat-value"><?= count($students) ?></div>
            <div class="stat-label">Étudiants</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon orange"><i class="fas fa-user-check"></i></div>
          <div>
            <div class="stat-value"><?= $completeProfiles ?></div>
            <div class="stat-label">Profils complets</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon teal"><i class="fas fa-calendar-alt"></i></div>
          <div>
            <div class="stat-value">2025</div>
            <div class="stat-label">Promotion</div>
          </div>
        </div>
      </div>

      <!-- ── TABLEAU ── -->

      <div class="table-card">
        <div class="table-toolbar">
          <span class="table-title"><i class="fas fa-list"></i> Liste des étudiants</span>
          <div class="table-actions">
            <div class="search-box">
              <i class="fas fa-search"></i>
              <input type="text" placeholder="Rechercher..." />
            </div>
          </div>
        </div>

        <div class="table-wrap">
          <table class="admin-table">
            <thead>
              <tr>
                <th>id</th>
                <th>Photo</th>
                <th>Nom</th>
                <th>Age</th>
                <th>GitHub</th>
                <th>LinkedIn</th>
                <th>Portfolio</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 1;
              foreach ($students as $etudiant) {
              ?>
                <tr>
                  <td class="td-num"><?= $i++ ?></td>
                  <td>
                    <div class="table-avatar">
                      <img src="<?= BASE_URL ?>public/img/<?= $etudiant->getPhoto() ?>" alt="<?= $etudiant->getNom() . " " . $etudiant->getPrenom() ?>" />
                    </div>
                  </td>
                  <td class="td-name">
                    <?= $etudiant->getNom() . " " . $etudiant->getPrenom() ?>
                   </td>
                  <td class="td-age"><?= $etudiant->getAge() . " ans" ?></td>
                  <td><a href="<?= $etudiant->getGithub() ?>" class="td-link"><i class="fab fa-github"></i></a></td>
                  <td><a href="<?= $etudiant->getLinkedin() ?>" class="td-link linkedin"><i class="fab fa-linkedin-in"></i></a></td>
                  <td><a href="<?= $etudiant->getPortfolio() ?>" class="td-link portfolio"><i class="fas fa-globe"></i></a></td>
                  <td>
                    <div class="action-btns">
                      <a href="admin&id_edit=<?= $etudiant->getId() ?>#form-edit" class="action-btn edit">
                        <i class="fas fa-pen"></i>
                      </a>
                      <form method="post" action="delete">
                        <input type="hidden" name="id_delete" value="<?= $etudiant->getId() ?>">
                        <button class="action-btn delete" name="delete" value="Supprimer" title="Supprimer">
                          <i class="fas fa-trash"></i>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>

              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- ── FORMULAIRE AJOUT ── -->
      <div class="form-card" id="form-ajout">
        <div class="form-card-header">
          <i class="fas fa-user-plus"></i>
          <h2>Ajouter un étudiant</h2>
        </div>

        <form id="addForm" class="admin-form" action="add" method="post" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group">
              <label for="add-nom">Nom</label>
              <input id="add-nom" name="nom" value="" type="text" placeholder="Nom" required />
            </div>
            <div class="form-group">
              <label for="add-prenom">Prénom</label>
              <input id="add-prenom" name="prenom" value="" type="text" placeholder="Prénom" required />
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="add-age">Âge </label>
              <input id="add-age" name="age" value="" type="text" placeholder="Âge" required />
            </div>
            <div class="form-group">
              <label for="add-github">GitHub</label>
              <div class="input-icon">
                <i class="fab fa-github"></i>
                <input id="add-github" name="github" value="" type="url" placeholder="https://github.com/..." />
              </div>
            </div>

          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="add-portfolio">Portfolio</label>
              <div class="input-icon">
                <i class="fas fa-globe"></i>
                <input id="add-portfolio" name="portfolio" value="" type="url" placeholder="https://monsite.fr" />
              </div>
            </div>
            <div class="form-group">
              <label for="add-linkedin">LinkedIn</label>
              <div class="input-icon">
                <i class="fab fa-linkedin-in"></i>
                <input id="add-linkedin" name="linkedin" value="" type="url" placeholder="https://linkedin.com/in/..." />
              </div>
            </div>

          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="add-photo">Photo</label>
              <input id="add-photo" type="file" name="photo">
            </div>
            <div class="form-group">
              <label for="add-description">Description</label>
              <textarea id="add-description" name="description" value="" placeholder="Description"></textarea>
            </div>
          </div>

          <div class="form-footer">
            <button type="reset" name="reset" value="Annuler" class="btn-secondary">
              <i class="fas fa-times"></i> Annuler
            </button>
            <button type="submit" name="submit" value="Ajouter" class="btn-primary">
              <i class="fas fa-plus"></i> Ajouter
            </button>
          </div>
        </form>
      </div>

      <!-- ── FORMULAIRE MODIFICATION ── -->
      <div class="form-card" id="form-edit">
        <div class="form-card-header edit">
          <i class="fas fa-user-edit"></i>
          <h2>Modifier un étudiant</h2>
        </div>
        <div class="card-img">
						<div class="avatar">
							<img src="<?= BASE_URL ?>public/img/<?= $etudiantAModifier["photo"] ?>" alt="<?= $etudiantAModifier["nom"] . " " . $etudiantAModifier["prenom"] ?>" />
						</div>
					</div>

        <form id="editForm" class="admin-form" action="update" method="post" enctype="multipart/form-data">
          <input name="id" type="hidden" value="<?= $etudiantAModifier["id"] ?>" />

          <div class="form-row">
            <div class="form-group">
              <label for="edit-nom">Nom</label>
              <input id="edit-nom" name="nom" type="text" value="<?= $etudiantAModifier["nom"] ?? '' ?>" required />
            </div>
            <div class="form-group">
              <label for="edit-prenom">Prénom</label>
              <input id="edit-prenom" name="prenom" type="text" value="<?= $etudiantAModifier["prenom"] ?? '' ?>" required />
            </div>

          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="edit-age">Âge</label>
              <input id="edit-age" name="age" type="text" value="<?= $etudiantAModifier["age"] ?? '' ?>" required />
            </div>
            <div class="form-group">
              <label for="edit-github">GitHub</label>
              <div class="input-icon">
                <i class="fab fa-github"></i>
                <input id="edit-github" name="github" type="url" value="<?= $etudiantAModifier["github"] ?? '' ?>" />
              </div>
            </div>

          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="edit-linkedin">LinkedIn</label>
              <div class="input-icon">
                <i class="fab fa-linkedin-in"></i>
                <input id="edit-linkedin" name="linkedin" type="url" value="<?= $etudiantAModifier["linkedin"] ?? '' ?>" />
              </div>
            </div>
            <div class="form-group">
              <label for="edit-portfolio">Portfolio</label>
              <div class="input-icon">
                <i class="fas fa-globe"></i>
                <input id="edit-portfolio" name="portfolio" type="url" value="<?= $etudiantAModifier["portfolio"] ?? '' ?>" />
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="edit-photo">Photo</label>
              <div class="input-icon">
                <i class="fas fa-image"></i>
                <input name="photo_actuelle" type="hidden" value="<?= $etudiantAModifier["photo"] ?? '' ?>" />
                 <input id="edit-photo" type="file" name="photo">
              </div>
            </div>
            <div class="form-group">
              <label for="edit-description">Description</label>
              <textarea name="description">
            <?= $etudiantAModifier["description"] ?? '' ?>
          </textarea>
            </div>
          </div>
          <div class="form-footer">
            <button type="reset" class="btn-secondary">
              <i class="fas fa-times"></i> Annuler
            </button>
            <button type="submit" name="submit" value="Enregistrer" class="btn-primary btn-save">
              <i class="fas fa-save"></i> Enregistrer
            </button>
          </div>
        </form>
      </div>

    </section>
  </main>
</body>

<?php $content = ob_get_clean();
require "views/template.php";
?>

</html>