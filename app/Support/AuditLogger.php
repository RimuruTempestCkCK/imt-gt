<?php

namespace App\Support;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AuditLogger
{
    public static function log(string $action, string $description, ?Model $auditable = null, array $metadata = []): void
    {
        if (! self::canWriteLogs()) {
            return;
        }

        AuditLog::query()->create([
            'user_id' => Auth::id(),
            'action' => $action,
            'description' => $description,
            'auditable_type' => $auditable?->getMorphClass(),
            'auditable_id' => $auditable?->getKey(),
            'ip_address' => request()?->ip(),
            'user_agent' => request()?->userAgent(),
            'metadata' => $metadata,
        ]);
    }

    protected static function canWriteLogs(): bool
    {
        return app()->runningInConsole() === false || app()->runningUnitTests()
            ? \Illuminate\Support\Facades\Schema::hasTable('audit_logs')
            : false;
    }
}
