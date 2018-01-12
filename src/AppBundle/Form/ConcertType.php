<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConcertType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Titre de l\'événement'])
            ->add('price', MoneyType::class, ['label' => 'Prix de l\'entrée', 'required'=>false, 'attr'=>['value' => 0]])
            ->add('date', null, ['label' => 'Date et heure de l\'événement'])
            ->add('style', null, ['expanded'=>true, 'query_builder' => function(EntityRepository $er){
                return $er->createQueryBuilder('musicCategory')->orderBy('musicCategory.label', 'ASC');
            }])
            ->add('website', TextType::class ,['label' => 'URL', 'required' => false])
            ->add('facebook', TextType::class,['label' => 'Evénement Facebook', 'required' => false])
            ->add('description', TextareaType::class, ['label' => 'Description','attr' =>['rows' => 10]])
            ->add('liveroom', EntityType::class, ['class' => 'AppBundle\Entity\LiveRoom','choice_label' => 'name', 'label' => 'Salle de concert', "mapped"=> false])
            ->add('submit', SubmitType::class, ['label' => 'Envoyer']);;

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Concert'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_concert';
    }


}
