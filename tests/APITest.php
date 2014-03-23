<?php
use Guzzle\Http\Client;

class APITest extends PHPUnit_Framework_TestCase
{
  /**
   * @var Guzzle\Http\Client
   */
  private $guzzle;
  private $base_url = 'http://localhost/blog';
  private $headers = array('Accept'=>'application/json');

  protected function setUp()
  {
    $this->guzzle = new Client($this->base_url);
  }

  public function testEmptyListPosts()
  {
    $this->isEmptyList();
  }

  /**
   * @depends testEmptyListPosts
   */
  public function testAddAndDeletePost()
  {
    $post = array(
      'title' => 'My World',
      'content' => 'Welcome to my world',
      'published' => 1
    );

    $result = $this->guzzle->post('', $this->headers, $post)->send()->json();
    $this->assertStringStartsWith("Created" , $result['message'], "Post has been created");

    $result = $this->guzzle->get('', $this->headers)->send()->json();
    $this->assertNotEmpty($result['data'], "Post listing should not be empty");

    $new_id = $result['data'][0]['id'];
    $result = $this->guzzle->get($new_id, $this->headers)->send()->json();
    $this->assertNotEmpty($result['data']);
    $this->assertEquals('My World', $result['data']['title']);

    $result = $this->guzzle->delete($new_id, $this->headers)->send()->json();
    $this->assertStringStartsWith("Deleted" , $result['message'], "Deleted the post");

    $this->isEmptyList();
  }

  private function isEmptyList()
  {
    $result = $this->guzzle->get('', $this->headers)->send()->json();
    $this->assertEmpty($result['data'], "Post listing should be empty");
  }
}