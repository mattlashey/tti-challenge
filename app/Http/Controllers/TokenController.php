<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TokenController extends Controller {
 
    public function csrfToken() {
        try {
            return response()->json(['csrf_token' => csrf_token()], 200);  // Return the CSRF token with status 200
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while generating the CSRF token.'], 500);  // Internal server error
        }
    }
}
