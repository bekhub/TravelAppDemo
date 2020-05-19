<?php

namespace EventBundle\Admin;

use EventBundle\Entity\Entries;
use EventBundle\Entity\Event;
use EventBundle\Entity\EventGallery;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class EventAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('title')
            ->add('text')
            ->add('location')
            ->add('contacts')
            ->add('duration')
            ->add('dateRegistration')
            ->add('lastRegistration')

        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('title')
            ->add('location')
            ->add('duration')
            ->add('dateRegistration')
            ->add('lastRegistration')
            ->add('published', null, array('editable' => true))

            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
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
            ->add('title')
            ->add('location')
            ->add('duration')
            ->add('dateRegistration')
            ->add('lastRegistration')
            ->add('shortText')

            ->add('text', 'ckeditor', array('label' => 'Текст'))
            ->add('contacts', 'ckeditor', array('label' => 'Контакты'))

            ->add('published')
            ->add('created')

            ->add('entries', 'sonata_type_collection', array(
                'type_options' => array('delete' => false),
                'label' => 'Entries',
                'required' => false,
                'cascade_validation' => true), array(
                'edit' => 'inline',
                'inline' => 'table',
                'delete_btn' => true
            ))

            ->add('galleries', 'sonata_type_collection', array(
                'type_options' => array('delete' => false),
                'label' => 'Галерея',
                'required' => false,
                'cascade_validation' => true), array(
                'provider' => 'sonata.media.provider.image',
                'context' => 'slider_photo',
                'edit' => 'inline',
                'inline' => 'table',
                'delete_btn' => false
            ))

        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('title')
            ->add('text')
            ->add('location')
            ->add('contacts')
            ->add('duration')
            ->add('dateRegistration')
            ->add('lastRegistration')

        ;
    }


    public function preUpdate($entity)
    {

        $container = $this->getConfigurationPool()->getContainer();
        $em = $container->get('doctrine.orm.entity_manager');

        /** @var $entity Event */
        /** @var $gallery EventGallery */
        foreach($entity->getGalleries() as $gallery) {
            if ($gallery->getMedia() && $gallery->getMedia()){
                $gallery->setEvent($entity);
            }else{
                $em->remove($gallery);
            }
        }

        /** @var $entity Event */
        /** @var $entry Entries */
        foreach($entity->getEntries() as $entry) {
            $entry->setEvent($entity);
        }

        $em->flush();

    }

    public function prePersist($entity) {
        /** @var $entity Event */
        /** @var $gallery EventGallery */
        foreach($entity->getGalleries() as $gallery) {
            if ($gallery->getMedia() && $gallery->getMedia()){
                $gallery->setEvent($entity);
            }
        }

        /** @var $entity Event */
        /** @var $entry Entries */
        foreach($entity->getEntries() as $entry) {
            $entry->setEvent($entity);
        }

    }



}
