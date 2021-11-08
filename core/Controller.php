<?php
namespace Core;
use Core\Response;

class Controller{
    /**
     * 
     * @var 
     * 
     */
    public $response;

    /**
     * 
     * construct function
     * 
     */
    public function __construct() {
        $this->response = $GLOBALS['response'];
    }


    /**
     * Sen the response to view
     * 
     * @param status code
     * @param data
     * @return void
     * 
     */
    public function send($status = 200 , $data = null) {
        $this->response->setHeader(sprintf('HTTP/1.1 ' . $status . ' %s' , $this->response->getStatusCodeText($status)));
        $this->response->setContent($data,$status);
        // $output = $this->response->render($status);
        // echo $output;
        return $this->response->render($status);
    }

    /**
     * call model
     * 
     * @param model 
     * @return void
     * 
     */
    // public function model($model){
    //     if(file_exists(_DIR_ROOT.'/app/Models/'.$model.'.php')){
    //         require_once _DIR_ROOT.'/app/Models/'.$model.'.php';
    //         if(class_exists($model)){
    //             $data = new $model;
    //             return $data;
    //         }
    //         else{
    //             return $this->view('Errors/404');
    //         }
    //     }
    //     else{
    //         return $this->view('Errors/404');
    //     }
        
    // }

    public function  view($nameview , $data=[] ,$status = 200)
    {
        
        if(file_exists(_DIR_ROOT.'/app/Views/'.$nameview.'.phtml')){
            $data = $this->send($status , $data);
            require_once _DIR_ROOT.'/app/Views/'.$nameview.'.phtml';
        }
        else{
            $data = $this->send(404,$data);
            require_once _DIR_ROOT.'/app/Views/Errors/404.phtml';
        }
    }

}

?>