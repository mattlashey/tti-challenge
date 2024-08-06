<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name', 'last_name', 'email', 'gender', 'birth_date', 'country', 'created_at'
    ];

    protected $dates = [
        'birth_date', 'created_at', 'updated_at'
    ];

    protected $dateFormat = 'Y-m-d';

    public function setBirthDateAttribute($value){
        $this->attributes['birth_date'] = Carbon::createFromFormat('Y-m-d', $value);
    }

    public function scopeSearchName($query, $value){
        $value = str_replace(' ', '', $value);
        $query->where('first_name', 'like', "%{$value}%")->orwhere('last_name', 'like', "%{$value}%");
    }

    public function scopeSearchEmail($query, $value){
        $value = str_replace(' ', '', $value);
        $query->where('email', 'like', "%{$value}%");
    }

    public function scopeSearchCountry($query, $value){
        $value = str_replace(' ', '', $value);
        $query->where('country', 'like', "%{$value}%");
    }
}
