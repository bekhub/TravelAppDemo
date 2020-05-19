<?php


namespace MainBundle\Admin;

use MainBundle\Entity\Tours;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class TourDatesAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('tour_id', null, array(
                'label' => 'Тур'
            ))
            ->add('startDate', null, array(
                'label' => 'Дата начала тура'
            ))
            ->add('endDate', null, array(
                'label' => 'Дата конца тура'
            ))
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->addIdentifier('startDate', null, array(
                'label' => 'Дата начала тура'
            ))
            ->add('tour_id', null, array(
                'label' => 'Тур'
            ))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('startDate', null, array(
                'label' => 'Дата начала тура'
            ))
            ->add('endDate', null, array(
                'label' => 'Дата конца тура'
            ))
            ->add('tour_id', null, [], EntityType::class, array(
                'class' => Tours::class,
                'choice_label' => 'name',
                'label' => 'Тур'
            ))
        ;
    }
}