<?php

namespace App\Http\Controllers;

use App\Menu;
use App\MenuProcess;
use Illuminate\Http\Request;

class AccessLevelController extends Controller
{
    public function index(Request $request)
    {
        $this->menu(659);

        $menus = MenuProcess::all()->map(function (MenuProcess $menu) {
            return $menu->toArray();
        });

        return view('accesslevel.index', [
            'menus' => $menus,
        ]);
    }
}
