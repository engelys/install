<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Spryker\Install\Configuration\Filter;

use Spryker\Style\StyleInterface;

class InteractiveSectionExcludeFilter implements FilterInterface
{
    /**
     * @var \Spryker\Style\StyleInterface
     */
    protected $output;

    /**
     * @param \Spryker\Style\StyleInterface $output
     */
    public function __construct(StyleInterface $output)
    {
        $this->output = $output;
    }

    /**
     * @param array $items
     *
     * @return array
     */
    public function filter(array $items): array
    {
        $filtered = [];

        foreach ($items as $sectionName => $sectionDefinition) {
            $isExcluded = true;
            if ($this->output->confirm(sprintf('Should section <fg=yellow>%s</> be executed?', $sectionName), true) === true) {
                $isExcluded = false;
            }
            $sectionDefinition[static::EXCLUDED] = $isExcluded;
            $filtered[$sectionName] = $sectionDefinition;
        }

        return $filtered;
    }
}
