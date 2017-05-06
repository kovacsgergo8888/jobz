<?php

namespace AdminBundle\Controller;

use JobzBundle\Services\JobManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class JobController extends Controller
{
    public function listAction()
    {

        $jobs = $this->getJobManager()->getJobRepository()->findAll();

        return $this->render("AdminBundle:Job:list.html.twig",
            [
                "jobs" => $jobs,
            ]
        );
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $form = $this->getJobManager()->getJobForm($request);

        if ($form === true) {
            $this->get("session")->getFlashBag()->add("success", "Job saved");
            return $this->redirectToRoute("admin_job_list");
        }
        return $this->render("AdminBundle:Job:form.html.twig", ["form" => $form->createView()]);
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, $id)
    {
        $form = $this->getJobManager()->getJobForm($request, $id);

        if ($form === true) {
            $this->get("session")->getFlashBag()->add("success", "Job saved");
            return $this->redirectToRoute("admin_job_list");
        }
        return $this->render("AdminBundle:Job:form.html.twig", ["form" => $form->createView()]);
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($id)
    {
        $this->getJobManager()->removeJob($id);
        return $this->redirectToRoute("admin_job_list");
    }

    /**
     * @return JobManager
     */
    private function getJobManager()
    {
        return $this->get("jobz.job.manager");
    }
}
