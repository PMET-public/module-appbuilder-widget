<?php
/**
 * Copyright © Adobe, Inc. All rights reserved.
 * See LICENSE for license details.
 */
namespace MagentoEse\AppBuilderWidget\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Registry;
use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Customer\Model\Session as CustomerSession;

class AppBuilder extends Template implements BlockInterface
{
    
    /**
     * @var string
     */
    protected $_template = "widget/appbuilder.phtml";

    /**
     * @var string
     */
    protected const BASE_URL_PATH = 'web/secure/base_url';

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @var CheckoutSession
     */
    protected $checkoutSession;

    /**
     * @var CustomerSession
     */
    protected $customerSession;

    /**
     *
     * @param Context $context
     * @param ScopeConfigInterface $scopeConfig
     * @param Registry $registry
     * @param CheckoutSession $checkoutSession
     * @param CustomerSession $customerSession
     * @return void
     */
    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig,
        Registry $registry,
        CheckoutSession $checkoutSession,
        CustomerSession $customerSession
    ) {
        parent::__construct($context);
        $this->scopeConfig = $scopeConfig;
        $this->registry = $registry;
        $this->checkoutSession = $checkoutSession;
        $this->customerSession = $customerSession;
    }

    /**
     * Returns default base url
     *
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->scopeConfig->getValue(
            self::BASE_URL_PATH,
            ScopeConfigInterface::SCOPE_TYPE_DEFAULT,
            0
        );
    }

    /**
     * Returns current product id if available
     *
     * @return int
     */
    public function getProductId()
    {
        $product = $this->registry->registry('current_product');
        if ($product) {
            return $product->getId();
        }
    }

    /**
     * Returns current product sku if available
     *
     * @return string
     */
    public function getProductSku()
    {
        $product = $this->registry->registry('current_product');
        if ($product) {
            return $product->getSku();
        }
    }

    /**
     * Returns current category id if available
     *
     * @return int
     */
    public function getCategoryId()
    {
        $category = $this->registry->registry('current_category');
        if ($category) {
            return $category->getId();
        }
    }

    /**
     * Returns current store id
     *
     * @return int
     */
    public function getStoreId()
    {
        return $this->_storeManager->getStore()->getId();
        ;
    }

     /**
      * Returns current store code
      *
      * @return string
      */
    public function getStoreCode()
    {
        return $this->_storeManager->getStore()->getCode();
        ;
    }

    /**
     * Returns current cart id if available
     *
     * @return string
     */
    public function getCartId()
    {
        return $this->checkoutSession->getQuoteId();
    }

    /**
     * Returns current customer id if available
     *
     * @return int
     */
    public function getCustomerId()
    {
        $customer = $this->customerSession->getCustomerData();
        if ($customer) {
            return $customer->getId();
        }
    }
}
