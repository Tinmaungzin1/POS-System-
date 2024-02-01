<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table = 'setting';
    protected $fillable = [
        'id',
        'company_name',
        'company_phone',
        'company_email',
        'company_address',
        'company_logo',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}