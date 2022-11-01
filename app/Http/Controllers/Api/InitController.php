<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Website;
use App\Services\IemsWp;
use Illuminate\Http\Request;

class InitController extends Controller
{
    public function init(Request $request)
    {
        $contents = $request->all();

        if (!isset($contents['name']) || !isset($contents['url'])) {
            return response()->json([
                'status' => 'failed',
                'message' => 'too few arguments'
            ]);
        }

        $name = $contents['name'];
        $url = $contents['url'];

        $website = Website::query()->where('url', $url)->first();

        if ($website) {
            $website->update([
                'name' => $name
            ]);
        } else {
            Website::query()->create([
                'name' => $name,
                'url' => $url,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'website updated'
        ]);
    }
}
