<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

use App\Models\Setting;

trait MetaTrait
{

    public function getMeta($meta = null)
    {
        if (!$meta) {
            $appSetting = Cache::remember('sitesetting', now()->addDay(), function () {
                return Setting::latest()->first();
            });
            return [
                'title' => $appSetting->meta_title ?? $appSetting->site_name ?? null,
                'description' => $appSetting->meta_description ?? $appSetting->meta_title ?? $appSetting->site_name ?? null,
                'image' => 'uploads/settings/'.$appSetting->site_logo ?? null,
                'keywords' => $appSetting->meta_keyword ?? $appSetting->meta_title ?? $appSetting->site_name ?? null,
            ];
        }

        return [
            'title' => $meta['meta_title'],
            'image' => $meta['image'] ?? 'uploads/settings/'.optional(cache()->get('sitesetting'))->site_logo,
            'description' => $meta['meta_description'],
            'keywords' => $meta['keywords'] ?? null
        ];
    }
}
