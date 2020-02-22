<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use App\Board;
//use App\Listing;
//use App\Member;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }
    public function index()
    {
        //$data['board_count'] = Board::count();
        //$data['listing_count'] = Listing::count();
        //$data['members_count'] = Member::count();
        //return view('admin.dashboard', compact('data'));
        $active_mn = 'dashboard';
        $active_sub_mn = '';
        return view('admin.dashboard',compact('active_mn','active_sub_mn'));
    }
}
