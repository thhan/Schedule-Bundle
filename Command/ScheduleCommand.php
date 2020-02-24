<?php


namespace Thhan\ScheduleBundle\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ScheduleCommand extends Command
{
    /**
     * @var array|Schedule[]
     */
    static protected $commands = array();

    protected function configure() {
        $this->setName('schedule:run');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $timestamp = date('Y-m-d H:i');
        foreach (self::$commands as $command) {
            if ($command->getNextRunDate()->format('Y-m-d H:i') === $timestamp) {
                $output->writeln(sprintf("Running %s", $command->getName()));
                $command->execute($input, $output);
            }
        }
    }

    public static function addSchedule(Command $command) {
        if (!method_exists($command, 'getNextRunDate'))
            return;

        self::$commands[$command->getName()] = $command;
    }
}
