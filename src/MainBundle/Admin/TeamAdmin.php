<?php


namespace MainBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\EntityType;

class TeamAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('fullName', null, array('label'=>'Полное имя'))
            ->add('position', null, array('label'=>'Должность'))
            ->add('teamImage', 'sonata_media_type', array(
                'label' => 'Основное фото',
                'required'=> false,
                'provider' => 'sonata.media.provider.image',
                'context'  => 'slider_photo',
                'help' => 'Оптимальный размер баннера 1920x580px',
            ))
            ->add('socialMedias', 'sonata_type_collection')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->addIdentifier('fullName');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('fullName')
            ->add('position');
    }
}