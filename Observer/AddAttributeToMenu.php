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

class AddAttributeToMenu implements ObserverInterface
{

    /**
     * @param Observer $observer
     *
     * @return void
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute(Observer $observer)
    {
        /** @var \Magento\Framework\DB\Select $select */
        $select = $observer->getData('select');
        $select->columns(['cms_block_menu']);
    }
}
