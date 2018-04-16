<?php


namespace Zeen\PollBundle\Admin;

use Zeen\CoreBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Knp\Menu\ItemInterface as MenuItemInterface;


use Sonata\AdminBundle\Admin\AdminInterface;

class PollAdmin extends Admin
{

    /**
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     *
     * @return void
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title', null, array( /*'label' => 'Заголовок'*/))
            ->add('enabled',null, array('editable' => true))


            ->add('updatedAt');
    }
    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     *
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {

        $formMapper->with('Poll', array('class' => 'col-md-8'))->end();
        $this->addInformatiobBlock($formMapper);

        $formMapper->with('Answers', array('class' => 'col-md-12'))->end();


        $formMapper
            ->with('Poll')
            ->add('title')
            ->add('enabled', null, array('required' => false))
            ->add('slug', 'slug_text', array(

                'source_field' => 'title',
               // 'usesource_title' => 'Использовать название опроса',
                'required' => false
            ))


            /*    ->add('date', 'genemu_jquerydate', array(
                'required' => false, 'widget' => 'single_text'))*/
            ->add('description')
            ->end()


            ->with ('Answers')
            ->add('answers', 'sonata_type_collection',
                array('by_reference' => false),
                array(
                    'edit' => 'inline',
                    'sortable' => 'pos',
                    'inline' => 'table',
                ))

            ->end();

    }



    /**
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     *
     * @return void
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('enabled')
            ->add('id');
    }

    public function prePersist($poll)
    {
        if (!$poll->getSlug()) $poll->setSlug('');
        parent::prePersist($poll);
    }


    //todo: monve to Core Bundle
    protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {

    }


    function addInformatiobBlock(FormMapper $formMapper, $title = 'Information')
    {
        $formMapper
            ->with($title, array('class' => 'col-md-4'))->end()
            ->with($title)
            ->add('updatedAt', 'genemu_plain', ['required' => false,'data_class' => 'DateTime'])
            ->add('createdAt', 'genemu_plain', ['required' => false,'data_class' => 'DateTime'])
            ->add('createdBy', 'genemu_plain', ['required' => false,'data_class' => 'DateTime'])
            ->add('updatedBy', 'genemu_plain', ['required' => false,'data_class' => 'DateTime'])
            ->end();
    }
}
