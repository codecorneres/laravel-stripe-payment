<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoTable extends Model
{
    use HasFactory;
    protected $table = "info_table";
    protected $fillable = ['name','email','mobile'];
}
