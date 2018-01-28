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

namespace Space48\CmsMenu\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class AddAttributeToMenu implements ObserverInterface
{

    /**
     * Add attribute to flat table collection
     * vendor/magento/module-catalog/Model/ResourceModel/Category/Flat.php:300
     *
     * @param Observer $observer
     *
     * @return void
     */
    public function execute(Observer $observer)
    {
        /** @var \Magento\Framework\DB\Select $select */
        $select = $observer->getData('select');
        $select->columns(['cms_block_menu']);
    }
}
