<?php 
// mode strict
declare(strict_types=1);

namespace App\Controller;
use App\Model\Animal;
use App\Model\AnimalQuery;


class AnimalController extends AbstractController {

    static public function listOne($id) : Animal {
        $animalQuery = new AnimalQuery();
        return $animalQuery->findOne($id);
    }

    static public function show($id) : void {
        $animal = self::listOne($id);

        echo self::getTwig()->render(
            'animal/show.html',
            ['animal' => $animal]
        );
    }

    static public function listAll() : void {
        $animalQuery = new AnimalQuery();
        $animals = $animalQuery->findAll();

        echo self::getTwig()->render('animal/index.html', [
            'animals' => $animals
        ]);
    }

    static public function new() : void {
        echo self::getTwig()->render('animal/new.html');
    }

    
    static public function create() {
        $species = $_POST['species'];
        $country = $_POST['country'];

        $animalQuery = new AnimalQuery();

        $animalQuery->createOne($species, $country);
        self::listAll();
    }
    
    static public function update($id) {
        $species = $_POST['species'];
        $country = $_POST['country'];

        $animalQuery = new AnimalQuery();

        $animalQuery->updateOne($species, $country, $id);
        self::listAll();
    }

    static public function edit($id) : void {
        $animal = self::listOne($id);

        echo self::getTwig()->render(
            'animal/edit.html',
            ['animal' => $animal]
        );
    }
};

?>  