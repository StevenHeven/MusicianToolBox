<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StoreType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Nom du Magasin'])
            ->add('adress', TextType::class, ['label' => 'Adresse'])
            ->add('website', TextType::class, ['label' => 'Site Internet', 'required' => false])
            ->add('facebook', TextType::class, ['label' => 'Facebook', 'required' => false])
            ->add('description', TextareaType::class,['attr' =>['rows' => 10]], ['label' => 'Description'])
            ->add('submit', SubmitType::class, ['label' => 'Envoyer']);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Store'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_store';
    }


}
