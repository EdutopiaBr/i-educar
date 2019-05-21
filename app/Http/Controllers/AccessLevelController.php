<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;

class AccessLevelController extends Controller
{
    public function index(Request $request)
    {
        $menus = Menu::user($request->user());

        $this->menu(659);

        return view('accesslevel.index', [
            'menus' => $menus->toArray(),
        ]);
    }
}
