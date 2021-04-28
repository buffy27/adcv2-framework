<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActiveSearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->setMethod('GET')
            ->add('search_text', TextType::class, [
                'attr' => [
                    'class' => 'mb-2 w-100'
                ],
                'required' => false
            ])
            ->add('active_toggle', ChoiceType::class,[
                'label' => "Status",
                'choices' => [
                    'My Uploads' => 'my_uploads',
                    'Seeding' => 'seeding',
                    'Leeching' => 'leeching',
                    'Completed' => 'completed' ,
                    'Incomplete' => 'incomplete' ,
                ],
               'data' => $options['data']['active_toggle'] ?? "my_uploads",
               'required' => false
            ])
            ->add('search', SubmitType::class, [
                'attr' => [
                    'class' => 'btn'
                ]
            ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}