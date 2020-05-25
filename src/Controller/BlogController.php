<?php

namespace App\Controller;

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


}


