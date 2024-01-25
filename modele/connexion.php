<?php
class Connexion
{
    private $db;
    public function __construct()
    {
        $db_config['SGBD'] = 'mysql';
        $db_config['HOST'] = 'yourhost';
        $db_config['DB_NAME'] = 'yourdbname';
        $db_config['USER'] = 'yourusername';
        $db_config['PASSWORD'] = 'yourpassword';
        try {
            $this->db = new PDO(
                $db_config['SGBD'] . ':host=' . $db_config['HOST'] . ';dbname=' . $db_config['DB_NAME'],
                $db_config['USER'],
                $db_config['PASSWORD'],
                array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
            );
            unset($db_config);
        } catch (Exception $exception) {
            die($exception->getMessage());
        }

    }

    public function execSQL(string $req, array $valeurs = []): array | null
    {
        try {
            $sql = $this->db->prepare($req);
            $sql->execute($valeurs);
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $exception) {
            die($exception->getMessage());
        }
    }
}
?>