<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Information;
use AdminBundle\Form\InformationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class InformationController extends Controller
{
    public function listAction()
    {
        $informations = $this->getDoctrine()->getRepository("AdminBundle:Information")->findAll();
        return $this->render('AdminBundle:Information:list.html.twig', ["informations" => $informations]);
    }

    public function newAction(Request $request)
    {
        $information = new Information();

        $form = $this->getInformationForm($request, $information);

        if ($form === true) {
            $this->get("session")->getFlashBag()->add("succes", "Information saved");
            $this->redirectToRoute("admin_information_list");
        }

        return $this->render("AdminBundle::simple_form.html.twig",
            [
                "form" => $form->createView(),
            ]
        );
    }

    public function editAction(Request $request, $id)
    {
        $information = $this->getDoctrine()->getRepository("AdminBundle:Information")->find($id);

        $form = $this->getInformationForm($request, $information);

        if ($form === true) {
            $this->get("session")->getFlashBag()->add("succes", "Information saved");
            $this->redirectToRoute("admin_information_list");
        }

        return $this->render("AdminBundle::simple_form.html.twig",
            [
                "form" => $form->createView()
            ]
        );


    }

    /**
     * @param Request $request
     * @param Information $information
     * @return \Symfony\Component\Form\Form|bool
     */
    protected function getInformationForm(Request $request, Information $information)
    {
        $form = $this->createForm(InformationType::class, $information);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($information);
            $em->flush();
            return true;
        }
        return $form;
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $information = $em->getRepository("AdminBundle:Information")->find($id);
        $em->remove($information);
        $em->flush();
        $this->get("session")->getFlashBag()->add("success", "Information removed");
        return $this->redirectToRoute("admin_information_list");
    }
}
