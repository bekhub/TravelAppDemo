<?php

namespace ParticipantBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParticipantType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('event', null, array('required' => true))
            ->add('firstname', null, array('required' => true, 'attr' => array('pattern' => '^[a-zA-Z\s]+$')))
            ->add('lastname', null, array('required' => true, 'attr' => array('pattern' => '^[a-zA-Z\s]+$')))
            ->add('club')


            ->add('gi', 'choice', array(
                'label' => 'Gi / No-Gi',
                'choices' => array(
                    'gi' => 'Gi',
                    'noGi' => 'No-Gi',
                    'giNoGi' => 'Gi-No-Gi',
                )
            ))

            ->add('dateBirth',DateType::Class, array(
                'widget' => 'choice',
                'years' => range(date('Y')-4, date('Y')-57),
                'label' => 'Дата рождения',
                'placeholder' => array(
                    'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                ),
                'required' => true,

            ))

            ->add('category', null, array('required' => false, 'data' => 'friend'))
            ->add('categoryWeigth', null, array('required' => true))

            ->add('gender', 'choice', array(
                'label' => 'Пол',
                'choices' => array(
                    ' ' => ' ',
                    'MALE' => 'MALE',
                    'FEMALE' => 'FEMALE',
                ),
                'choices_as_values' => true,
            ))
            ->add('country', null, array('required' => true))
//            ->add('color', null, array('required' => true))

            ->add('photo', 'sonata_media_type', array(
                'provider' => 'sonata.media.provider.image',
                'data_class' => 'Application\Sonata\MediaBundle\Entity\Media',
                'context' => 'news',
                'required' => false,
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ParticipantBundle\Entity\Participant'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'participant';
    }


}
