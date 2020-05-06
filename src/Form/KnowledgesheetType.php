<?php

namespace App\Form;

use App\Entity\Context;
use App\Entity\Knowledgesheet;
use Doctrine\DBAL\Types\StringType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KnowledgesheetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',TextType::class,['label'=>'Titre'])
            ->add('content', CKEditorType::class,['label'=>'Contenu'])
            ->add('keyword',TextType::class,['label' =>'Mot-clé'])
        ;

        $builder->add('contexts', EntityType::class, [
            'class' => Context::class,
            'choice_label' => 'name',
            'multiple' => true,
            'expanded' => true,
        ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Knowledgesheet::class,
        ]);
    }
}
