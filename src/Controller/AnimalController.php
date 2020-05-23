<?php 
// mode strict
declare(strict_types=1);

namespace App\Controller;
use App\Model\Animal;
use App\Model\AnimalQuery;


class AnimalController extends AbstractController {

    static public function listOne(int $id) : Animal {
        $animalQuery = new AnimalQuery('animal');
        return $animalQuery->findOne($id);
    }

    static public function show(int $id) : void {
        $animal = self::listOne($id);

        echo self::getTwig()->render(
            'animal/show.html',
            ['animal' => $animal]
        );
    }

    static public function listAll() : void {
        $animalQuery = new AnimalQuery('animal', ['*']);
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

        $animalQuery = new AnimalQuery('animal');

        $animalQuery->createOne($species, $country);
        self::listAll();
    }
    
    static public function update(int $id) {
        $species = $_POST['species'];
        $country = $_POST['country'];

        $animalQuery = new AnimalQuery('animal');

        $animalQuery->updateOne($species, $country, $id);
        self::listAll();
    }

    static public function edit(int $id) : void {
        $animal = self::listOne($id);

        echo self::getTwig()->render(
            'animal/edit.html',
            ['animal' => $animal]
        );
    }
};

?>  