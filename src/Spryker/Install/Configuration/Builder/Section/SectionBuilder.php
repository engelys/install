<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Spryker\Install\Configuration\Builder\Section;

use Spryker\Install\Stage\Section\Section;
use Spryker\Install\Stage\Section\SectionInterface;

class SectionBuilder implements SectionBuilderInterface
{
    public const CONFIG_EXCLUDED = 'excluded';
    public const CONFIG_PRE_COMMAND = 'pre';
    public const CONFIG_POST_COMMAND = 'post';

    /**
     * @param string $name
     * @param array $definition
     *
     * @return \Spryker\Install\Stage\Section\SectionInterface
     */
    public function buildSection(string $name, array $definition): SectionInterface
    {
        $section = new Section($name);
        $this->setExcluded($section, $definition);
        $this->setPreCommand($section, $definition);
        $this->setPostCommand($section, $definition);

        return $section;
    }

    /**
     * @param \Spryker\Install\Stage\Section\SectionInterface $section
     * @param array $definition
     *
     * @return void
     */
    protected function setExcluded(SectionInterface $section, array $definition)
    {
        if (isset($definition[static::CONFIG_EXCLUDED]) && $definition[static::CONFIG_EXCLUDED]) {
            $section->markAsExcluded();
        }
    }

    /**
     * @param \Spryker\Install\Stage\Section\SectionInterface $section
     * @param array $definition
     *
     * @return void
     */
    protected function setPreCommand(SectionInterface $section, array $definition)
    {
        if (isset($definition[static::CONFIG_PRE_COMMAND])) {
            $section->setPreCommand($definition[static::CONFIG_PRE_COMMAND]);
        }
    }

    /**
     * @param \Spryker\Install\Stage\Section\SectionInterface $section
     * @param array $definition
     *
     * @return void
     */
    protected function setPostCommand(SectionInterface $section, array $definition)
    {
        if (isset($definition[static::CONFIG_POST_COMMAND])) {
            $section->setPostCommand($definition[static::CONFIG_POST_COMMAND]);
        }
    }
}
