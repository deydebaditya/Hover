<?php
  $username="root";
  $dbname="hover";
  $url="localhost";
  $password="";
  mysqli_report(MYSQLI_REPORT_STRICT);
  $fail=false;
  $response['conn']="FL_CONN";
  try{
    $conn=new mysqli($url,$username,$password,$dbname);
  }
  catch(Exception $e){
    //echo $e->message;
    $fail=true;
  }
  if($fail){
    $response['conn']="CONN_FAIL";
  }
  else{
    $response['conn']="CONN_SUCCESS";
    $id=RndString();
    $HEAD=getallheaders();
    $name=$HEAD['name'];
    $brand=$HEAD['brand'];
    $mrp=$HEAD['mrp'];
    $category=$HEAD['category'];
    $description=$HEAD['description'];
    $retailer_id=$HEAD['retailer_id'];
    $availability=$HEAD['availability'];
    $price=$HEAD['price'];
    $retailer_comment=$HEAD['retailer_comment'];
    $response['values']['p_id']=$id;
    $response['values']['name']=$name;
    $response['values']['brand']=$brand;
    $response['values']['mrp']=$mrp;
    $response['values']['category']=$category;
    $response['values']['description']=$description;
    $response['values']['retailer_id']=$retailer_id;
    $response['values']['availability']=$availability;
    $response['values']['price']=$price;
    $response['values']['retailer_comment']=$retailer_comment;
    $query="insert into products (p_id,name,brand,mrp,category,description) values('".$id."','".$name."','".$brand."',".$mrp.",'".$category."','".$description."')";
    $query_retailer_avail="insert into retailer_avail (p_id,retailer_id,availability,price,description) values('".$id."','".$retailer_id."',".$availability.",".$price.",'".$retailer_comment."')";
    if($id==""||$name==""||$brand==""||$mrp==""||$category==""||$description==""||$retailer_id==""||$availability==""){
      $response['queryInsert']="IN_FAIL";
    }
    else{
      $result=$conn->query($query);
      if($result){
        $response['queryInsert'] = "IN_SUCC";
      }
      else{
        $response['queryInsert'] = "IN_FAIL";
      }
      $result=$conn->query($query_retailer_avail);
      if($result){
        $response['queryInsert'] = "IN_SUCC";
      }
      else{
        $response['queryInsert'] = "IN_FAIL";
      }
    }
  }
  print(json_encode($response));
  function RndString()
  {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < 10; $i++) {
        $randstring = $randstring . $characters[rand(0, strlen($characters))];
    }
    return $randstring;
  }
 ?>