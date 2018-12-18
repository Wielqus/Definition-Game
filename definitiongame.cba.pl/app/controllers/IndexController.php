<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Request;

// Kontroller 'index'
class IndexController extends Controller {

    
    public function initialize() {

    }

    // Index action
    public function indexAction() {
        $response = new \Phalcon\Http\Response();
        $this->assets->addCss("js/Semantic-UI-master/dist/semantic.css");
        $this->assets->addCss("https://fonts.googleapis.com/css?family=Roboto+Slab");
        $this->assets->addCss("css/site.css");
        $this->assets->addJs("//code.jquery.com/jquery-3.2.1.min.js");
        $this->assets->addJs("https://cdn.jsdelivr.net/npm/vue");
        $this->assets->addJs("js/Semantic-UI-master/dist/semantic.js");
        $this->assets->addJs("js/site.js");
        $response->setContentType("text/plain", "UTF-8");
        $this->view->setMainView("layouts/head");
    }
    
    public function loadAction() {
        
        $request = new Request();
        
        if ($request->isAjax()) {
            if ($request->isPost()) {

                $ansverslist = array();

                $text = EnglishText::findFirst(
                                [
                                    "conditions" => "description IS NOT NULL AND LENGTH(text) < 20",
                                    "order" => "RAND()",
                                ]
                );
                $ansver = array("name" => $text->text, "true" => 1);
                array_push($ansverslist, $ansver);
                
                $ansverstext = EnglishText::find(
                                [
                                    "conditions" => "LENGTH(text) < 20",
                                    "order" => "RAND()",
                                    "limit" => 3
                                ]
                );

                foreach ($ansverstext as $ansver) {
                    $ansver = array("name" => $ansver->text, "true" => 0);
                    array_push($ansverslist, $ansver);
                }
                $response = array(
                    "ansvers" => $ansverslist,
                    "description" => $text->description
                );


                echo json_encode($response);
            }
        }
    }



  
    

}
