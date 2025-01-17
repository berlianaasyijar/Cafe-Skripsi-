<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';

    protected $fillable = [
        'nama', 'username', 'no_hp', 'point', 'level', 'status', 'created_by', 'created_date', 'updated_by', 'updated_date'
    ];

    // Set default attributes
    protected $attributes = [
        'status' => 1
    ];
}

