<?php 
// mode strict
declare(strict_types=1);

namespace App\Controller;
use App\Model\Animal;
use App\Model\AnimalQuery;


class AnimalController extends AbstractController {

    static public function show($id) {
        $animalQuery = new AnimalQuery();
        $animal = $animalQuery->findOne($id);

        echo self::getTwig()->render(
            'animal/show.html',
            ['animal' => $animal]
        );

        var_dump($animal);
    }

    static public function listAll() : void {
        $animalQuery = new AnimalQuery();
        $animals = $animalQuery->findAll();

        var_dump($animals);

        echo self::getTwig()->render('animal/index.html', [
            'animals' => $animals
        ]);
    }
};

?>  