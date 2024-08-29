<?php



namespace App\Http\Traits;

use App\Enums\StatusEnum;
use Illuminate\Http\JsonResponse;

trait ResponseTrait
{
    public function sendResponse(StatusEnum $status, $data, $message): JsonResponse
    {
        return response()->json([
            'status' => $status->value,
            'data' => $data,
            'message' => $message,
        ]);
    }
}
