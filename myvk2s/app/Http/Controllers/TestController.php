<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Country;
use App\Events\TestEvent;

class TestController extends Controller
{
    public function index(Request $request)
    {
        return 1113331;
    }
}
