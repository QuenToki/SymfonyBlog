<?php

namespace App\DataFixtures;

use App\Entity\Article;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [UserFixtures::class];
    }

    public function load(ObjectManager $manager): void
    {
        for ($i=0; $i < 5; $i++) { 
            $article = new Article();
            $article->setName("Titre de l'article");
            $article->setContent("Contenu l'article");
            $article->setDate(new Datetime());
            $article->setAuthor($this->getReference('user_' . $i));
            $manager->persist($article);
        }

        $manager->flush();
    }
}
