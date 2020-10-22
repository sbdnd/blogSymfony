<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\Comment;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PostFixtures extends Fixture
{
    /**
     * Créé des Posts en bdd
     *
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 25; $i++){
            $post = new Post();
            $post->setTitle("Article n°".$i )
                ->setContent("Contenu de l'article n°".$i)
            ;
            $manager->persist($post);

            for ($j = 1; $j <= rand(2, 10); $j++){
                $comment = new Comment();
                $comment->setAuthor("Auteur n°".$i)
                    ->setContent("Commentaire n°".$j)
                    ->setPost($post);
                $manager->persist($comment);
            }
        }
        $manager->flush();
    }
}
