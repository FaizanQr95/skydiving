<?php

namespace App\Http\Controllers;

use App\Services\CometChatService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CometChatAuthController extends Controller
{
    protected $cometChatService;

    public function __construct(CometChatService $cometChatService)
    {
        $this->cometChatService = $cometChatService;
    }

    public function generateToken(Request $request)
    {
        $user = Auth::user(); // Assuming user is authenticated (e.g., via Sanctum)
        if (!$user) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        $authToken = $this->cometChatService->createAuthToken((string) $user->id);

        if ($authToken) {
            return response()->json(['authToken' => $authToken]);
        }

        return response()->json(['error' => 'Failed to generate chat token.'], 500);
    }
}
