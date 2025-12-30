<?php

protected function schedule(Schedule $schedule)
{
    $schedule->command('app:expire-premium')->daily();
}

