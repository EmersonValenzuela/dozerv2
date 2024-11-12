<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailsController extends Controller
{
    public function index()
    {
        return view('sendmail.index');
    }
}
