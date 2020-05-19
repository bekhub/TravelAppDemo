<?php


namespace MainBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\EntityType;

class HomeSliderAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', null, array('label' => 'Слоган'))
            ->add('description', 'ckeditor', array('label'=>'Описание'))
            ->add('link', null, array('label' => 'Ссылка'))
            ->add('linkName', null, array('label' => 'Текст ссылки'))
            ->add('sliderImage', 'sonata_media_type', array(
                'label' => 'Основное фото',
                'required'=> true,
                'provider' => 'sonata.media.provider.image',
                'context'  => 'slider_photo',
                'help' => 'Оптимальный размер баннера 1350x432px',
            ))
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->addIdentifier('title');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title');
    }
}