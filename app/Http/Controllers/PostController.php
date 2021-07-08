<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {	
    	/* get all post with author */
    	$posts = Post::with('author')->get();

    	return view('posts', compact('posts'));
    }

    public function show($id)
    {
    	/* get post by id with author, address and company */
    	$post = Post::with('author', 'author.address', 'author.company')->findOrFail($id);

    	return view('post', compact('post'));
    }
}
