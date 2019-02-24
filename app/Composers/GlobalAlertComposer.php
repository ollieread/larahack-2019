<?php

namespace Larahack\Composers;

use Illuminate\View\View;
use Larahack\Support\Alerts;

class GlobalAlertComposer
{
    public function compose(View $view)
    {
        $alerts = Alerts::messages(null, 'global');
        $view->with('alerts', $alerts);
    }
}