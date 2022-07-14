<?php namespace Ceyleon\Sponsor\Models;

use Illuminate\Support\Carbon;
use Model;

/**
 * Model
 */
class Child extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'ceyleon_sponsor_children';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'full_name' => 'required',
        'birthday' => 'required',
        'photo' => 'required',
        'address_line_1' => 'required',
        'address_line_2' => 'required',
        'city' => 'required',
        'district' => 'required',
        'gender' => 'required',
        'guardian_contact_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:13',
        'guardian_email' => 'required|email',
        'guardian_name' => 'required'
    ];

    public $attachOne = [
        'photo' => 'System\Models\File'
    ];

    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['birthday'])->age;
    }

    public function getDistrictNameAttribute()
    {
        return $this->getDistrictOptions()[$this->district];
    }

    public function getDistrictOptions()
    {
        return [
            1 => "Ampara",
            2 => "Anuradhapura",
            3 => "Badulla",
            4 => "Batticaloa",
            5 => "Colombo",
            6 => "Galle",
            7 => "Gampaha",
            8 => "Hambantota",
            9 => "Jaffna",
            10 => "Kandy",
            11 => "Kalutara",
            12 => "Kegalle",
            13 => "Kilinochchi",
            14 => "Kurunegala", 
            15 => "Mannar", 
            16 => "Matale", 
            17 => "Matara", 
            18 => "Monaragala", 
            19 => "Mullaitivu", 
            20 => "Nuwara Eliya",
            21 => "Polonnaruwa",
            22 => "Puttalam",
            23 => "Ratnapura",
            24 => "Trincomalee",
            25 => "Vavuniya"
        ];
    }

    public function getGenderNameAttribute()
    {
        return $this->getGenderOptions()[$this->gender];
    }

    public function getGenderOptions()
    {
        return [
            1 => "Girl",
            2 => "Boy"
        ];
    }
    public function getSpStatus()
    {
        return $this->getSpStatus()[$this->st_st];
    }
}
