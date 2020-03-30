<?php
namespace Razzzila\StaticBlockACL\Block\Widget;

use Magento\Framework\{
    App\Http\Context as HttpContext,
    View\Element\Template\Context as TemplateContext
};
use Magento\Cms\{
    Block\Widget\Block,
    Model\Template\FilterProvider,
    Model\BlockFactory
};
use Magento\Customer\Model\Context as CustomerContext;

/**
 * Class StaticBlockByACL
 *
 * @package Razzzila\StaticBlockACL\Block\Widget
 */
class StaticBlockByACL extends Block
{
    /** @var HttpContext */
    protected $httpContext;
    
    /**
     * DynamicGroupData constructor.
     *
     * @param  TemplateContext  $context
     * @param  FilterProvider  $filterProvider
     * @param  BlockFactory  $blockFactory
     * @param  HttpContext  $httpContext
     * @param  array  $data
     */
    public function __construct(
        TemplateContext $context,
        FilterProvider $filterProvider,
        BlockFactory $blockFactory,
        HttpContext $httpContext,
        array $data = []
    ) {
        $this->httpContext = $httpContext;
        
        parent::__construct(
            $context,
            $filterProvider,
            $blockFactory,
            $data
        );
    }

    /**
     * @return string
     */
    protected function _toHtml() {
        return $this->isRenderingAllowed() ? parent::_toHtml() : '';
    }

    /**
     * @return bool
     */
    protected function isRenderingAllowed() {
        return array_search(
            $this->getCurrentCustomerGroup(),
            $this->getAllowedCustomerGroups()
        ) !==  false;
    }

    /**
     * @return mixed|null
     */
    protected function getCurrentCustomerGroup() {
        return $this->httpContext->getValue(
            CustomerContext::CONTEXT_GROUP
        );
    }

    /**
     * @return array
     */
    protected function getAllowedCustomerGroups() {
        return explode(
            ',',
            $this->getData('customer_groups_ids')
        );
    }

    /**
     * @return array
     */
    public function getIdentities() {
        $customerGroup = $this->getCurrentCustomerGroup();
        $identities = parent::getIdentities();
        $identities[] = 'customer_group_' . $customerGroup;
        
        return $identities;
    }
}
