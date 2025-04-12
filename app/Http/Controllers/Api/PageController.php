<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use Illuminate\Http\Request;

use function App\Helpers\success;

class PageController extends Controller
{
    public function profile()
    {
        return success("profile success", [
            "user" => new ProfileResource(auth()->user()),
        ]);
    }
}
