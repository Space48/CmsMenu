<?php
/**
 * Space48_CmsMenu
 *
 * @category    Space48
 * @package     Space48_CmsMenu
 * @Date        09/2017
 * @license     http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * @author      @diazwatson
 */

declare(strict_types=1);

namespace Space48\CmsMenu\Block\Html;

use Magento\Catalog\Helper\Category as HelperCategory;
use Magento\Catalog\Model\Category;
use Magento\Cms\Model\BlockRepository;
use Magento\Framework\Data\Tree\Node\Collection as NodeCollection;
use Magento\Catalog\Model\ResourceModel\Category\Collection as CategoryCollection;
use Magento\Framework\Exception\NoSuchEntityException;
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
    )
    {
        $this->categoryHelper = $categoryHelper;
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
     * @return NodeCollection|CategoryCollection|array
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
     * @throws NoSuchEntityException
     */
    public function getCmsMenu($category)
    {
        $blockId = $category->getData('cms_block_menu');

        return $blockId ? $this->blockRepository->getById($blockId)->getContent() : null;
    }
}
