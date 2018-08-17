<?php

namespace Plive\Http\Controllers;

use Illuminate\Http\Request;
use Plive\Http\Model\Artist;

class IndexController extends Controller
{
    public function index() {
    	$artists = Artist::all();
    	return view('top.index', ['artists' => $artists]);
    }
}
