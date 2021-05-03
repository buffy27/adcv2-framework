<?php


namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Range;

class ForumSettingsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('topics_page', NumberType::class, [
                'label' => "Topics/page",
                'required' => false,
                'constraints' => [
                    new Range([
                        'min' => 5,
                        'max' => 50
                    ])
                ],
                'data' => $options['data']['forum_settings']['topics_per_page']
            ])
            ->add('posts_page', NumberType::class, [
                'label' => "Topics/page",
                'required' => false,
                'constraints' => [
                    new Range([
                        'min' => 15,
                        'max' => 100
                    ])
                ],
                'data' => $options['data']['forum_settings']['posts_per_page']
            ])
            ->add('forum_signature', TextareaType::class, [
                'label' => "Forum signature",
                'data' => $options['data']['forum_settings']['signature'],
                'required' => false
            ])
            ->add('save', SubmitType::class, [
                'label' => "Save Settings",
                'attr' => [
                    'class' => "btn"
                ]
            ])
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}