<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller
{
    public function listAction()
    {

        $categories = $this->getCategoryManager()->getCategoryRepository()->findAll();

        return $this->render("AdminBundle:Category:list.html.twig",
            [
                "categories" => $categories,
            ]
        );
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $form = $this->getCategoryManager()->getCategoryForm($request);

        if ($form === true) {
            $this->get("session")->getFlashBag()->add("success", "Category saved");
            return $this->redirectToRoute("admin_category_list");
        }
        return $this->render("AdminBundle:Category:form.html.twig", ["form" => $form->createView()]);
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, $id)
    {
        $form = $this->getCategoryManager()->getCategoryForm($request, $id);

        if ($form === true) {
            $this->get("session")->getFlashBag()->add("success", "Category saved");
            return $this->redirectToRoute("admin_category_list");
        }
        return $this->render("AdminBundle:Category:form.html.twig", ["form" => $form->createView()]);
    }

    /**
     * @param $id
     */
    public function deleteAction($id)
    {
        $this->getCategoryManager()->removeCategory($id);
        return $this->redirectToRoute("admin_category_list");
    }

    private function getCategoryManager()
    {
        return $this->get("jobz.category.manager");
    }
}
