<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsrType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $list = new \Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList([
            0,
            1
        ], [
            'Female',
            'Male'
        ]);
        $builder->add('phone')->add('firstname')->add('lastname')->add('gender',  \Symfony\Component\Form\Extension\Core\Type\ChoiceType::class, [
            'choice_list' => $list
            
        ])->add('birthday', \Symfony\Component\Form\Extension\Core\Type\BirthdayType::class)->add('password', \Symfony\Component\Form\Extension\Core\Type\PasswordType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\Usr'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'userbundle_usr';
    }


}
