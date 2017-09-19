<?php
/**
 * InstallData
 *
 * @copyright Copyright © 2017 Space48. All rights reserved.
 * @author    raul@space48.com
 */

declare(strict_types=1);

namespace Space48\CmsMenu\Setup;

use Magento\Catalog\Model\Category;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{

    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * InstallData constructor.
     */
    public function __construct(
        EavSetupFactory $eavSetupFactory
    ) {

        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * Installs data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface   $context
     *
     * @return void
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.0.0', '<')) {

            $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

            $eavSetup->addAttribute(Category::ENTITY, 'cms_block_menu',
                [
                    'type'       => 'int',
                    'label'      => 'Menu CMS Block',
                    'input'      => 'select',
                    'source'     => 'Magento\Catalog\Model\Category\Attribute\Source\Page',
                    'required'   => false,
                    'sort_order' => 20,
                    'global'     => ScopedAttributeInterface::SCOPE_STORE,
                    'group'      => 'Display Settings',
                ]);
        }
    }
}
