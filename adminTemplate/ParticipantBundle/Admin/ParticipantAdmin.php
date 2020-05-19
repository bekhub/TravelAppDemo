<?php

namespace ParticipantBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ParticipantAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('firstname')
            ->add('lastname')
            ->add('status')
            ->add('weigth')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('firstname')
            ->add('lastname')
            ->add('status', null, array('editable'=>true))
            ->add('club')
            ->add('categoryWeigth')
            ->add('color')
            ->add('gi')
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
            ->add('firstname')
            ->add('lastname')
            ->add('status')
            ->add('gi', ChoiceType::class, array(
                'choices' => array('gi' => 'gi', 'noGi' => 'noGi')
            ))
            ->add('category')
            ->add('coach')
            ->add('country')
            ->add('gender')
            ->add('club')
            ->add('color')
            ->add('categoryWeigth')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('firstname')
            ->add('lastname')
            ->add('status')
            ->add('gi')
            ->add('number')
            ->add('dateBirth')
            ->add('gender')
            ->add('created')
        ;
    }
}
