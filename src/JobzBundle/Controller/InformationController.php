<?php

namespace JobzBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InformationController extends Controller
{
    public function showAction($id)
    {
        $information = $this->getDoctrine()->getRepository("AdminBundle:Information")->find($id);
        return $this->render('JobzBundle:Information:show.html.twig', ["information" => $information]);
    }
}
