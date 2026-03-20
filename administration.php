
<?php
require_once "StudentManager.class.php";
$students = new StudentManager();

$students->loadStudents();


 ob_start();?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Administration — Scholia</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/admin.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
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
            <div class="stat-value"><?= count($students->getStudent()) ?></div>
            <div class="stat-label">Étudiants</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon orange"><i class="fas fa-user-check"></i></div>
          <div>
            <div class="stat-value">12</div>
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
              <?php foreach ($students->getStudent() as $etudiant){ ?>
              <tr>
                <td class="td-num"><?= $etudiant->getId() ?></td>
                <td>
                  <div class="table-avatar">
                    <img src="img\<?= $etudiant->getPhoto() ?>" alt="<?= $etudiant->getNom() . " " . $etudiant->getPrenom() ?>"/>
                  </div>
                </td>
                <td class="td-name"><?= $etudiant->getNom()." ". $etudiant->getPrenom() ?> </td>
                <td class="td-email"><?= $etudiant->getAge() ?></td>      
                <td><a href="<?= $etudiant->getGithub() ?>" class="td-link"><i class="fab fa-github"></i></a></td>
                <td><a href="<?= $etudiant->getLinkedin() ?>" class="td-link linkedin"><i class="fab fa-linkedin-in"></i></a></td>
                <td><a href="<?= $etudiant->getPortfolio() ?>" class="td-link portfolio"><i class="fas fa-globe"></i></a></td>
                <td>
                  <div class="action-btns">
                    <a href="#form-edit" class="action-btn edit" title="Modifier">
                      <i class="fas fa-pen"></i>
                    </a>
                    <button class="action-btn delete" title="Supprimer">
                      <i class="fas fa-trash"></i>
                    </button>
                  </div>
                </td>
              </tr>

             <?php }?>
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

        <form class="admin-form" action="#">
          <div class="form-row">
            <div class="form-group">
              <label for="add-nom">Nom complet *</label>
              <input id="add-nom" type="text" placeholder="Prénom Nom" required />
            </div>
            <div class="form-group">
              <label for="add-email">Email *</label>
              <input id="add-email" type="email" placeholder="prenom@exemple.fr" required />
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="add-github">GitHub</label>
              <div class="input-icon">
                <i class="fab fa-github"></i>
                <input id="add-github" type="url" placeholder="https://github.com/..." />
              </div>
            </div>
            <div class="form-group">
              <label for="add-linkedin">LinkedIn</label>
              <div class="input-icon">
                <i class="fab fa-linkedin-in"></i>
                <input id="add-linkedin" type="url" placeholder="https://linkedin.com/in/..." />
              </div>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="add-portfolio">Portfolio</label>
              <div class="input-icon">
                <i class="fas fa-globe"></i>
                <input id="add-portfolio" type="url" placeholder="https://monsite.fr" />
              </div>
            </div>
            <div class="form-group">
              <label for="add-photo">Photo</label>
              <div class="input-icon">
                <i class="fas fa-image"></i>
                <input id="add-photo" type="text" placeholder="img/prenom-nom.jpg" />
              </div>
            </div>
          </div>

          <div class="form-footer">
            <button type="reset" class="btn-secondary">
              <i class="fas fa-times"></i> Annuler
            </button>
            <button type="submit" class="btn-primary">
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

        <form class="admin-form" action="#">
          <div class="form-row">
            <div class="form-group">
              <label for="edit-nom">Nom complet *</label>
              <input id="edit-nom" type="text" value="Yan Boutou" required />
            </div>
            <div class="form-group">
              <label for="edit-email">Email *</label>
              <input id="edit-email" type="email" value="yan@exemple.fr" required />
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="edit-github">GitHub</label>
              <div class="input-icon">
                <i class="fab fa-github"></i>
                <input id="edit-github" type="url" value="https://github.com/yan" />
              </div>
            </div>
            <div class="form-group">
              <label for="edit-linkedin">LinkedIn</label>
              <div class="input-icon">
                <i class="fab fa-linkedin-in"></i>
                <input id="edit-linkedin" type="url" value="https://linkedin.com/in/yan" />
              </div>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="edit-portfolio">Portfolio</label>
              <div class="input-icon">
                <i class="fas fa-globe"></i>
                <input id="edit-portfolio" type="url" value="https://yanboutou.fr" />
              </div>
            </div>
            <div class="form-group">
              <label for="edit-photo">Photo</label>
              <div class="input-icon">
                <i class="fas fa-image"></i>
                <input id="edit-photo" type="text" value="img/yan-boutou.avif" />
              </div>
            </div>
          </div>

          <div class="form-footer">
            <button type="reset" class="btn-secondary">
              <i class="fas fa-times"></i> Annuler
            </button>
            <button type="submit" class="btn-primary btn-save">
              <i class="fas fa-save"></i> Enregistrer
            </button>
          </div>
        </form>
      </div>

    </section>
  </main>
</body>

<?php $content= ob_get_clean();
require "template.php";
?>
</html>