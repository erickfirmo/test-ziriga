<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'dob',
        'password',
    ];

    public function formatedDate()
    {
        return Carbon::parse($this->created_at)->format('d/m/Y');
    }
}
