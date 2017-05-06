<?php
/**
 * Created by PhpStorm.
 * User: kovacsgergely
 * Date: 2017.05.06.
 * Time: 20:43
 */

namespace JobzBundle\Services;

use Doctrine\ORM\EntityManager;
use JobzBundle\Entity\Job;
use JobzBundle\Form\JobType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class JobManager
{
    private $em;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    public function __construct(EntityManager $entityManager, FormFactoryInterface $formFactory)
    {
        $this->em = $entityManager;
        $this->formFactory = $formFactory;
    }

    public function getJobRepository()
    {
        return $this->em->getRepository("JobzBundle:Job");
    }

    public function getJobForm(Request $request, $id = null)
    {
        $job = new Job();
        if ($id) {
            $job = $this->getJobRepository()->find($id);
        }

        $form = $this->formFactory->create(JobType::class, $job);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->em->persist($job);
            $this->em->flush();
            return true;
        }
        return $form;

    }

    public function removeJob($id)
    {
        $job = $this->getJobRepository()->find($id);
        $this->em->remove($job);
        $this->em->flush();
    }
}