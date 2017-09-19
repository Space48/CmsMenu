<?php
/**
 * Uninstall
 *
 * @copyright Copyright © 2017 Space48. All rights reserved.
 * @author    raul@space48.com
 */

declare(strict_types=1);

namespace Space48\CmsMenu\Setup;

use Magento\Catalog\Model\Category;
use Magento\Eav\Api\AttributeRepositoryInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UninstallInterface;

class Uninstall implements UninstallInterface
{

    /**
     * @var AttributeRepositoryInterface
     */
    private $attributeRepository;

    /**
     * Uninstall constructor.
     *
     * @param AttributeRepositoryInterface $attributeRepository
     */
    public function __construct(AttributeRepositoryInterface $attributeRepository)
    {
        $this->attributeRepository = $attributeRepository;
    }

    /**
     * Invoked when remove-data flag is set during module uninstall.
     *
     * @param SchemaSetupInterface   $setup
     * @param ModuleContextInterface $context
     *
     * @return void
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\StateException
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function uninstall(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if ($attribute = $this->getAttribute()) {
            $this->attributeRepository->delete($attribute);
        }
    }

    /**
     * @return \Magento\Eav\Api\Data\AttributeInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    private function getAttribute()
    {
        return $this->attributeRepository->get(Category::ENTITY, 'cms_block_menu');
    }
}
