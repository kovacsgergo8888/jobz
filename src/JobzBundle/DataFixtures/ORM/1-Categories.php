<?php
/**
 * Created by PhpStorm.
 * User: kovacsgergely
 * Date: 2017.05.06.
 * Time: 13:16
 */

namespace JobzBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use JobzBundle\Entity\Category;

class Categories implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $categories = [
            "Design",
            "Programming",
            "Buisness",
        ];

        foreach ($categories as $category) {
            $categoryEntity = new Category();
            $categoryEntity->setName($category);
            $manager->persist($categoryEntity);
        }
        $manager->flush();

    }
}