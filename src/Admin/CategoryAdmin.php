<?php
/**
 * Created by PhpStorm.
 * User: Azret
 * Date: 04.07.2019
 * Time: 13:53
 */

namespace App\Admin;


use App\Entity\Category;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class CategoryAdmin extends AbstractAdmin
{

    public function toString($object)
    {
        return $object instanceof Category
            ? $object->getName()
            : 'Category';
    }

    protected function configureFormFields(FormMapper $form)
    {
        $form->add('name', TextType::class);

    }
    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('name');
    }

    protected function configureListFields(ListMapper $list)
    {
        $list->addIdentifier('name');
    }
}