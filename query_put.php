<?php
  $username="id3709620_hover";
  $dbname="id3709620_hover";
  $url="hoverapp.000webhostapp.com";
  $password="hoverapp";
  mysqli_report(MYSQLI_REPORT_STRICT);
  $fail=false;
  try{
    $conn=new mysqli($url,$username,$password,$dbname);
  }
  catch(Exception $e){
    //echo $e->message;
    $fail=true;
  }
  if($fail){
    echo "FL_CONN";
  }
  else{
    echo "SC_CONN";
    $id=RndString();
    $HEAD=getallheaders();
    $name=$HEAD['name'];
    $brand=$HEAD['brand'];
    $mrp=$HEAD['mrp'];
    $category=$HEAD['category'];
    $description=$HEAD['description'];
    $query="insert into products (p_id,name,brand,mrp,category,description) values('".$id."','".$name."','".$brand."',".$mrp.",'".$category."','".$description."')";
    if($id==""||$name==""||$brand==""||$mrp==""||$category==""||$description==""){
      echo "IN_FAIL";
    }
    else{
      $result=$conn->query($query);
      if($result ){
        echo "IN_SUCC";
      }
      else{
        echo "IN_FAIL";
      }
    }
  }
  function RndString()
  {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < 10; $i++) {
        $randstring = $randstring + $characters[rand(0, strlen($characters))];
    }
    return $randstring;
  }
 ?>
