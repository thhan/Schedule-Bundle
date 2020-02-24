<?php


namespace Thhan\ScheduleBundle;


use Symfony\Component\Console\Application;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Thhan\ScheduleBundle\Command\ScheduleCommand;

class ScheduleBundle extends Bundle
{
    public function registerCommands(Application $application) {
        $application->add(new ScheduleCommand());
    }
}
