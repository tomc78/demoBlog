<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    // Un commetaire qui commence par @ est une annotation très iportante, Symfony explique que lorsqu'on lancera wwww.monsite
    //on fera appel a la méthode index()
    // Pas besoin de préciser templates/blog/index.html.twig, Symfony sait où se trouve les fichiers templates de rendu .
    
    /**
     * @Route("/blog", name="blog")
     */
    public function index()
    {   
        /*
            Pour selectionner des données en BDD, nous avons besoin de la classe Repository de la classe Article
            Une classe Repository permet uniquement de selectionner des données en BDD (requete SQL SELECT)
            On a besoin de l'ORM DOCTRINE pour faire la relation entre la BDD et notre application (getDoctrine())
            getRepository() : méthode issue de l'objet DOCTRINE qui permet d'importer une classe Repository (SELECT)

            $repo est un objet issu de la classe ArticleRepository, cette contient des méthodes prédéfinies par SYMFONY permettant de selectionner des données en BDD (find, findBy, findOneBy, findAll)

            dump() : équivalent de var_dump(), permet d'observer le resultat de la requete de selection en bas de la page dans la barre administrative (cible à droite)
        */

        $repo = $this->getDoctrine()->getRepository(Article::class);

        $articles = $repo->findAll();
        // findAll() est une méthode issue de la classe ArticleRepository qui permet de selectionner l'ensemble de la table (similaire à SELECT * FROM article)

        

        dump($articles);

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }

    /** 
     * @Route("/", name="home") 
    */
    public function home()
    {
        return $this->render('blog/home.html.twig', [
            'title'=>'Bienvenue sur le blog Symfony',
            'age'=> 25
            
        ]);
    }

    /**
     * @Route("/blog/45", name="blog_show")
     */
    public function show()
    {
        return $this->render('blog/show.html.twig');
    }

    /**
     * @Route("/blog/46", name="blog_create")
     */
    public function create()
    {
        return $this->render('blog/create.html.twig');
    }
}


