<?php
/**
 * Topmenu
 *
 * @copyright Copyright © 2017 Space48. All rights reserved.
 * @author    raul@space48.com
 */

declare(strict_types=1);

namespace Space48\CmsMenu\Block\Html;

use Magento\Catalog\Helper\Category as HelperCategory;
use Magento\Catalog\Model\Category;
use Magento\Cms\Model\BlockRepository;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class TopMenu extends Template
{

    /**
     * @var HelperCategory
     */
    private $categoryHelper;

    /**
     * @var BlockRepository
     */
    private $blockRepository;

    /**
     * Topmenu constructor.
     *
     * @param HelperCategory|Category $categoryHelper
     * @param BlockRepository         $blockRepository
     * @param Context                 $context
     * @param array                   $data
     *
     * @internal param CategoryFactory $categoryFactory
     */
    public function __construct(
        HelperCategory $categoryHelper,
        BlockRepository $blockRepository,
        Context $context,
        $data = []
    ) {
        $this->categoryHelper  = $categoryHelper;
        $this->blockRepository = $blockRepository;
        parent::__construct($context, $data);
    }

    /**
     * Retrieve current store categories
     *
     * @param bool|string $sorted
     * @param bool        $asCollection
     * @param bool        $toLoad
     *
     * @return \Magento\Framework\Data\Tree\Node\Collection or
     * \Magento\Catalog\Model\ResourceModel\Category\Collection or array
     */
    public function getStoreCategories($sorted = false, $asCollection = false, $toLoad = true)
    {
        $storeCategories = $this->categoryHelper->getStoreCategories($sorted, $asCollection, $toLoad);
        if ($asCollection) {
            $storeCategories->addAttributeToSelect('cms_block_menu');
        }

        return $storeCategories;
    }

    /**
     * @param $category Category
     *
     * @return string
     */
    public function getCategoryUrl($category)
    {
        return $this->categoryHelper->getCategoryUrl($category);
    }

    /**
     * @param $category Category
     *
     * @return string | null
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getCmsMenu($category)
    {
        $block   = null;
        $blockId = $category->getData('cms_block_menu');

        return $blockId ? $this->blockRepository->getById($blockId)->getContent() : $block;
    }
}
