<?php


namespace AiO\CoreBundle\Admin;

use Knp\Menu\ItemInterface;
use MainBundle\Entity\Destinations;
use MainBundle\Entity\TourDates;
use MainBundle\Entity\Tours;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ToursAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Content', array('class' => 'col-md-9'))
                ->add('name')
                ->add('title')
                ->add('aboutTitle')
                ->add('aboutText', 'ckeditor', array('label'=>'Текст'))
            ->end()
            ->with('Meta data', array('class' => 'col-md-3'))
                ->add('destination_id', 'sonata_type_model')
                ->add('price')
            ->end()
            ->with('Даты')
                ->add('tourDates', 'sonata_type_collection', array(
                    'label' => false, 'by_reference' => false),
                    array('edit' => 'inline'))
            ->end()
            ->with('Title Image')
                ->add('titleImage', 'sonata_media_type', array(
                    'label' => 'Основное фото',
                    'required'=> true,
                    'provider' => 'sonata.media.provider.image',
                    'context'  => 'slider_photo',
                    'help' => 'Оптимальный размер баннера 1920x580px',
                ))
            ->end()
            ->with('Media')
                ->add('images', 'sonata_type_collection', array(
                    'label' => 'Слайдер', 'by_reference' => false),
                    array('edit' => 'inline',
                        'sortable' => 'pos',
                        'inline' => 'table',
                    ))
            ->end()
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
            ->add('name')
            ->add('destination_id', null, [], EntityType::class, array(
                'class' => Destinations::class,
                'choice_label' => 'destination',
                'label' => 'Локация'
            ))
            ->add('tourDates', null, [], EntityType::class, array(
                'class' => TourDates::class,
                'label' => 'Даты'
            ))
            ->add('title');
    }
}