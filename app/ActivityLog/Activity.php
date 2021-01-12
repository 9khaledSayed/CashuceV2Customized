<?php


namespace App\ActivityLog;


use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\ActivityLogger;
use Spatie\Activitylog\ActivityLogStatus;

class Activity extends ActivityLogger
{
    public function __construct(AuthManager $auth, Repository $config, ActivityLogStatus $logStatus)
    {
        parent::__construct($auth, $config, $logStatus);
        $this->auth = $auth;

        $this->authDriver = Auth::guard('company')->check()? 'company' : 'employee';

        $this->defaultLogName = $config['activitylog']['default_log_name'];

        $this->logStatus = $logStatus;
    }


}