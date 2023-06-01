<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\User;

class CrudOperations extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'contact',
        'gender',
        'hobbies',
        'address',
        'profile',
    ];

    // public function users(): BelongsTo
    // {
    //     return $this->belongsTo(User::class,'users','id');
    // }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = Str::of($value)->trim()->lower();
    }

    public function setHobbiesAttribute($value)
    {
        $this->attributes['hobbies'] = implode(',', $value);
    }

    public function getHobbiesArrAttribute() {
        return explode(',', $this->hobbies);
    }
}
