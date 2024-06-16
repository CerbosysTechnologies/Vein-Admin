<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function getLabAppointment(){
        return view("admin.appointments.lab");
    }

    public function getHomeAppointment(){
        return view("admin.appointments.home");
    }
}
