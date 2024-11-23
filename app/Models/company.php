<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class company extends Model{
    use HasFactory;
    protected $table = 'companies';

    protected $fillable = ['name', 'address', 'created_by', 'created_at', 'updated_by', 'updated_at'];
}
