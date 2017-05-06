<?php

namespace JobzBundle\Services;

use Doctrine\ORM\EntityManager;
use JobzBundle\Entity\Category;
use JobzBundle\Form\CategoryType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Created by PhpStorm.
 * User: kovacsgergely
 * Date: 2017.05.06.
 * Time: 19:45
 */
class CategoryManager
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

    public function getCategoryRepository()
    {
        return $this->em->getRepository("JobzBundle:Category");
    }

    public function getCategoryForm(Request $request, $id = null)
    {
        $category = new Category();
        if ($id) {
            $category = $this->getCategoryRepository()->find($id);
        }

        $form = $this->formFactory->create(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->em->persist($category);
            $this->em->flush();
            return true;
        }
        return $form;

    }

    public function removeCategory($id)
    {
        $category = $this->getCategoryRepository()->find($id);
        $this->em->remove($category);
        $this->em->flush();
    }

}