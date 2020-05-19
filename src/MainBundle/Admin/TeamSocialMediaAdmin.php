<?php


namespace MainBundle\Admin;

use MainBundle\Entity\Team;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class TeamSocialMediaAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('team_id', 'sonata_type_model')
            ->add('facebook', null, array('label' => 'Facebook'))
            ->add('twitter', null, array('label' => 'twitter'))
            ->add('instagram', null, array('label' => 'Instagram'))
            ->add('google', null, array('label' => 'Google+'))
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('team_id', null, [], EntityType::class, array(
                'class' => Team::class,
                'choice_label' => 'fullName',
            ));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('team_id', null, [], EntityType::class, array(
                'class' => Team::class,
                'choice_label' => 'fullName',
            ))
        ;
    }
}