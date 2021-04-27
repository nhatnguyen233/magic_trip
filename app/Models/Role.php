<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    const ADMINISTRATOR = 'administrator';
    const HOST = 'host';
    const CUSTOMER = 'customer';

    protected $fillable = ['name'];
}
