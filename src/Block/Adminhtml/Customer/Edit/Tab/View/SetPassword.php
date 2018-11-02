<?php

namespace Actiview\SetCustomerPassword\Block\Adminhtml\Customer\Edit\Tab\View;

use Magento\Customer\Block\Adminhtml\Edit\Tab\View\PersonalInfo;

/**
 * Class SetPassword
 *
 * @package Actiview\SetCustomerPassword\Block\Adminhtml\Customer\Edit\Tab\View
 */
class SetPassword extends PersonalInfo
{
    /**
     * Don't show block if not allowed by ACL
     *
     * @inheritdoc
     */
    protected function _toHtml()
    {
        if (!$this->_authorization->isAllowed('Actiview_SetCustomerPassword::set_password')) {
            return;
        }

        return parent::_toHtml();
    }
}