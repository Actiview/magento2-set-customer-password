<?php

namespace Actiview\SetCustomerPassword\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\CustomerRegistry;
use Magento\Framework\Encryption\EncryptorInterface;
use Magento\Framework\Exception\InputException;

class SetPassword extends \Magento\Backend\App\Action
{
    /** @var CustomerRegistry */
    private $customerRegistry;

    /** @var CustomerRepositoryInterface */
    private $customerRepository;

    /** @var EncryptorInterface */
    private $encryptor;

    /**
     * Constructor
     *
     * @param Context $context
     * @param CustomerRegistry $customerRegistry
     * @param CustomerRepositoryInterface $customerRepository
     * @param EncryptorInterface $encryptor
     */
    public function __construct(
        Context $context,
        CustomerRegistry $customerRegistry,
        CustomerRepositoryInterface $customerRepository,
        EncryptorInterface $encryptor
    ) {
        parent::__construct($context);
        $this->customerRegistry = $customerRegistry;
        $this->customerRepository = $customerRepository;
        $this->encryptor = $encryptor;
    }

    /**
     * @inheritdoc
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Actiview_SetCustomerPassword::set_password');
    }

    /**
     * Set new password for customer from backend
     *
     * @return \Magento\Framework\App\ResponseInterface
     */
    public function execute()
    {
        $customerId = (int)$this->getRequest()->getPost('id');
        $newPassword = (string)$this->getRequest()->getPost('password');

        try {
            $this->validateNewPassword($newPassword);
            $newPasswordHash = $this->encryptor->getHash($newPassword, true);

            $customer = $this->customerRepository->getById($customerId);
            $customerSecure = $this->customerRegistry->retrieveSecureData($customer->getId());
            $customerSecure->setPasswordHash($newPasswordHash);
            $this->customerRepository->save($customer);

            $this->messageManager->addSuccessMessage(__("You updated this customer's password."));
        }
        catch (InputException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }
        catch (\Exception $exception) {
            $this->messageManager->addErrorMessage(__('Something went wrong while saving the new password.'));
        }

        return $this->_redirect('customer/index/edit', ['id' => $customerId]);
    }

    /**
     * Check new password validity.
     *
     * @param $password
     * @throws InputException
     */
    protected function validateNewPassword($password)
    {
        if (iconv_strlen($password) <= 0) {
            throw new InputException(__('Please enter a new password.'));
        }
    }
}