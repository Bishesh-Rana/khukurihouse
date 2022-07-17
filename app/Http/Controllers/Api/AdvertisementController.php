<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{

    public function __construct(Advertisement $advertisement)
    {

        $this->advertisement = $advertisement;
    }
    public function getAdvertisement()
    {
        $advertisement = $this->advertisement
            ->select('image', 'body', 'image')
            ->where('featured', '1')
            ->latest()
            ->first();
        if (!$advertisement->count()) {
            return response()->json([
                'status' => false,
                'message' => 'No Advertisement Found',
            ], 404);
        }
        try {
            return response()->json([
                'status' => true,
                'message' => 'Advertisement Fetched successfully',
                'data' => [
                    'title' => $advertisement->title ?? '',
                    'image' => $advertisement->apiImage,
                    'description' => $advertisement->body ?? ''
                ],
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
