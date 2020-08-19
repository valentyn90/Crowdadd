<?php

namespace App\Http\Controllers;
use Auth;
use App\Helper;
use App\Category;
use App\Service;
use Illuminate\Http\Request;

class FreelancerBookingOverviewController extends Controller
{
    public function index()
    {
    	$user_id = Auth::user()->id;
        $categories = Category::all();
        $services= Service::whereHas('service_user', function($serviceUser)use($user_id){
        	$serviceUser->where('user_id', $user_id);
        })->get();
        
        $orders = Helper::getCategoryOrders(request('category')??$categories[0]->id);
        return view('back-end.freelancer.booking-overviews',compact('categories','orders', 'services'));
    }
}
