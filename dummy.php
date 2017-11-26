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
  		$retailer_id='debaditya';
  		$query="select products.name,products.brand,products.mrp,retailer_avail.availability,retailer_avail.description from products,retailer_avail where products.p_id=retailer_avail.p_id and retailer_avail.retailer_id='".$retailer_id."'";
  		$result=$conn->query($query);
      echo(json_encode($result));
  		if($result->num_rows>0){
  			$response['queryGet'] = "RET_SUCC";
  			$i=0;
  			while($row=$result->fetch_assoc()){
  				$response['products'][$i]['name']=$row["name"];
  				$response['products'][$i]['brand']=$row["brand"];
  				$response['products'][$i]['mrp']=$row["mrp"];
  				$response['products'][$i]['availability']=$row["availability"];
  				$response['products'][$i]['description']=$row["description"];
 				$i++;
  			}
  		}
  		else{
  			$response['queryGet'] = "RET_FAIL";
  		}
  	}
  	print(json_encode($response));	
?>