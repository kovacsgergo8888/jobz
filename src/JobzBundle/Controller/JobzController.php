<?php

namespace JobzBundle\Controller;

use Doctrine\Common\Persistence\ObjectRepository;
use JobzBundle\Entity\Job;
use JobzBundle\Form\JobType;
use JobzBundle\Repository\JobRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\User;

class JobzController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction()
    {
        $latestJobs = $this->getJobRepository()->findLatest();
        foreach ($latestJobs as $latestJob) {
            $categories[$latestJob->getCategory()->getId()] = $latestJob->getCategory();
        }
        return $this->render('JobzBundle:Jobs:home.html.twig', ["categories" => $categories]);
    }

    /**
     * @param $id
     * @return Response
     */
    public function showCatgoryAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository("JobzBundle:Category")->find($id);
        $jobs = $em->getRepository("JobzBundle:Job")->findByCategory($category);

        return $this->render('JobzBundle:Jobs:category.html.twig',
            [
                "category" => $category,
                "jobs" => $jobs,
            ]
        );
    }

    /**
     * @param Request $request
     * @return Response
     * @internal param $keyword
     */
    public function searchAction(Request $request)
    {
        $keyword = $request->get("keyword");

        $jobs = $this->getJobRepository()->searchByKeywords($keyword);

        return $this->render("JobzBundle:Jobs:search.html.twig",
            [
                "jobs" => $jobs,
                "keyword" => $keyword,
            ]
        );
    }

    /**
     * @param $id
     * @return Response
     */
    public function showJobAction($id)
    {
        $job = $this->getJobRepository()->find($id);
        return $this->render('JobzBundle:Jobs:job.thml.twig',
            [
                "job" => $job,
            ]
        );
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function newJobAction(Request $request)
    {
        $job = new Job();

        $form = $this->createForm(JobType::class, $job);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $job->setEmail($this->getUser()->getEmail());
            $em->persist($job);
            $em->flush();
            $this->addFlash("success", "Job Saved!");
            return $this->redirectToRoute("jobz_home");
        }

        return $this->render("JobzBundle:Jobs:new_job.html.twig",
            [
                "form" => $form->createView(),
            ]
        );
    }

    /**
     * @return ObjectRepository|JobRepository
     */
    protected function getJobRepository()
    {
        return $this->getDoctrine()->getRepository("JobzBundle:Job");
    }

}
