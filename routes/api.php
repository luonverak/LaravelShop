<?php

use App\Http\Controllers\Menu\MenuController;
use App\Http\Controllers\SubMenu\SubMenuController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "zendo"], function () {
    // Menu
    Route::post("/add-menu", [MenuController::class, "addMenu"]);
    Route::post("/get-menu", [MenuController::class, "getMenu"]);
    // SubMenu
    Route::post("/add-submenu",[SubMenuController::class,"addSubMenu"]);
    Route::post("/get-submenu",[SubMenuController::class,"getSubMenu"]);
});
