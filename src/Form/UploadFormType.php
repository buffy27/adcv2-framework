<?php

namespace App\Form;

use App\Entity\Torrents;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;

class UploadFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('torrent_name', TextType::class, [
                'label' => "Torrent Name",
                'required' => false,
                'attr' => [
                    'class' => 'w-100',
                    'name' => "torrent_name",
                ]
            ])
            ->add('torrent_file', FileType::class, [
                'label' => 'Torrent file',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'application/x-bittorrent'
                        ],
                        'mimeTypesMessage' => 'Please upload a valid torrent file',
                    ]),
                    new NotBlank([
                        'message' => 'Enter a torrent file',
                    ]),
                ],
            ])
            ->add('tCategory', ChoiceType::class, [
                'label' => "Category",
                'choices' => $options['data']['categories']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
