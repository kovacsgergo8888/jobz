<?php

namespace AdminBundle\Form;


use AdminBundle\Entity\Information;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("position", ChoiceType::class,[
                "choices" => [
                    "head" => "head",
                    "foot" => "foot",
                ]
            ])
            ->add("sortOrder", IntegerType::class)
            ->add("information", EntityType::class, [
                "class" => Information::class,
                "choice_label" => "title",
            ])
            ->add("submit", SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'admin_bundle_menu_type';
    }
}
