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
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Type;
use function Webmozart\Assert\Tests\StaticAnalysis\null;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class,[
                'constraints' => [
                    new Regex([
                        'pattern' => '/^[a-zA-Z0-9_]*$%/',
                        'match' => false,
                        'message' => 'Your username must be alfanumeric',
                    ]),
                    new Length([
                        'min' => 5,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        'max' => 15
                    ])
                ]
            ])
            ->add('password', RepeatedType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label' => 'Password',
                'invalid_message' => 'The password fields must match.',
                'options' => [
                    'attr' => ['class' => 'password-field', 'name' => 'password']
                ],
                'type' => PasswordType::class,
                'required' => true,
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password'],
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                    'label' => 'Email'
                ]

            )
            ->add('gender', ChoiceType::class, [
                'choices'  => [
                    'male' => "Male",
                    'female' => "Female",
                ],
            ])
            ->add('id_country', ChoiceType::class, [
                'label' => "Country",
                'choices'  => $options['data']['countries']
            ])
            ->add('faq', CheckboxType::class, [

                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'FAQ',
                    ]),
                ],
            ])
            ->add('birthday', DateType::class, [
                'label' => "Birthday",
                'years' => range(date('Y')-18, 1900)
            ])
            ->add('captcha', CaptchaType::class,[
                'width' => 200,
                'height' => 50,
                'length' => 6,
            ])
            ->add('rules', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('tos', CheckboxType::class, [
                'label' => "Read th tos before login",
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You need read the tos',
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
