<?php 

namespace App\Controller;
use Twig_Loader_Filesystem;
use Twig_Environment;

abstract class AbstractController 
{
    public static function getTwig() {
        $loader = new Twig_Loader_Filesystem(__DIR__ . "../../View");
        $twig = new Twig_Environment($loader);

        $twig->addGlobal('assets', BASE_PATH . 'assets/' );
        $twig->addGlobal('base_path', BASE_PATH);   

        return $twig;
    }
}

?>