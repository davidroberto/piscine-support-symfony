<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

// je fais hériter ma classe PageController de la classe AbstractController de Symfony
// ce qui me permet d'utiliser dans ma classe (avec le mot clé $this) des méthodes
// et propriétés définies dans la classe AbstractController
class PageController extends AbstractController
{

    /**
     * je créé une route (donc une page)
     * dans une annotation. Je lui associe l'url "/" qui
     * est la page d'accueil.
     * Ma route va appeler la méthode home, car l'annotation
     * est placée au dessus de la méthode
     * @Route("/", name="home")
     */
    public function home()
    {
        var_dump('page accueil'); die;
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        var_dump('page contact'); die;
    }

    /**
     * @Route("/beuverie", name="beuverie")
     */
    public function beuverie()
    {
        // j'appelle la méthode createFromGlobals() de la classe
        // Request de Symfony
        // qui me permet de récuérer toutes les infos de la requête
        // POST, GET etc
        $request = Request::createFromGlobals();

        // j'utilise la propriété query (qui contient tous les parametres
        // GET), et je cible le parametre GET âge spécifiquement en utilisant
        // la méthode get()
        $age = $request->query->get('age');

        if (!$age) {
            // J'instancie la classe Response
            // du composant HttpFoundation
            // Je stocke l'instance de la classe (ou l'objet)
            // dans une variable $response
            $response = new Response('Merci de remplir l\'âge');
            return $response;
        } elseif($age < 18) {
            // j'utilise la méthode redirectToRoute, issue de la classe
            // étendue AbstractController
            // cette méthode me permet de faire une redirection vers la route
            // donc le nom est "contact"
            $url = $this->generateUrl('route');
            return new RedirectResponse($url);
        } else {
            $response = new Response('Picole');
            return $response;
        }

    }
}
