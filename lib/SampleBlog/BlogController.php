<?php
namespace SampleBlog;

use Respect\Rest\Routable;
use SampleBlog\Models\Post;

class BlogController implements Routable
{
  private $res;

  public function __construct()
  {
    $this->res = new Response;
  }

  public function get($id=null)
  {
    $response = $this->res;
    if (is_null($id))
    {
      return $this->runAction(function() use ($response){
        $response->data = array();
        $posts = Post::all();
        foreach($posts as $post)
        {
          $response->data[] = $post->to_array();
        }
        $response->message = "Listing of posts";
      });
    }
    else
    {
      return $this->runAction(function() use ($id, $response){
        $post = Post::find($id);
        $response->data = $post->to_array();
        $response->message = "Listing of posts";
      });
    }
  }

  public function delete($id=null)
  {
    $response = $this->res;
    return $this->runAction(function() use ($id, $response){
        $post = Post::find($id);
        $post->delete();
        $response->message = 'Deleted';
      });
  }

  public function post($id=null)
  {
    $response = $this->res;
    return $this->runAction(function() use ($response){
      $attributes = $_POST;
      Post::create($attributes);
      $response->message = "Created new post";
    });
  }

  private function runAction($func)
  {
    try
    {
      $func();
    }
    catch(\Exception $ex)
    {
      $this->res->message = "Exception: " . $ex->getMessage();
    }
    return $this->res;
  }
}