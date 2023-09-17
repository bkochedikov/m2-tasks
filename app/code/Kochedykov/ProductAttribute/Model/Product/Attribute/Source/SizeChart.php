<?php declare(strict_types=1);

namespace Kochedykov\ProductAttribute\Model\Product\Attribute\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Cms\Api\BlockRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
class SizeChart extends AbstractSource
{
    public function __construct(
        BlockRepositoryInterface $blockRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    )
    {
        $this->blockRepository = $blockRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    public function getCmsBlocks(): array
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();
        return $this->blockRepository->getList($searchCriteria)->getItems();
    }

    /**
     * @return array
     */
    public function getAllOptions(): array
    {
        $cmsBlocks = $this->getCmsBlocks();
        foreach ($cmsBlocks as $block) {
            $this->_options[] = ['value' => $block->getIdentifier(), 'label' => $block->getTitle()];
        }
        return $this->_options;
    }
}
