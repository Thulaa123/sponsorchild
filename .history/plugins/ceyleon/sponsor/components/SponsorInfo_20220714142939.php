<?php

namespace Ceyleon\Sponsor\Components;

use Ceyleon\Sponsor\Models\Sponsor;
use Ceyleon\Sponsor\Models\Sponsorship;
use Input;
use Validator;
use Redirect;
use ValidationException;
use Cms\Classes\ComponentBase;


class SponsorInfo extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Sponsor Info',
            'description' => 'Get sponsor info'
        ];
    }

    public function onSave()
    {
        <?php

namespace Ceyleon\Sponsor\Components;

use Ceyleon\Sponsor\Models\Sponsor;
use Ceyleon\Sponsor\Models\Sponsorship;
use Input;
use Validator;
use Redirect;
use ValidationException;
use Cms\Classes\ComponentBase;


class SponsorInfo extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Sponsor Info',
            'description' => 'Get sponsor info'
        ];
    }

    public function onSave()
    {
        // echo "hello";

        $data = post();
        // $rules = [               
        // ];

        // $validator = Validator::make($data, $rules);
        
        // if($validator->fails()) {
        //     echo "validation failed";
            // throw new ValidationException($validator);

        // } else {
            // echo "validation pass";

            // // adding data to sponsor table---------
            // // Save to Backend
            $sponsor = new Sponsor();
            $sponsor->full_name = request()->get('full_name');
            $sponsor->nationality_id = request()->get('nationality_id');
            $sponsor->contact_number = request()->get('contact_number');
            $sponsor->email = request()->get('email');
            $sponsor->birthday = date(request()->get('yyyy') . "-" . request()->get('mm') . "-" . request()->get('dd'));
            $sponsor->address_line_1 = request()->get('address_line_1');
            $sponsor->address_line_2 = request()->get('address_line_2');
            $sponsor->civil_status = request()->get('civil_status');
            $sponsor->city = request()->get('city');
            $sponsor->state = request()->get('state');
            $sponsor->country_id = request()->get('country');
            $sponsor->gender = request()->get('gender');
            $sponsor->save();
    }

    // adding data to sponsorship table
    public function createsponsorship()
    {
        $sponsorship = new Sponsorship();

            $sponsorship->child_id = Input::get('child_id');
            $sponsorship->sponsor_id = Input::get('sponsor_id');
            $sponsorship->amount = Input::get('amount');
            $sponsorship->save();
            $sponsorship->refresh();
    }
}

    }

}
