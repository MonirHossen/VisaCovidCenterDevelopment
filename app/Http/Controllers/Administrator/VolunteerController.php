<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VolunteerController extends Controller
{
    public function index(){
        $trustedPeoples = User::where('center_id', Auth::user()->center_id)->whereIn('user_type', ['volunteer', 'receptionist', 'pathologist'])->orderBy('user_type', 'DESC')->get();
        return view('Administrator.volunteer.index', compact('trustedPeoples'));
    }
}
