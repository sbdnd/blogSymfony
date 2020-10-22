<?php
namespace App\Controller;

use App\Entity\Post;
use App\Entity\Comment;
use App\Form\CommentType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends AbstractController
{
    /**
     * @Route("/", name="index")
     *
     * @return Response
     */
    public function index(): Response
    {
        $posts = $this->getDoctrine()->getRepository(Post::class)->getAllPost();
        return $this->render("index.html.twig", [
            "posts" => $posts,
        ]);
    }

    /**
     * @Route("/article-{id}", name="blog_article")
     *
     * @return Response
     */
    public function read(Post $post, Request $request): Response
    {
        $comment = new Comment();
        $comment->setPost($post);
        $form = $this->createForm(CommentType::class, $comment)->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
            return $this->redirectToRoute("blog_article", ["id" => $post->getId()]);
        }
        return $this->render("article.html.twig", [
            "post" => $post,
            "form" => $form->createView()
        ]);
    }


}