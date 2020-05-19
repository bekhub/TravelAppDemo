<?php

namespace SliderBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class SliderAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('isActive', null, array('label' => 'Опубликовать'))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('photo', 'string', array(
                'template' => 'MainBundle:Admin:image_list.html.twig'
            ))
            ->add('position', null, array('label' => 'Позиция', 'editable' => true))
            ->add('isActive', null, array('label' => 'Опубликовать', 'editable' => true))
            ->add('_action', null, array(
                'actions' => array(
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('position', null, array('label' => 'Position'))
            ->add('isActive', null, array('label' => 'Post'))
            ->add('link', null, array('label' => 'Link'))
            ->add('title', null, array('label' => 'Title'))
            ->add('description', null, array('label' => 'Description'))
            ->add('photo', 'sonata_media_type', array(
                'label' => 'Основное фото',
                'required'=>false,
                'provider' => 'sonata.media.provider.image',
                'context'  => 'slider_photo',
                'help' => 'Оптимальный размер баннера 1920x580px',
            ))
        ;
    }
}
