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
    try
    {
      $posts = Post::all();
      foreach($posts as $post)
      {
        $this->res->data[] = $post->to_array();
      }
    }
    catch(\Exception $ex)
    {
      $this->res->message = "Exception: " . $ex->getMessage();
    }
    return $this->res;
  }

  public function delete($id=null)
  {
    try
    {
      $post = Post::find($id);
      $post->delete();
      $this->res->message = 'Deleted';
    }
    catch(\Exception $ex)
    {
      $this->res->message = "Exception: " . $ex->getMessage();
    }
    return $this->res;
  }

  public function post($id=null)
  {
    try
    {
      $attributes = $_POST;
      Post::create($attributes);
      $this->res->message = "Created new post";
    }
    catch(\Exception $ex)
    {
      $this->res->message = "Exception: " . $ex->getMessage();
    }
    return $this->res;
  }
}