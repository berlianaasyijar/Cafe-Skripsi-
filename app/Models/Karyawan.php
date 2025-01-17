<?php
// app/Models/Karyawan.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Karyawan extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['username',  'password', 'nama', 'no_hp', 'point', 'status', 'foto', 'email'];

    protected $hidden = ['password'];


}
