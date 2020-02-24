<?php


namespace Thhan\ScheduleBundle\Command;


use Cron\CronExpression;

trait Schedule
{
    /**
     * @var array|string[]
     */
    private $cron = array();

    /**
     * @param $cron string|array
     * @return $this
     */
    protected function addCron($cron) {
        ScheduleCommand::addSchedule($this);

        if (is_array($cron)) {
            $this->cron = array_merge($this->cron, $cron);
            return $this;
        }

        $this->cron[] = $cron;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getNextRunDate() {
        $next = null;
        foreach ($this->cron as $cron) {
            $cron = CronExpression::factory($cron);
            $cron = $cron->getNextRunDate('now', 0, true);
            if ($next === null || $cron < $next)
                $next = $cron;
        }
        return $next;
    }
}
