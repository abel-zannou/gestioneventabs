<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function GetVisitorDetails()
    {
        $ip_adress = $_SERVER['REMOTE_ADDR'];
        date_default_timezone_set("Africa/Porto-Novo");
        $visit_time = date("h:i:sa");
        $visit_date = date("d-m-Y");

        $result = Visitor::insert([
            'ip_adress' => $ip_adress,
            'visite_time' => $visit_time,
            'visite_date' => $visit_date,
        ]);

        return $result;
    }
}
