# Schedule-Bundle

This bundle offers you the possibility to add console commands to a cronjob with a simple function.

## Installation

```bash
composer req thhan/schedule-bundle
```

## Server configuration

Finally you create a cronjob on the server that executes the "schedule:run" command every minute.

```text
* * * * * {path_to_symfony}/bin/console schedule:run >> /dev/null 2>&1
```

## Usage

Add the Trait Schedule class to your console command. Extend the configuration function with the function "addCron". As parameter you pass a string or an array of strings with the formatting of cron jobs.

```php
use Thhan\ScheduleBundle\Command\Schedule;

class YourCommand extends Command {
    use Schedule;

    public function configure() {
        $this->setName('app:test')
             ->addCron('30 3 * * *')
             ->addCron([
                 '*/10 * * * *',
                 '0 22 * * 1'
             ]);
    }
}
```
