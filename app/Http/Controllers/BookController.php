<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BookController extends Controller
{
    public function index(Request $request)
    {
        //Cache::forget('juchao');
        //Cache::has('juchao');
        //Cache::put('juchao');
        $value = Cache::remember('users', 5 / 60, function () {
            $time = time();
            return array('juchao' . $time, 'juchao1', 'juchao2');
        });
        dd($value);
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