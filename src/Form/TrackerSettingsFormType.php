<?php


namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Range;
use Symfony\Component\Validator\Tests\Constraints\MinMax;

class TrackerSettingsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('torrent_details', ChoiceType::class,[
            'label' => "Torrent details",
            'choices' => [
                'Show torrent description' => 'show_desc',
                'Show NFO file' => 'show_nfo' ,
                'Show additional information (AniDB, IMDb)' => 'show_content',
                'Show Media info link' => 'show_mediainfo'
            ],
            'expanded' => true,
            'multiple' => true,
            'data' => array_values($options['data']['tracker_settings']['torrent_details']),
            'required' => false
        ])
        ->add('torrents_page', NumberType::class, [
            'label' => "Torrents / page",
            'required' => false,
            'data' => $options['data']['tracker_settings']['torrents_page'],
            'constraints' => [
                new Range([
                    'min' => 15,
                    'max' => 150,
                ]),
            ]
        ])
        ->add('comments_torrent_page', NumberType::class, [
             'label' => "Comments / page",
            'required' => false,
            'data' => $options['data']['tracker_settings']['comments_torrent_page'],
            'constraints' => [
                new Range([
                    'min' => 5,
                    'max' => 50,
                ]),
            ]
        ])
        ->add('submit', SubmitType::class,[
            'attr' => [
                'class' => 'btn'
            ],
            'label' => "Save Settings"
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}