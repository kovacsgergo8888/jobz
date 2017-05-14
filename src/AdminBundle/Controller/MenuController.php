<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Menu;
use AdminBundle\Form\MenuType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MenuController extends Controller
{
    public function listAction()
    {
        $menus = $this->getDoctrine()->getRepository("AdminBundle:Menu")->findAll();
        return $this->render('AdminBundle:Menu:list.html.twig', ["menus" => $menus]);
    }

    public function newAction(Request $request)
    {
        $menu = new Menu();

        $form = $this->getMenuForm($request, $menu);

        if ($form === true) {
            $this->get("session")->getFlashBag()->add("success", "Menu added");
            return $this->redirectToRoute("admin_menu_list");
        }
        return $this->render("AdminBundle::simple_form.html.twig", ["form" => $form->createView()]);
    }

    public function editAction(Request $request, $id)
    {
        $menu = $this->getDoctrine()->getRepository("AdminBundle:Menu")->find($id);
        $form = $this->getMenuForm($request, $menu);

        if ($form === true) {
            $this->get("session")->getFlashBag()->add("success", "Menu deleted");
            return $this->redirectToRoute("admin_menu_list");
        }
        return $this->render("AdminBundle::simple_form.html.twig", ["form" => $form->createView()]);
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $menu = $em->getRepository("AdminBundle:Menu")->find($id);
        $em->remove($menu);
        $em->flush();
        return $this->redirectToRoute("admin_menu_list");
    }

    protected function getMenuForm(Request $request, Menu $menu)
    {
        $form = $this->createForm(MenuType::class, $menu);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($menu);
            $em->flush();
            return true;
        }
        return $form;
    }
}
