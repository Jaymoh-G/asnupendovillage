<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ImageController extends Controller
{
    /**
     * Remove an image from its associated model (album, event, etc.)
     */
    public function removeImage(Request $request, $imageId): JsonResponse
    {
        try {
            $image = Image::findOrFail($imageId);

            // Delete the physical file
            if (file_exists(storage_path('app/public/' . $image->path))) {
                unlink(storage_path('app/public/' . $image->path));
            }

            // Delete the database record
            $image->delete();

            return response()->json([
                'success' => true,
                'message' => 'Image removed successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error removing image: ' . $e->getMessage()
            ], 500);
        }
    }
}
