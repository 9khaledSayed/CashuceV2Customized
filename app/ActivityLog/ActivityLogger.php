<?php

namespace App\ActivityLog;

use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Config\Repository as Config;
use Spatie\Activitylog\ActivityLogger as SpatieActivityLogger;
use Spatie\Activitylog\ActivityLogStatus;

class ActivityLogger extends SpatieActivityLogger
{
    public function __construct(AuthManager $auth, Config $config, ActivityLogStatus $logStatus)
    {
        parent::__construct($auth, $config, $logStatus);

        $this->authDriver = 'employee'; // this can be customized to any logic you want/need
    }
}