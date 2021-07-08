<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Address;
use App\Models\Company;
use App\Models\Post;

class UpdateDataController extends Controller
{

	public function __construct()
    {
        $this->api_users = 'https://jsonplaceholder.typicode.com/users';
        $this->api_posts = 'https://jsonplaceholder.typicode.com/posts';
    }


    public function updateUsers()
    {
    	/* get users data from url */
    	$users = $this->getDataFromUrl($this->api_users);
    	if(count($users)){

    		$this->updateUsersData($users);
    	}
    	return true;
    }

    public function updatePosts()
    {
    	/* get posts data from url */
    	$posts = $this->getDataFromUrl($this->api_posts);
    	if(count($posts)){
    		$this->updatePostsData($posts);
    	}
    	return true;
    }

    public static function updateUsersData($users)
    {
    	/* update users data */
    	foreach ($users as $user) {
    		$get_user = User::firstOrNew(['id' =>  $user['id']]);
    		$get_user->id = $user['id'];
    		$get_user->name = $user['name'];
    		$get_user->username = $user['username'];
    		$get_user->email = $user['email'];
    		$get_user->password = Hash::make(base64_encode(random_bytes(10)));
    		$get_user->phone = $user['phone'];
    		$get_user->website = $user['website'];
    		$get_user->save();

			if($user['address']){
				$get_user_address = Address::firstOrNew(['user_id' =>  $get_user->id]);
				$get_user_address->street = $user['address']['street'];
				$get_user_address->suite = $user['address']['suite'];
				$get_user_address->city = $user['address']['city'];
				$get_user_address->zipcode = $user['address']['zipcode'];
				$get_user_address->geo_lat = $user['address']['geo']['lat'];
				$get_user_address->geo_lng = $user['address']['geo']['lng'];				 
				$get_user_address->save(); 
			}
			if($user['company']){
				$get_user_company = Company::firstOrNew(['user_id' =>  $get_user->id]);
				$get_user_company->name = $user['company']['name'];
				$get_user_company->catch_phrase = $user['company']['catchPhrase'];
				$get_user_company->bs = $user['company']['bs'];			 
				$get_user_company->save(); 
			}
    	}
    } 

    public static function updatePostsData($posts)
    {
    	/* get posts data from url */
    	foreach ($posts as $post) {
    		$check_if_user_exists = User::find($post['userId']);
    		if($check_if_user_exists){
    			$get_post = Post::firstOrNew(['id' =>  $post['id']]);
    			$get_post->user_id = $post['userId'];
	    		$get_post->title = $post['title'];
	    		$get_post->body = $post['body'];
	    		$get_post->save();
    		} 
    	}
    } 

    public static function getDataFromUrl($url)
    {
    	/* get data from url */
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		$result = curl_exec($curl);
		if(!$result){
			die("Connection Failure");
		}
		curl_close($curl);

		$results = json_decode($result, true);
		
		return $results;
    }
}
