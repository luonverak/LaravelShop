<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\SubMenuModel;

class MenuModel extends Model
{
    use HasFactory;
    protected $table = "menu";

    public function submenu()
    {
        return $this->hasMany(SubMenuModel::class,"menu_id");
    }
}
