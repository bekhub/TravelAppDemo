<?php


namespace AiO\CoreBundle\Admin;

use MainBundle\Entity\Tours;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class TourReviewsAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('user')
            ->add('review')
            ->add('approved');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('tourId')
            ->add('user')
            ->addIdentifier('review')
            ->add('approved');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('user')
            ->add('approved')
            ->add('tour_id', null, [], EntityType::class, array(
                'class' => Tours::class,
                'choice_label' => 'name',
            ))
        ;
    }
}