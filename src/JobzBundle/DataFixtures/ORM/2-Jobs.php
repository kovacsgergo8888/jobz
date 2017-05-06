<?php
/**
 * Created by PhpStorm.
 * User: kovacsgergely
 * Date: 2017.05.02.
 * Time: 22:27
 */

namespace JobzBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use JobzBundle\Entity\Job;

class Jobs implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $jobs = [
            ["freelance", "asdf.hu", "developer", "Budapest", "sdfsdf@sdf.hu", "Something Corporation",$this->getCategory("Programming", $manager), "laseoaisejfpaoisej fgpaoisje fgopais ejaoej aioejgaiosje gopiasj egpoiajseoigjasegioj p", "aosiejfasiojef"],
            ["freelance", "asdf.hu", "developer", "Pécs", "sdfsdf@sdf.hu", "Something Corporation",$this->getCategory("Programming", $manager), "laseoaisejfpaoisej fgpaoisje fgopais ejaoej aioejgaiosje gopiasj egpoiajseoigjasegioj p", "aosiejfasiojef"],
            ["freelance", "asdf.hu", "designer", "Debrecen", "sdfsdf@sdf.hu", "Something Corporation",$this->getCategory("Design", $manager), "laseoaisejfpaoisej fgpaoisje fgopais ejaoej aioejgaiosje gopiasj egpoiajseoigjasegioj p", "aosiejfasiojef"],
            ["freelance", "asdf.hu", "CTO", "Kisfalu", "sdfsdf@sdf.hu", "Something Corporation",$this->getCategory("Buisness", $manager), "laseoaisejfpaoisej fgpaoisje fgopais ejaoej aioejgaiosje gopiasj egpoiajseoigjasegioj p", "aosiejfasiojef"],
        ];

        foreach ($jobs as $job) {

            $jobEntity = new Job();

            $jobEntity->setType($job[0]);
            $jobEntity->setUrl($job[1]);
            $jobEntity->setPosition($job[2]);
            $jobEntity->setLocation($job[3]);
            $jobEntity->setEmail($job[4]);
            $jobEntity->setCompany($job[5]);
            $jobEntity->setCategory($job[6]);
            $jobEntity->setDescription($job[7]);
            $jobEntity->setHowToApply($job[8]);

            $manager->persist($jobEntity);
        }
        $manager->flush();
    }

    protected function getCategory($name, ObjectManager $manager)
    {
        return $manager->getRepository("JobzBundle:Category")->findOneBy(["name" => $name]);
    }

}