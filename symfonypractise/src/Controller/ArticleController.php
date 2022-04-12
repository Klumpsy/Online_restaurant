<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/article', name: 'app_article')]
    public function index(ManagerRegistry $doctrine)
    {
        $article = new Article();
        $article->setTitle('My first article');

        $em = $doctrine->getManager();
        // $em->persist($article);
        // $em->flush();

        $getArticle = $em->getRepository(Article::class)->findOneBy([
            'title' => 'My first article'
        ]);

        $em->remove($getArticle);
        $em->flush();

        return $this->render('article/index.html.twig', [
            'articles' => $getArticle,
        ]);
    }
}
