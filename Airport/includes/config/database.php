<?php
  function conectarDB(){
    $db=mysqli_connect('localhost','root','','ticket');
    
    if($db){
         //echo "se conecto";
    }
   else{echo "error al conetar";}
    return $db; 
  
  }
  conectarDB();
?>