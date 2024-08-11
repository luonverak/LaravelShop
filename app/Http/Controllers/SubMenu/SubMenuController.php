<?php

namespace App\Http\Controllers\SubMenu;

use App\Http\Controllers\Controller;
use App\Models\MenuModel;
use App\Models\SubMenuModel;
use Illuminate\Http\Request;

class SubMenuController extends Controller
{

    public function addSubMenu(Request $request)
    {
        try {
            if (!$request->has("title") || !$request->has("menu_id")) {
                return response()->json([
                    "status" => "failed",
                    "msg" => "Something went wrong field required."
                ]);
            }
            $menuId = $request->menu_id;
            $menu = MenuModel::select(["id", "title"])->where("id", $menuId)->first();
            if (!$menu) {
                return response()->json([
                    "status" => "failed",
                    "msg" => "Something went wrong."
                ]);
            }

            $subMenu = new SubMenuModel();
            $subMenu->title = $request->title;
            $subMenu->menu_id = $menu->id;
            $subMenu->save();

            if (!$subMenu) {
                return response()->json([
                    "status" => "failed",
                    "msg" => "Something went wrong add failed."
                ]);
            }
            return response()->json([
                "status" => "success",
                "msg" => "Success"
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function getSubMenu()
    {
        try {
            $subMenu = SubMenuModel::select(["id", "title"])->get();

            if (!$subMenu->count() > 0) {
                return response()->json([
                    "status" => "success",
                    "msg" => "Records is empty."
                ]);
            }
            return response()->json([
                "status" => "success",
                "msg" => "Success",
                "records" => $subMenu
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
