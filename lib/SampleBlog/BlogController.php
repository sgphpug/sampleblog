<?php
namespace SampleBlog;

use Respect\Rest\Routable;
use SampleBlog\Response;

class BlogController implements Routable
{
  public function get($id=null)
  {
    return new Response('Listing all posts', array());
  }

  public function delete($id=null)
  {
    return new Response('Deleted', array());
  }

  public function post($id=null)
  {
    return new Response('Created', array());
  }
}