<?php


namespace MainBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\EntityType;

class AboutAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Контент')
                ->add('status', null, array('label' => 'Статус'))
                ->add('text', 'ckeditor', array('label'=>'Текст'))
            ->end()
            ->with('Картинка')
                ->add('image', 'sonata_media_type', array(
                    'label' => 'Основное фото',
                    'required'=> true,
                    'provider' => 'sonata.media.provider.image',
                    'context'  => 'slider_photo',
                    'help' => 'Оптимальный размер баннера 1920x580px',
                ))
            ->end()
            ->with('Карточки')
                ->add('cards', 'sonata_type_collection')
            ->end()
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('status');
    }
}