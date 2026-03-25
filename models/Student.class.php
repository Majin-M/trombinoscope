<?php
 class Student{
    private int $id;
    private string $photo;
    private string $nom;
    private string $prenom;
    private string $github;
    private string $linkedin;
    private string $portfolio;
    private int $age;
    private string $description;

    public function __construct($id,$photo,$nom,$prenom,$github,$linkedin,$portfolio,$age,$description){
        $this->id=$id;
        $this->photo=$photo;
        $this->nom=$nom;
        $this->prenom=$prenom;
        $this->github=$github;
        $this->linkedin=$linkedin;
        $this->portfolio=$portfolio;
        $this->age=$age;
        $this->description=$description;
    }
    //Getters
    public function getId(){return $this->id;}
    public function getPhoto(){return $this->photo;}
    public function getNom(){return $this->nom;}
    public function getPrenom(){return $this->prenom;}
    public function getGithub(){return $this->github;}
    public function getPortfolio(){return $this->portfolio;}
    public function getLinkedin(){return $this->linkedin;}
    public function getAge(){return $this->age;}
    public function getDescription(){return $this->description;}

    //Setters
    public function setPhoto($nouvellePhoto){$this->photo=$nouvellePhoto;}
    public function setNom($nouveauNom){$this->nom=$nouveauNom;}
    public function setPrenom($nouveauPrenom){$this->prenom=$nouveauPrenom;}
    public function setGithub($nouveauGithub){$this->github=$nouveauGithub;}
    public function setPortfolio($nouveauPortfolio){$this->portfolio=$nouveauPortfolio;}
    public function setLinkedin($nouveauLinkedin){$this->linkedin=$nouveauLinkedin;}
    public function setAge($nouvelAge){$this->age=$nouvelAge;}
    public function setDescription($nouvelleDescription){$this->description=$nouvelleDescription;}

    


 }
?>