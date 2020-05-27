<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    // Un commetaire qui commence par @ est une annotation très iportante, Symfony explique que lorsqu'on lancera wwww.monsite
    //on fera appel a la méthode index()
    // Pas besoin de préciser templates/blog/index.html.twig, Symfony sait où se trouve les fichiers templates de rendu .
    
    /**
     * @Route("/blog", name="blog")
     */
    public function index(Article $article)
    {   
        /*
            Pour selectionner des données en BDD, nous avons besoin de la classe Repository de la classe Article
            Une classe Repository permet uniquement de selectionner des données en BDD (requete SQL SELECT)
            On a besoin de l'ORM DOCTRINE pour faire la relation entre la BDD et notre application (getDoctrine())
            getRepository() : méthode issue de l'objet DOCTRINE qui permet d'importer une classe Repository (SELECT)

            $repo est un objet issu de la classe ArticleRepository, cette contient des méthodes prédéfinies par SYMFONY permettant de selectionner des données en BDD (find, findBy, findOneBy, findAll)

            dump() : équivalent de var_dump(), permet d'observer le resultat de la requete de selection en bas de la page dans la barre administrative (cible à droite)
        */

        //$repo = $this->getDoctrine()->getRepository(Article::class);

        //$articles = $repo->find($id);
        // findAll() est une méthode issue de la classe ArticleRepository qui permet de selectionner l'ensemble de la table (similaire à SELECT * FROM article)

        

        dump($articles);

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles'=> $articles

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
     * @Route("/blog/new", name="blog_create")
     */
    public function create(Request $request)
    {
        dump($request);
        
        return $this->render('blog/create.html.twig');
    }

    /**
     * @Route("/blog/{id}", name="blog_show")
     */
    public function show($id)
    {

        /**
         * on appelle doctrine cra c'est lui qui fais la navette pour nous jusqu'a la bdd pour porter 
         * nos requete SQL, ensuite on prend une méthode issue de doctrine qui est getRepository qui va 
         * faire une requete de selection (qui sera acheminer par doctrine) dans la class ARTICLES du fichier
         * articleRepository ( rappel article Repositiry a été créer automatiquement a la création de l'unité "article)
         */
        $repo = $this->getDoctrine()->getRepository(Article::class);

        $article = $repo->find($id);

        dump($article);

        return $this->render('blog/show.html.twig',[
            'article' => $article
        ]);
    }


}
/* Injections de dépendances

Dans symfony nous avons un service container , tout ce qui est dans Symfony est géré par Symfony
Si nous observons la class BlogController nous ne l'avons jamais instancier , c'est Symfony qui l'a fait pour nous
donc il nstancie les classe et appelle les fonctions

Dans Symfony c'es objets utiles sont appellés 'services et chaque service vit a l'intérieur d'un objet très spécial appelé conteneur de service
il vous facilite l avie favorise une architecture solide et super rapide

