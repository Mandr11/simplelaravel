<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        // main frontend app page (list)
        return view('frontend.index');
    }

    public function items()
    {
        // dedicated items list page — same frontend used but different blade
        return view('frontend.items');
    }

    public function show($id)
    {
        // item detail page — pass id into the view
        return view('frontend.show', ['id' => $id]);
    }
}
