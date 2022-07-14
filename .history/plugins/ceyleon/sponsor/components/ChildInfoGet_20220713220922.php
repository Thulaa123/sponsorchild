<?php

namespace Ceyleon\Sponsor\Components;

use Ceyleon\Sponsor\Models\Child;

class ChildInfo extends \Cms\Classes\ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Child Info Get',
            'description' => 'Displays child info'
        ];
    }

    public function childrendetails()
    {
        return Child::select()->get();
    }

    public function child()
    {
        return Child::find($this->property('id'));
    }

}