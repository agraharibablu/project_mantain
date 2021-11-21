<?php 

function isLogin($CI,$user){

  if($CI->session->get($user)->loggedIn){
    return 1;
  }else{
      echo 'sdf';
       return 0;
  }
}


function sess($CI,$user){

    return (object) $CI->session->get($user);

}


function uri($CI,$segment){
  //echo "<pre>";
  //print_r($CI);
  echo $segment;

  echo $CI->request->uri->getSegment(1);
}