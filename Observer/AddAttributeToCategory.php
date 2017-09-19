<?php
/**
 * AddAttributeToCategory
 *
 * @copyright Copyright © 2017 Space48. All rights reserved.
 * @author    raul@space48.com
 */

declare(strict_types=1);

namespace Space48\CmsMenu\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class AddAttributeToCategory implements ObserverInterface
{

    /**
     * @param Observer $observer
     *
     * @return void
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute(Observer $observer)
    {
        /** @var \Magento\Catalog\Model\ResourceModel\Category\Collection $collection */
        $collection = $observer->getEvent()->getData('category_collection');
        $collection->addAttributeToSelect('cms_block_menu');
    }
}
