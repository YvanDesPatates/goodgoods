<?php
require_once(File::build_path(array("config", "Configuration.php")));

class Model {
// class singleton

    private static $pdo = NULL;

    public static function init()
    {
        $login = Configuration::getLogin();
        $hostname = Configuration::getHostname();
        $database_name = Configuration::getDatabase();
        $password = Configuration::getPassword();

        try {
            self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name", $login, $password,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            if (Configuration::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
                echo "erreur juste la";
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }


    static public function getPDO()
    {
        if (is_null(self::$pdo)) {
            self::init();
        }
        return self::$pdo;
    }

}

?>
