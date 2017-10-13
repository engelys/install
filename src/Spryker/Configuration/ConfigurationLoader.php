<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Spryker\Configuration;

use Spryker\Configuration\Exception\ConfigurationFileNotFoundException;
use Symfony\Component\Yaml\Yaml;

class ConfigurationLoader implements ConfigurationLoaderInterface
{
    /**
     * @var string
     */
    protected $configFile;

    /**
     * @param string $stageName
     *
     * @throws \Spryker\Configuration\Exception\ConfigurationFileNotFoundException
     */
    public function __construct($stageName)
    {
        $stageName = SPRYKER_ROOT . '/.spryker/setup/' . $stageName . '.yml';

        if (!file_exists($stageName)) {
            throw new ConfigurationFileNotFoundException(sprintf('File "%s" does not exists. Please add the expected file.', $stageName));
        }

        $this->configFile = $stageName;
    }

    /**
     * @return array
     */
    public function loadConfiguration()
    {
        return (array)Yaml::parse(file_get_contents($this->configFile));
    }
}
