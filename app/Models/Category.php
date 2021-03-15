<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";

    protected $fillable = [
        'name',
        'parent_id',
        'type',
    ];

    public function parent() {
        return $this->belongsTo(static::class, 'parent_id');
    }

    public function getTypeNameAttribute()
    {
        if($this->type)
        {
            switch ($this->type)
            {
                case 1:
                    $type = 'Điều phối';
                    break;
                case 2:
                    $type = 'Loại hình du lịch';
                    break;
                case 3:
                    $type = 'Nơi nghỉ';
                    break;
                case 4:
                    $type = 'Khác';
                    break;
                default:
                    $type = 'Điều phối';
            }
        }

        return $type;
    }

    public function getParentNameAttribute()
    {
        return $this->parent ? $this->parent->name : '';
    }
}
