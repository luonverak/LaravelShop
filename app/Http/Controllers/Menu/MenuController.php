<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuModel;

use function Laravel\Prompts\select;

class MenuController extends Controller
{
    public function addMenu(Request $request)
    {
        try {
            if (!$request->has("title") || $request->title == null) {
                return response()->json([
                    "status" => "failed",
                    "msg" => "Something went wrong title is required."
                ]);
            }
            $menu = new MenuModel();
            $menu->title = $request->title;
            $menu->save();
            if (!$menu) {
                return response()->json([
                    "status" => "failed",
                    "msg" => "Something went wrong menu add failed."
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
    public function getMenu()
    {
        try {
            $menu = MenuModel::select(["id", "title"])
                ->with(["submenu"=>function($q){
                    $q->select(["id","title","menu_id"]);
                }])->get();
            
            if (!$menu->count() > 0) {
                return response()->json([
                    "status" => "success",
                    "msg" => "Records is empty."
                ]);
            }
            $records = $menu->map(function ($q) {
                return [
                    "id" => $q->id,
                    "title" => $q->title,
                    "submenu"=>$q->submenu
                ];
            });
            return response()->json([
                "status" => "success",
                "msg" => "Success",
                "records" => $records
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
