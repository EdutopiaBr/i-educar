<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;

class MenuProcess
{
    /**
     * @var Menu
     */
    private $menu;

    /**
     * @var Collection
     */
    private $processes;

    /**
     * @param Menu $menu
     */
    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
        $this->processes = new Collection();

        $this->find();
    }

    /**
     * @return void
     */
    private function find()
    {
        if (empty($this->menu->processes)) {
            $this->menu->processes = new Collection();
        }

        $this->recursive($this->menu->children, $this->processes, $this->menu->title . ' > ');
    }

    /**
     * @param Collection $menus
     * @param Collection $result
     * @param string     $path
     *
     * @return Collection
     */
    private function recursive($menus, $result, $path)
    {
        return $menus->each(function ($menu) use ($result, $path) {
            if ($menu->children->count()) {
                $this->recursive($menu->children, $result, $path . $menu->title . ' > ');
            } else {
                $menu->description = $path . $menu->title;
                $result->push($menu);
            }
        });
    }

    public function toArray()
    {
        return [
            'menu' => $this->menu,
            'processes' => $this->processes->map(function ($process) {
                $array = $process->toArray();
                $array['level'] = 0;
                return $array;
            }),
        ];
    }

    /**
     * @return Collection
     */
    public static function all()
    {
        $menus = Menu::roots();

        return $menus->map(function (Menu $menu) {
            return new static($menu);
        });
    }
}
