<?php

abstract class Model
{
    private static $PDO;

    //méthode statique qui établit la connexion à la Bdd
    private static function setBdd()
    {

        self::$PDO = new PDO("mysql:host=localhost;dbname=students_cda;charset=utf8", "root", "");
        //setAttribute sert à configurer la gestion des erreurs par PDO lors des interations avec la Bdd
        self::$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    }
    protected function getBdd(){
        //si la connexion à la Bdd n'est pas encore établie, on la crée
        if (self::$PDO==null){
            self::setBdd();
        }
        return self::$PDO;
    }
}
?>