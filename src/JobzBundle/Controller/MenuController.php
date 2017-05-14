<?php

namespace JobzBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MenuController extends Controller
{
    public function indexAction($position)
    {
        $menuElements = $this->getDoctrine()->getRepository("AdminBundle:Menu")->findBy(
            ["position" => $position],
            ["sortOrder" => "ASC"]
        );
        return $this->render('JobzBundle::_menu.html.twig', ['menuElements' => $menuElements]);
    }
}
