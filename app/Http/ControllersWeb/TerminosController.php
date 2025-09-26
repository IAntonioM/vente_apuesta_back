<?php


namespace App\Http\ControllersWeb;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TerminosController extends Controller
{
    public function showTerminosView()
    {
        return view('Terminos.index');
    }
}
