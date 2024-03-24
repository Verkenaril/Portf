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
        broadcast(new TestEvent(1212));
        return 1111;
    }
}
