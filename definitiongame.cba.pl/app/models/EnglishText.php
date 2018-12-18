<?php

use Phalcon\Mvc\Model;

class EnglishText extends Model {
    public function initialize(){
    $this->setSource('hangman_text');
  }
  
  public $id;

  public $text;

  public $description;
  
  public $category;
  
  public $min_value;
  
  public $max_value;
  
  public $status;
}
