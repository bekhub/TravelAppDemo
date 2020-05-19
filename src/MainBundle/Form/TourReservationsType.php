<?php

namespace MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TourReservationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fullName', TextType::class, array(
                'attr' => array('placeholder' => 'Имя и Фамилия*'),
                'label' => false
            ))
            ->add('email', EmailType::class, array(
                'attr' => array('placeholder' => 'эл. почта*'),
                'label' => false
            ))
            ->add('phone', TextType::class, array(
                'attr' => array('placeholder' => 'тел.*'),
                'label' => false
            ))
//            ->add('bookDate', TourDatesType::class, array(
//                'label' => 'Даты тура',
//                'required' => true,
////                'class' => 'MainBundle\Entity\TourDates',
//            ))
            ->add('adults', IntegerType::class, array(
                'label' => 'Взрослые',
                'attr' => array(
                    'min' => 1,
                    'max' => 20
                )))
            ->add('kids', IntegerType::class, array(
                'label' => 'Дети',
                'attr' => array(
                    'min' => 0,
                    'max' => 20
                )))
            ->add('message', null, array(
                'attr' => array('placeholder' => 'Текст сообщения'),
                'label' => false,
                'required' => false
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MainBundle\Entity\TourReservations'
        ));
    }

    public function getBlockPrefix()
    {
        return 'main_bundle_tour_reservations_type';
    }
}
