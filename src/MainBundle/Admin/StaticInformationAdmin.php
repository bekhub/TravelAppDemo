<?php


namespace MainBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\EntityType;

class StaticInformationAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('footerDescription', 'ckeditor', array(
                'label' => 'Описание подвала сраницы'
            ))
            ->add('phone', null, array(
                'label' => 'Тел.'
            ))
            ->add('email', null, array(
                'label' => 'Эл. почта'
            ))
            ->add('address', null, array(
                'label' => 'Адрес'
            ))
            ->add('addressLink', null, array(
                'label' => 'Ссылка на адрес'
            ))
            ->add('facebook', null, array(
                'label' => 'facebook'
            ))
            ->add('twitter', null, array(
                'label' => 'twitter'
            ))
            ->add('instagram', null, array(
                'label' => 'instagram'
            ))
            ->add('google', null, array(
                'label' => 'google'
            ))
            ->add('whatsapp', null, array(
                'label' => 'whatsapp'
            ))
            ->add('telegram', null, array(
                'label' => 'telegram'
            ))
            ->add('cardText', 'ckeditor', array(
                'label' => 'Текст карточки'
            ))
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->addIdentifier('email');
    }
}