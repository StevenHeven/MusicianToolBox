<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LiveRoomType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Nom de l\'endroit'])
            ->add('adresse', TextType::class, ['label' => 'Adresse'])
            ->add('type', ChoiceType::class, ['choices'=>[
                '' => null,
                'Salle de Concert' => 'Salle',
                'Bar' => 'Bar'
            ]], ['label' => 'Type de l\'endroit'])
            ->add('capacity', IntegerType::class, ['label' => 'Nombre de place / Capacité', 'required' => false])
            ->add('website', TextType::class ,['label' => 'Site Internet', 'required' => false])
            ->add('facebook', TextType::class,['label' => 'Page Facebook', 'required' => false])
            ->add('price', MoneyType::class ,['label' => 'Prix si possible en Location ', 'required' => false])
            ->add('description', TextareaType::class,['attr' =>['rows' => 10]], ['label' => 'Description'])
            ->add('submit', SubmitType::class, ['label' => 'Envoyer']);

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\LiveRoom'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_liveroom';
    }


}
