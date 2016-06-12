<?php
error_reporting(E_ERROR | E_PARSE);
 error_reporting(0);

			
				


				ini_set('max_execution_time',50000);				
				$arr_dir_name="";
					
					$query=$_POST['query'];
					$dname=$_POST['dname'];
					$cid=trim($_POST['cid']);
					
					
					$query = preg_replace('/\s+/', '', $query);
					$query = rtrim($query,',');
					
					
					$dname = preg_replace('/\s+/', '', $dname);
					$dname = rtrim($dname,',');
					
					
					
					$query=explode(",",$query);
					$dname=explode(",",$dname);
					
					if(sizeof($query)!=sizeof($dname))
						{
						echo "inv_cnt";
						return;
						}
					
					
					
					
					$offset=$_POST['offset'];
					$height=$_POST['sheight'];
					$width=$_POST['swidth'];					
					$incrm_off=$offset*50;
					
					for($j=0;$j<sizeof($query);$j++)
					{
							$l_query=trim($query[$j]);
					
					
					for($i=0;$i<=$incrm_off;$i+=50)
					{
					
					
					
					
				
                    // Replace this value with your account key
                    $accountKey = 'YOUR_ACOOUNT_KEY_HERE';
					if($cid!="")
						{
						$accountKey=$cid;
						}

                    $ServiceRootURL =  'https://api.datamarket.azure.com/Bing/Search/';

                    $WebSearchURL = $ServiceRootURL . 'Image?$format=json&Query=';

                    $context = stream_context_create(array(
                        'http' => array(
                            'request_fulluri' => true,
                            'header'  => "Authorization: Basic " . base64_encode($accountKey . ":" . $accountKey)
                        )
                    ));

                    $request = $WebSearchURL . urlencode( '\'' . $l_query.'\'')."&$"."skip=$i";

                   

                    $response = file_get_contents($request, 0, $context);
					
					
                    $jsonobj = json_decode($response);

                   
				  		 $img="";
						if(trim($dname[$j])!="")
							{
								mkdir('d_i/'.$dname[$j]);
								$arr_dir_name.=$dname[$j].",";
							}
				   
				   
					
					
                    foreach($jsonobj->d->results as $value)
                    {    
						
                        
						$sheight=$value->Height;
						$swidth=$value->Width;
						
						
						
						
						
						if($sheight> $height && $swidth>$width)
						{
						//echo $w."<br/>";
						$url = $value->MediaUrl;
						$ext=pathinfo($url, PATHINFO_EXTENSION);
						$name=strtotime(date("Y-m-d h:i:sa"));
						
						if(trim($dname[$j])=="")
							{
							$img = 'd_i/'.$name.".".$ext;
							}else
							{
							$img = 'd_i/'.$dname[$j].'/'.$name.".".$ext;
							}
						
						
     					file_put_contents($img, file_get_contents($url));
						}//end of dimension
						
                        
                    }


}//end of for loop
              
  }//loopfor query ends
  				$arr_dir_name = preg_replace('/\s+/', '', $arr_dir_name);   
				 $arr_dir_name=trim($arr_dir_name);       
				$arr_dir_name=rtrim($arr_dir_name,",");
				echo "dir".$arr_dir_name;
				
?>
 