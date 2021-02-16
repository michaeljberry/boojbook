<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Client;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ApiDocController extends Controller
{
    public function index()
    {
        $clients = Client::orderBy('id')->get();
        return collect($clients)->chunk(50);
        // return view('datatable', $data);
    }

}
