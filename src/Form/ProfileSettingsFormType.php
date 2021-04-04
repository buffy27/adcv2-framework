<?php

namespace App\Form;

use App\Entity\Countries;
use App\Entity\User;
use Gregwar\CaptchaBundle\Type\CaptchaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Type;
use function Webmozart\Assert\Tests\StaticAnalysis\null;

class ProfileSettingsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('parked', CheckboxType::class, [
                'label' => 'Account parked',
                'required' => false
            ])
            ->add('accept_pms', ChoiceType::class,[
                'label' => "Accept PMs from",
                'choices' => ['All (except blocks)' => 0, 'Friends & staff only' => 1, 'Staff only' => 2],
                'expanded' => true
            ])
            ->add('pm_details', ChoiceType::class,[
                'label' => "PMs details",
                'choices' => ['All (except blocks)' => 'all', 'Friends & staff only' => 'fs' , 'Staff only' => 'staff' ],
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('id_country', ChoiceType::class, [
                'label' => "Country",
                'choices'  => $options['data']['countries']
            ])
            ->add('avatar', FileType::class, [
                'label' => 'Change Avatar',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/gif',
                            'image/png',

                        ],
                        'mimeTypesMessage' => 'Please upload a valid torrent file',
                    ]),
                ],
            ])
            ->add('submit', SubmitType::class,[
                'attr' => [
                    'class' => 'btn'
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
