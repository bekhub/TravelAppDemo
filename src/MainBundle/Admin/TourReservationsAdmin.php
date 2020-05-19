<?php


namespace MainBundle\Admin;

use DateTime;
use MainBundle\Entity\TourDates;
use MainBundle\Entity\Tours;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Form\Type\DateRangeType;
use Sonata\CoreBundle\Form\Type\DateTimeRangeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
//use Symfony\Component\Validator\Constraints\Date;
//use Symfony\Component\Validator\Constraints\DateTime;

class TourReservationsAdmin extends  AbstractAdmin
{
    protected function configureShowFields(ShowMapper $showMapper)
    {
        // Here we set the fields of the ShowMapper variable, $showMapper (but this can be called anything)
        $showMapper
            ->add('tour_id', null, array(
                'label' => 'Тур'
            ))
            ->add('id')
            ->add('fullName', null, array(
                'label' => 'Имя и Фамилия'
            ))
            ->add('email', null, array(
                'label' => 'Эл. почта'
            ))
            ->add('phone', null, array(
                'label' => 'тел.'
            ))
            ->add('bookDate', null, array(
                'label' => 'Выбор даты'
            ))
            ->add('adults', null, array(
                'label' => 'Взрослые'
            ))
            ->add('kids', null, array(
                'label' => 'Дети'
            ))
            ->add('message', null, array(
                'label' => 'Примечание'
            ))
            ->add('created', null, array(
                'label' => 'Дата бронирования'
            ))
            ->add('updated', null, array(
                'label' => 'Дата обновления'
            ))
        ;

    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('tour_id', null, array(
                'label' => 'Тур'
            ))
            ->add('fullName', null, array(
                'label' => 'Имя и Фамилия'
            ))
            ->add('email', null, array(
                'label' => 'Эл. почта'
            ))
            ->add('phone', null, array(
                'label' => 'тел.'
            ))
            ->add('bookDate', null, array(
                'label' => 'Выбор даты'
            ))
            ->add('adults', null, array(
                'label' => 'Взрослые'
            ))
            ->add('kids', null, array(
                'label' => 'Дети'
            ))
            ->add('message', null, array(
                'label' => 'Примечание'
            ))
            ->add('created', null, array(
                'label' => 'Дата бронирования'
            ))
            ->add('updated', null, array(
                'label' => 'Дата обновления'
            ))
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->addIdentifier('fullName', null, array(
                'label' => 'Имя и Фамилия'
            ))
            ->add('tour_id', null, array(
                'label' => 'Тур'
            ))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('fullName', null, array(
                'label' => 'Имя и Фамилия'
            ))
            ->add('bookDate', null, array('label' => 'Дата тура'), EntityType::class, array(
                'class' => TourDates::class,
            ))
            ->add('updated', null, array('label' => 'Дата бронирования'))
            ->add('tour_id', null, [], EntityType::class, array(
                'class' => Tours::class,
                'choice_label' => 'name',
                'label' => 'Тур'
            ))
        ;
    }
}