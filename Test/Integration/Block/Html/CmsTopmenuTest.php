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

use Magento\Catalog\Model\Category;
use Magento\Cms\Model\Block;
use Magento\Framework\Data\Tree\Node\Collection;
use Magento\TestFramework\ObjectManager;
use PHPUnit\Framework\TestCase;

class CmsTopmenuTest extends TestCase
{

    /**
     * @var ObjectManager
     */
    private $objectManager;
    /**
     * @var TopMenu
     */
    private $block;

    public function setUp()
    {
        $this->objectManager = ObjectManager::getInstance();
        $this->block = $this->objectManager->create(TopMenu::class);
    }

    public function testGetStoreCategoriesReturnsCategoryCollection()
    {
        $this->assertInstanceOf(Collection::class, $this->block->getStoreCategories());
    }

    /**
     * @magentoDataFixture Magento/Catalog/_files/categories.php
     */
    public function testGetCategoryUrlReturnsAValidUrl()
    {
        /** @var Category $category */
        $category = $this->objectManager->create(Category::class);
        $category->load('3');

        $this->assertEquals('http://localhost/index.php/category-1.html', $this->block->getCategoryUrl($category));
    }

    /**
     * @magentoDataFixture Magento/Catalog/_files/category.php
     * @magentoDataFixture Magento/Cms/_files/block.php
     */
    public function testGetCmsMenuReturnsACmsBlock()
    {
        /** @var Block $cmsBlock */
        $cmsBlock = $this->objectManager->create(Block::class);

        /** @var Category $category */
        $category = $this->objectManager->create(Category::class);
        $category->load('3');
        $category->setData('cms_block_menu', $cmsBlock->getId());

        $this->assertEquals($cmsBlock->getContent(), $this->block->getCmsMenu($category));
    }

    /**
     * @magentoDataFixture Magento/Catalog/_files/category.php
     */
    public function testGetCmsMenuReturnsNullIfNotCmsBlockIsSet()
    {
        /** @var Category $category */
        $category = $this->objectManager->create(Category::class);
        $category->load('3');

        $this->assertEquals(null, $this->block->getCmsMenu($category));
    }
}
