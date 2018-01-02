<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OfferType extends AbstractType
{


    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', null, ['label' => 'Catégorie'])
            ->add('title', TextType::class, ['label' => 'Titre de l\'annonce'])
            ->add('musician', null,['expanded'=>true, 'label'=>'Je recherche', 'query_builder' => function(EntityRepository $er){
                return $er->createQueryBuilder('musicianCategory')->orderBy('musicianCategory.label', 'ASC');
            }] )
            ->add('style', null, ['expanded'=>true, 'query_builder' => function(EntityRepository $er){
                return $er->createQueryBuilder('musicCategory')->orderBy('musicCategory.label', 'ASC');
            }])
            ->add("instrument", null,['expanded'=>true, 'query_builder' => function(EntityRepository $er){
                return $er->createQueryBuilder('instrument')->orderBy('instrument.instrument', 'ASC');
            }] )
            ->add('price', MoneyType::class, ['label' => 'Prix', 'required'=>false, 'attr'=>['value' => 0]])
            ->add('delivery', ChoiceType::class,['choices'=>[
                'Indifférent' => '0',
                'Possible envoi (colis,..)' => 'Possible envoie (colis,...)',
                'Main propre uniquement' => 'Main propre uniquement'],'label' => 'Livraison'])
            ->add('adress', AdressType::class, ['label'=> 'Adresse'])
            ->add('description', TextareaType::class, ['label' => 'Description','attr' =>['rows' => 10]])
            ->add('checkPro', CheckboxType::class, ['value' => 'Professional','label'=>'Je suis un vendeur professionnel', 'required'=>false])
            ->add('image', CollectionType::class, [
                    'required' => false,
                    'entry_type' => ImageType::class,
                    'by_reference'=> false,
                    'label' => 'Photos (une annonce sera plus visible avec photos !',
                    'label_attr' => ['class' => 'form_photos']])
            ->add('submit', SubmitType::class, ['label' => 'Envoyer']);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Offer'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_offer';
    }


}
