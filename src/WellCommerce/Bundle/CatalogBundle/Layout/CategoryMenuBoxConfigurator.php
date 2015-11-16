<?php
/*
 * WellCommerce Open-Source E-Commerce Platform
 *
 * This file is part of the WellCommerce package.
 *
 * (c) Adam Piotrowski <adam@wellcommerce.org>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace WellCommerce\Bundle\CatalogBundle\Layout;

use WellCommerce\Bundle\FormBundle\Elements\FormInterface;
use WellCommerce\Bundle\FormBundle\FormBuilderInterface;
use WellCommerce\Bundle\LayoutBundle\Configurator\AbstractLayoutBoxConfigurator;
use WellCommerce\Bundle\LayoutBundle\Configurator\LayoutBoxConfiguratorInterface;

/**
 * Class CategoryMenuBoxConfigurator
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class CategoryMenuBoxConfigurator extends AbstractLayoutBoxConfigurator implements LayoutBoxConfiguratorInterface
{
    /**
     * {@inheritdoc}
     */
    public function addFormFields(FormBuilderInterface $builder, FormInterface $form, $defaults)
    {
        $fieldset = $this->getFieldset($builder, $form);
        $accessor = $this->getPropertyAccessor();

        $fieldset->addChild($builder->getElement('tip', [
            'tip' => '<p>' . $this->trans('Choose categories which should be not visible in box.') . '</p>'
        ]));

        $fieldset->addChild($builder->getElement('tree', [
            'name'        => 'exclude',
            'label'       => $this->trans('category.label.exclude'),
            'choosable'   => false,
            'selectable'  => true,
            'sortable'    => false,
            'clickable'   => false,
            'items'       => $this->get('category.dataset.admin')->getResult('flat_tree'),
            'transformer' => $this->getRepositoryTransformer('entity', $this->get('category.repository')),
            'default'     => $accessor->getValue($defaults, '[exclude]')
        ]));
    }
}