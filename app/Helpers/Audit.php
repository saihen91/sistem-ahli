<?php

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

function audit_log($action, $module = null, $description = null)
{
    AuditLog::create([
        'user_id' => Auth::id(),
        'action' => $action,
        'module' => $module,
        'description' => $description,
    ]);
}