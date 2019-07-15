<?php
/**
 * Created by PhpStorm.
 * User: Azret
 * Date: 05.07.2019
 * Time: 12:00
 */

namespace App\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserAdmin extends AbstractAdmin
{

    public function toString($object)
    {
        return $object instanceof User
            ? $object->getEmail()
            : 'User';
    }

    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('email', TextType::class)
            ->add('roles', CollectionType::class, array(
                'allow_add' => true,
                'allow_delete' => true,
            ))
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options' => array('label' => 'Password'),
                'second_options' => array('label' => 'Password confirmation')
            ))
            ;
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('email')
            ->add('roles')
            ->add('password')
            ;
    }

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('email')
            ->addIdentifier('roles')
            ->addIdentifier('password')
            ;
    }

    public function prePersist($object)
    {
        $password = $object->getPassword();
        $container = $this->getConfigurationPool()->getContainer();
        $encoder = $container->get('security.password_encoder');
        $encoded = $encoder->encodePassword($object, $password);

        $object->setPassword($encoded);
    }
}