<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerTest\Console;

use Codeception\Test\Unit;
use Spryker\Console\SetupConsoleCommand;

/**
 * Auto-generated group annotations
 * @group SprykerTest
 * @group Console
 * @group SetupConsoleCommandGroupTest
 * Add your own group annotations below this line
 */
class SetupConsoleCommandGroupTest extends Unit
{
    /**
     * @var \SprykerTest\ConsoleTester
     */
    protected $tester;

    /**
     * @return void
     */
    public function testRunOnlySpecifiedGroup()
    {
        $command = new SetupConsoleCommand();
        $tester = $this->tester->getCommandTester($command);

        $arguments = [
            'command' => $command->getName(),
            'stage' => 'development',
            '--' . SetupConsoleCommand::OPTION_GROUPS => ['group-a'],
        ];

        $tester->execute($arguments);

        $output = $tester->getDisplay();
        $this->assertRegexp('/Execute command line command: section-b-command-a/', $output);
        $this->assertNotRegexp('/Execute command line command: (section-a-command-a|section-c-command-a|section-d-command-a|section-d-command-b)/', $output);
    }

    /**
     * @return void
     */
    public function testDoNotRunExcludedGroup()
    {
        $command = new SetupConsoleCommand();
        $tester = $this->tester->getCommandTester($command);

        $arguments = [
            'command' => $command->getName(),
            'stage' => 'development',
            '--' . SetupConsoleCommand::OPTION_EXCLUDE => ['group-a'],
        ];

        $tester->execute($arguments);

        $output = $tester->getDisplay();
        $this->assertNotRegexp('/Execute command line command: section-b-command-a/', $output);
    }

    /**
     * @return void
     */
    public function testDoNotRunDefaultExcludedGroup()
    {
        $command = new SetupConsoleCommand();
        $tester = $this->tester->getCommandTester($command);

        $arguments = [
            'command' => $command->getName(),
            'stage' => 'development',
        ];

        $tester->execute($arguments);

        $output = $tester->getDisplay();
        $this->assertNotRegexp('/Execute command line command: section-d-command-b/', $output);
    }

    /**
     * @return void
     */
    public function testIncludeDefaultExcludedGroupByCommandName()
    {
        $command = new SetupConsoleCommand();
        $tester = $this->tester->getCommandTester($command);

        $arguments = [
            'command' => $command->getName(),
            'stage' => 'development',
            '--' . SetupConsoleCommand::OPTION_INCLUDE_EXCLUDED => ['section-d-command-b'],
        ];

        $tester->execute($arguments);

        $output = $tester->getDisplay();
        $this->assertRegexp('/Execute command line command: section-d-command-b/', $output);
    }

    /**
     * @return void
     */
    public function testIncludeDefaultExcludedGroupByGroupName()
    {
        $command = new SetupConsoleCommand();
        $tester = $this->tester->getCommandTester($command);

        $arguments = [
            'command' => $command->getName(),
            'stage' => 'development',
            '--' . SetupConsoleCommand::OPTION_INCLUDE_EXCLUDED => ['group-c'],
        ];

        $tester->execute($arguments);

        $output = $tester->getDisplay();
        $this->assertRegexp('/Execute command line command: section-d-command-b/', $output);
    }
}
