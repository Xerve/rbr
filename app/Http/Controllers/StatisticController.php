<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Post;

use DB;

class StatisticController extends Controller
{
    public function chart()
    {
    	/* get all post with author created in the last 7 days*/
    	$posts = Post::with('author')->where('created_at', '>=', Carbon::now()->subDays(7))->get();

    	/* group this posts by day */
    	$posts = $posts->groupBy(function($date) {
	        return Carbon::parse($date->created_at)->format('d');
	    });

    	/* map this posts and group by user_id and sort by count posts of every user */
	    $posts = $posts->map(function($item) {
	    	$item = $item->groupBy('user_id');
	    	$item = $item->sortByDesc(function ($posts) {
			    return count($posts);
			});
	    	$item->count_posts = $item->first()->count();
	    	$item->author = $item->first()->first()->author;
		    return $item;
		});
	    $posts = $posts->sortDesc();

    	return view('chart', compact('posts'));
    }
}
