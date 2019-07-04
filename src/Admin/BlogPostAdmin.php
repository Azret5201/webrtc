<?php
/**
 * Created by PhpStorm.
 * User: Azret
 * Date: 04.07.2019
 * Time: 14:02
 */

namespace App\Admin;


use App\Entity\BlogPost;
use App\Entity\Category;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class BlogPostAdmin extends AbstractAdmin
{

    public function toString($object)
    {
        return $object instanceof BlogPost
            ? $object->getTitle()
            : 'Blog Post';
    }

    protected function configureFormFields(FormMapper $form)
    {

        $form
            ->with('Content')
                ->add('title', TextType::class)
                ->add('body', TextareaType::class)
            ->end()
            ->with('Meta data')
            ->add('category', ModelType::class, [
                'class' => Category::class,
                'property' => 'name',
            ])
            ->end()
        ;

    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('category', 'doctrine_orm_model_autocomplete', [], null,[
                'property' => 'name',
            ])
            ->add('title')
            ->add('body')
            ->add('draft')
            ;
    }

    protected function configureListFields(ListMapper $list)
    {
        $list
//            ->addIdentifier('category', 'choice', [
//                'editable' => true,
//                'class' => Category::class,
//                'choices' => 'name',
//            ])
            ->addIdentifier('title')
            ->addIdentifier('body')
            ->addIdentifier('draft')
        ;
    }
}