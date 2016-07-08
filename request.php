<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json;charset=UTF-8");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    require_once 'Scrap.php';

    /* Get the json object vue post ajax */
    $postdata = file_get_contents("php://input");
    if($postdata){
        $postArray =  json_decode($postdata);
        $scrap  = new Scrap();
        $scrap::setUrl($postArray->url);
        $title = $scrap::getOpenGraphTitle();
        $description = $scrap::getOpenGraphDescription();
        $image = $scrap::getOpenGraphImg();
        $response = array('url'=>$postArray->url,'title' => $title, 'description' => $description, 'image' => $image);            
        echo json_encode($response,JSON_FORCE_OBJECT);
    }else{
        echo json_encode(['error' => 'you did not send a url'],JSON_FORCE_OBJECT);
    }
?>
