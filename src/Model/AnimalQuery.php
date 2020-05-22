<?php 
// mode strict
declare(strict_types=1);

namespace App\Model;
use PDO;

class AnimalQuery {

    public function getPdo() : PDO {
        return new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function findOne($id) : Animal {
        $bdd = $this->getPdo();

        $query = 'SELECT * FROM animal WHERE id = :id';
        $statement = $bdd->prepare($query);
        $statement->execute([
            ':id' => $id
        ]);

        $animalData = $statement->fetch();

        if(!$animalData) {
            return null;
        }

        return new Animal((int) $animalData['id'], $animalData['species'], $animalData['country']);
    }

    public function findAll() : array {
        $bdd = $this->getPdo();

        $query = 'SELECT * FROM animal';
        $statement = $bdd->prepare($query);
        $statement->execute();

        $data = $statement->fetchAll();

        if(!$data) {
            return [];
        };

        $animalObject = [];
        foreach($data as $animalData) {
            $animalObject[] = new Animal((int) $animalData['id'], $animalData['species'], $animalData['country']);
        }

        return $animalObject;
        
    }

    public function createOne($species, $country){
        $bdd = $this->getPdo();

        $query = 'INSERT INTO animal (species, country) VALUES(:species, :country)';
        $statement = $bdd->prepare($query);
        return $statement->execute([
            ':species' => $species,
            ':country' => $country
        ]);
    }
    
    public function updateOne($species, $country, $id) {
        $bdd = $this->getPdo();

        $query = 'UPDATE animal SET species=:species, country=:country WHERE id=:id';
        $statement = $bdd->prepare($query);
        return $statement->execute([
            ':species' => $species,
            ':country' => $country,
            ':id' => $id
        ]);
    }
};

?>