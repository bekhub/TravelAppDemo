<?php


namespace MainBundle\Admin;

use MainBundle\Entity\About;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class AboutCardsAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('about_id', 'sonata_type_model')
            ->add('cardName', null, array('label' => 'Название карточки'))
            ->add('value', null, array('label' => 'Количество'))
            ->add('icon', 'sonata_media_type', array(
                'label' => 'Иконка',
                'required'=> true,
                'provider' => 'sonata.media.provider.image',
                'context'  => 'slider_photo',
                'help' => 'Оптимальный размер баннера 1920x580px',
            ))
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->addIdentifier('cardName');
    }
}