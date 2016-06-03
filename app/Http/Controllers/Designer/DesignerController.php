<?php

namespace App\Http\Controllers\Designer;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class DesignerController extends ApiController
{
    public function index(Request $request)
    {
        return View('designer.index');
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