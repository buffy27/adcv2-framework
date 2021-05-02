<?php

namespace App\Form;

use App\Entity\Torrents;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;

class EditTorrentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => "Torrent Name",
                'required' => false,
                'attr' => [
                    'class' => 'w-100'
                ],
                'data' => $options['data']->getName()
            ])
           /* ->add('tCategory', ChoiceType::class, [
                'label' => "Category",
                'choices' => $options['data']['categories']
            ])*/
            ->add("description", TextareaType::class, [
                'label' => 'Release Details',
                'data' => $options['data']->getDescription(),
                'required' => false,
            ])
            ->add("contentInfo", TextareaType::class, [
                'label' => 'Content Info',
                'data' => $options['data']->getContentInfo(),
                'required' => false,
            ])
            ->add("mediaInfo", TextareaType::class, [
                'label' => "MediaInfo",
                'data' => $options['data']->getMediaInfo(),
                'required'=> false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\Torrents',
        ]);
    }
}
