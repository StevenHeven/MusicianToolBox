<?php

namespace AppBundle\Form;

use AppBundle\Entity\MusicianCategory;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('adress', AdressType::class, ['label' => false])
            ->add('musician', EntityType::class,[
                'class'=>'AppBundle\Entity\MusicianCategory',
                'expanded'=> true,
                'mapped'=> false,
                'label'=>'Je suis',
                'query_builder' => function(EntityRepository $er){
                return $er->createQueryBuilder('musicianCategory')->orderBy('musicianCategory.label', 'ASC');
            }] )
            ->add('submit', SubmitType::class, ['label' => 'Envoyer']);
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }


}
