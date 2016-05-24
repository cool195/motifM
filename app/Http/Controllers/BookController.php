<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $expiresAt = Carbon::now()->addMinutes(10);
        Cache::add('juchao', 'juchao1989', $expiresAt);
        if (Cache::has('juchao')) {
            dd(Cache::get('juchao', 'default'));
        }
        dd("index" . $request->input('p'));
    }

    public function store()
    {
        dd("store");
    }

    public function create()
    {
        dd("create");
    }

    public function destroy($id)
    {
        dd("destroy" . $id);
    }

    public function update($id)
    {
        dd("update" . $id);
    }

    public function show($id)
    {
        dd("show" . $id);
    }

    public function edit($id)
    {
        dd("edit" . $id);
    }
}

?>