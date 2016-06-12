<?php
$query=$_POST['query'];

function get_url_contents($url) {
    $crl = curl_init();

    curl_setopt($crl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
    curl_setopt($crl, CURLOPT_URL, $url);
    curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($crl, CURLOPT_CONNECTTIMEOUT, 5);

    $ret = curl_exec($crl);
    curl_close($crl);
    return $ret;
}

$json = get_url_contents("http://ajax.googleapis.com/ajax/services/search/images?rsz=8&v=1.0&q=".$query);

$data = json_decode($json);

foreach ($data->responseData->results as $result) {
    $results[] = array('url' => $result->url, 'alt' => $result->title, 'height' => $result->height ,'width' => $result->width);
	
	
}

echo json_encode($results);

?>