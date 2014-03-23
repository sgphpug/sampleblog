<?php
namespace SampleBlog;

class Response
{
  public $message;

  public function __construct($message='', $data=null){
    $this->message = $message;
    if ( !is_null($data) && is_array($data) )
      $this->data = $data;
  }
}