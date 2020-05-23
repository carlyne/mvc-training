<?php 

namespace App\Model;
use PDO;

class AnimalQuery extends HandleQuery
{

    public function __construct(string $tableName, array $tableFields = ['*'])
    {   
        parent::__construct($tableName, $tableFields);
    }

    public function getPdo() : PDO 
    {
        return new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function findOne(int $id) : ?Animal 
    {
        $bdd = $this->getPdo();

        $query = $this->where('id', ':id')->createSelectQuery();
        
        $statement = $bdd->prepare($query);
        $statement->execute([
            ':id' => $id
        ]);

        $animalData = $statement->fetch();

        if(!$animalData) {
            return null;
        }

        return new Animal( $animalData['id'], $animalData['species'], $animalData['country']);
    }

    public function findAll() : ?array 
    {
        $bdd = $this->getPdo();
        $query = $this->createSelectQuery();

        $statement = $bdd->prepare($query);
        $statement->execute();

        $data = $statement->fetchAll();

        if(!$data) {
            return [];
        };

        $animalObject = [];
        foreach($data as $animalData) {
            $animalObject[] = new Animal( $animalData['id'], $animalData['species'], $animalData['country']);
        }

        return $animalObject;
        
    }

    public function createOne(string $species, string $country)
    {
        $bdd = $this->getPdo();

        $query = 'INSERT INTO animal (species, country) VALUES(:species, :country)';
        $statement = $bdd->prepare($query);
        return $statement->execute([
            ':species' => $species,
            ':country' => $country
        ]);
    }
    
    public function updateOne(string $species, string $country, int $id) 
    {
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