<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Deploy\Stage\Section;

use Spryker\Deploy\Stage\Section\Command\CommandInterface;
use Spryker\Deploy\Stage\Section\Command\Exception\CommandExistsException;
use Spryker\Deploy\Stage\Section\Command\Exception\CommandNotFoundException;

class Section implements SectionInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var \Spryker\Deploy\Stage\Section\Command\CommandInterface[]
     */
    protected $commands = [];

    /**
     * @var bool
     */
    protected $isExcluded = false;

    /**
     * @var string
     */
    protected $preCommand;

    /**
     * @var string
     */
    protected $postCommand;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param \Spryker\Deploy\Stage\Section\Command\CommandInterface $command
     *
     * @throws \Spryker\Deploy\Stage\Section\Command\Exception\CommandExistsException
     *
     * @return \Spryker\Deploy\Stage\Section\SectionInterface
     */
    public function addCommand(CommandInterface $command): SectionInterface
    {
        if (isset($this->commands[$command->getName()])) {
            throw new CommandExistsException(sprintf('Command with name "%s" already exists.', $command->getName()));
        }
        $this->commands[$command->getName()] = $command;

        return $this;
    }

    /**
     * @return \Spryker\Deploy\Stage\Section\SectionInterface
     */
    public function markAsExcluded(): SectionInterface
    {
        $this->isExcluded = true;

        return $this;
    }

    /**
     * @return bool
     */
    public function isExcluded(): bool
    {
        return $this->isExcluded;
    }

    /**
     * @return \Spryker\Deploy\Stage\Section\Command\CommandInterface[]
     */
    public function getCommands(): array
    {
        return $this->commands;
    }

    /**
     * @param string $commandName
     *
     * @throws \Spryker\Deploy\Stage\Section\Command\Exception\CommandNotFoundException
     *
     * @return \Spryker\Deploy\Stage\Section\Command\CommandInterface
     */
    public function getCommand(string $commandName): CommandInterface
    {
        if (!isset($this->commands[$commandName])) {
            throw new CommandNotFoundException(sprintf('Command "%s" not found in "%s" section', $commandName, $this->getName()));
        }

        return $this->commands[$commandName];
    }

    /**
     * @param string $preCommand
     *
     * @return \Spryker\Deploy\Stage\Section\SectionInterface
     */
    public function setPreCommand(string $preCommand): SectionInterface
    {
        $this->preCommand = $preCommand;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasPreCommand(): bool
    {
        return ($this->preCommand !== null);
    }

    /**
     * @return string
     */
    public function getPreCommand(): string
    {
        return $this->preCommand;
    }

    /**
     * @param string $postCommand
     *
     * @return \Spryker\Deploy\Stage\Section\SectionInterface
     */
    public function setPostCommand(string $postCommand): SectionInterface
    {
        $this->postCommand = $postCommand;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasPostCommand(): bool
    {
        return ($this->postCommand !== null);
    }

    /**
     * @return string
     */
    public function getPostCommand(): string
    {
        return $this->postCommand;
    }
}
