<?php
/**
 * Created by PhpStorm.
 * User: Steven DEV17-1
 * Date: 19/01/2018
 * Time: 09:46
 */

namespace AdminBundle\Form;


use AppBundle\Form\AdressType;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class UsersAdminType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, ['label' => 'Nom d\'utilisateur'])
            ->add('email', TextType::class, ['label' => 'E-mail'])
            ->add('adress', AdressType::class, ['label' => false])
            ->add('musician', null,['expanded'=>true, 'label'=>'Type musicien', 'query_builder' => function(EntityRepository $er){
                return $er->createQueryBuilder('musicianCategory')->orderBy('musicianCategory.label', 'ASC');
            }] )
            ->add('submit', SubmitType::class, ['label' => 'Envoyer']);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }

}