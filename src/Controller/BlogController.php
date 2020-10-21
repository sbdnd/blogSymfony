<?php
namespace App\Controller;

use App\Entity\Post;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class BlogController extends AbstractController
{
    /**
     * @Route("/", name="index")
     *
     * @return Response
     */
    public function index(): Response
    {
        $posts = $this->getDoctrine()->getRepository(Post::class)->findAll();
        return $this->render("index.html.twig", [
            "posts" => $posts,
        ]);
    }

    /**
     * @Route("/article-{id}", name="blog_article")
     *
     * @return Response
     */
    public function read(Post $post): Response
    {
        return $this->render("article.html.twig", [
            "post" => $post
        ]);
    }


}