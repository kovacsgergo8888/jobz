<?php

namespace JobzBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("company", TextType::class)
            ->add("type", ChoiceType::class, [
                "choices" => [
                    "Full-time" => "full-time",
                    "Part-time" => "part-time",
                    "Freelance" => "freelance",
                ]
            ])
            ->add("url", TextType::class)
            ->add("position", TextType::class)
            ->add("location", TextType::class)
            ->add("email", TextType::class)
            ->add("description", TextareaType::class)
            ->add("how_to_apply", TextType::class)
            ->add("category", EntityType::class, [
                "class" => "JobzBundle\Entity\Category",
                "choice_label" => "name"
            ])
            ->add("submit", SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'jobz_bundle_job_type';
    }
}
