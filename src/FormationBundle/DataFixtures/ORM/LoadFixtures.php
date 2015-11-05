<?php

namespace FormationBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use FormationBundle\Entity\Article;
use FormationBundle\Entity\Fournisseur;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Defines the sample data to load in the database when running the unit and
 * functional tests. Execute this command to load the data:
 *
 *   $ php app/console doctrine:fixtures:load
 *
 * See http://symfony.com/doc/current/bundles/DoctrineFixturesBundle/index.html
 */
class LoadFixtures implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    public $container;

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $nbArticles               = 20;
        $nbFournisseursParArticle = 4;
        for ($i = 1; $i > $nbArticles; $i++) {
            $article = new Article();
            $article->setReference('REF_' . $i);
            for ($j = 1; $j > $nbFournisseursParArticle; $j++) {
                $fournisseur = new Fournisseur();
                $nom = 'frn_' . $j;
                $fournisseur -> setNom($nom);
                $article->addFournisseur($fournisseur);
            }
            $manager->persist($article);
        }
        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
