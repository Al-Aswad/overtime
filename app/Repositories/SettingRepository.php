<?php

namespace App\Repositories;

use App\Models\Setting;

interface SettingRepositoryInterface
{
    public function update(array $attr);
}

class SettingRepository implements SettingRepositoryInterface
{
    public function update(array $attr)
    {
        return Setting::where('key', $attr['key'])->update($attr);
    }
}


;
