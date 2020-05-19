<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Application\Sonata\UserBundle\Form\Type;

use Sonata\UserBundle\Model\UserInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

//use Symfony\Bundle\FrameworkBundle\Console\Application;
//use Symfony\Component\Form\AbstractType;
//use Symfony\Component\Form\FormBuilderInterface;
//
//use Symfony\Component\Form\FormEvent;
//use Symfony\Component\Form\FormEvents;
//use Symfony\Component\OptionsResolver\OptionsResolver;
//use Symfony\Component\OptionsResolver\OptionsResolverInterface;
//use Sonata\UserBundle\Model\UserInterface;
//use Sonata\UserBundle\Form\Type\ProfileType as BaseForm;

//class ProfileType extends BaseForm

class ProfileType extends AbstractType
{

//    private $class;
//
//    /**
//     * @param string $class The User class name
//     */
//    public function __construct($class)
//    {
//        $this->class = $class;
//    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        dump('test');
//        die();
        $builder
            ->add('gender', 'choice', array(
                'choices' => array(
                    'f' => 'Женский',
                    'm'   => 'Мужской',
                ),
            ))
            ->add('firstname', null, array(
                'label'    => 'Имя',
                'required' => false,
            ))
            ->add('lastname', null, array(
                'label'    => 'Фамилия',
                'required' => false,
            ))
            ->add('email', null, array(
                'required' => true,
            ))
            ->add('dateOfBirth', 'birthday', array(
                'label'    => 'form.label_date_of_birth',
                'required' => false,
                'widget'   => 'single_text',
            ))
            ->add('photo', 'sonata_media_type', array(
                'label' => 'фото',
                'required'=>false,
                'provider' => 'sonata.media.provider.image',
                'context'  => 'user',
//                'attr'=>array(
//                    'class'=>'form-control image-preview-filename',
//                    'disabled'=>'disabled'
//                )
            ))

//            ->add('phone', null, array(
//                'label'    => 'form.label_phone',
//                'required' => false,
//            ))
//            ->add('submit', 'submit', array(
//                'label'    => 'Сохранить',
//            ))
        ;
    }

    /**
     * {@inheritdoc}
     *
     * @deprecated Remove it when bumping requirements to Symfony 2.7+
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $this->configureOptions($resolver);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
//            'data_class' => $this->class,
            'data_class' => 'Application\Sonata\UserBundle\Entity\User',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
//        return 'applicationsonata_user_profile';
        return 'sonata_user_profile';

    }
}
