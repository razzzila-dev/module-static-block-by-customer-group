<?php
namespace Razzzila\StaticBlockACL\Model\Customer\Source;

use Magento\Customer\Api\Data\GroupSearchResultsInterface;
use Magento\Customer\Api\Data\GroupInterface;
use Magento\Customer\Api\GroupRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Customer\Model\Customer\Source\GroupSourceInterface;

/**
 * Class Group
 *
 * @package Razzzila\StaticBlockACL\Model\Customer\Source
 */
class Group implements GroupSourceInterface
{
    /**
     * @var GroupRepositoryInterface
     */
    protected $groupRepository;
    
    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;
    
    /**
     * @param GroupRepositoryInterface $groupRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        GroupRepositoryInterface $groupRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->groupRepository = $groupRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }
    
    /**
     * Return array of customer groups
     *
     * @return array
     */
    public function toOptionArray() {
        $customerGroups = [];
        
        /** @var GroupSearchResultsInterface $groups */
        $groups = $this->groupRepository->getList(
            $this->searchCriteriaBuilder->create()
        );
        foreach ($groups->getItems() as $group) {
            $customerGroups[] = [
                'label' => $group->getCode(),
                'value' => $group->getId(),
            ];
        }
        
        return $customerGroups;
    }
}
