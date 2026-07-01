<?php

namespace App\Http\Controllers\Admin;

use App\Models\PortfolioImage;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PortfolioImageController extends Controller
{
    public function destroy(PortfolioImage $image): JsonResponse
    {
        $image->delete();

        return response()->json([
            'success' => true,
            'message' => 'Image deleted successfully.',
        ]);
    }
}
