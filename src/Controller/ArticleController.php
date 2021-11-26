<?php


namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController
{

    /**
     * @Route("/article-get", name="article_get")
     */
    public function articleGetShow()
    {
        // je simule une requête en BDD qui récupère des
        // titres d'articles en bdd
       $articles = [
           "article 1",
           "article 2",
           "article 3",
           "article 4",
           "article 5",
           "article 6"
       ];

       // je récupère toutes les données de la requête
        // de l'utilisateur en utilisant la méthode
        // createFromGlobals de la classe Request
       $request = Request::createFromGlobals();

       // maintenant que j'ai récupéré les données de la requête
        // je peux récupérer les parametres d'url de la requête
        // et notamment le parametre "article"
        // ce qui me permet de savoir quel article a été par l'utilisateur
       $article = $request->query->get('article');

       // je récupère dans le tableau d'article
        // l'article demandé par l'utilisateur et je le stocke
        // dans la variable $articleRequested
       $articleRequested = $articles[$article];

       // je renvoie en réponse HTTP l'article récupéré
       $response = new Response($articleRequested);
       return $response;
    }

    /**
     * je créé une url qui contient une "wildcard"
     * c'est à dire une portion d'url qui est variable
     * @Route("/article-wildcard/{article}", name="article_wildcard")
     */
    // pour récupérer la valeur de la wildcard
    // je passe un parametre à la méthode qui a le même
    // nom que la wildcard
    // et automatiquement symfony passe en valeur de la valeur de la variable
    // la valeur de la wildcard
    public function articleWildcardShow($article)
    {
        $articles = [
            "article 1",
            "article 2",
            "article 3",
            "article 4",
            "article 5",
            "article 6"
        ];

        $articleRequested = $articles[$article];

        $response = new Response($articleRequested);
        return $response;
    }

}
