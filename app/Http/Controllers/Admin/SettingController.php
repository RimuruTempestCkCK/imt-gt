<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateSettingRequest;
use App\Models\Setting;
use App\Support\AuditLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function edit(): View
    {
        $this->authorize('viewAny', Setting::class);

        return view('admin.settings.edit', [
            'settings' => Setting::pairs(),
        ]);
    }

    public function update(UpdateSettingRequest $request): RedirectResponse
    {
        foreach ($request->validated() as $key => $value) {
            Setting::query()->updateOrCreate(
                ['key' => $key],
                [
                    'value' => (string) $value,
                    'type' => 'text',
                    'group' => 'general',
                    'label' => str($key)->replace('_', ' ')->title()->toString(),
                    'is_public' => true,
                ]
            );
        }

        Setting::flushCache();
        AuditLogger::log('setting.updated', 'Pengaturan website diperbarui.', null, $request->validated());

        return back()->with('status', 'Pengaturan berhasil diperbarui.');
    }
}
