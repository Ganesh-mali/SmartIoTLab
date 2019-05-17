//This program works fine on the local machine by putting the ip address 172.18.22.9 instead of 127.0.0.1
<html>
<head>
  Device Status
</head>
<body>
<p>Displaying list of client online</p>
<table border="1">
<tr>
<th>Device Id</th>
<th>Status</th>
<th>Host Address</th>
</tr>
<?php
$curl = curl_init("http://UhXVlAWRjbDq6W5WbWnBdF0iBZIjYJdN@127.0.0.1:8889/api/v1/session/show");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl);
$some_array = json_decode($result,true);
//echo $result;
//print_r($some_array);
$clients = $some_array['table'];
$total_client = count($some_array['table']);
$count=$total_client;
$start=0;
while($start<$count){
  $client_id = $clients[$start]['client_id'];
  $status = $clients[$start]['is_online'];
  if($status==1){
    $status="true";
  }
  else {
      $status="false";
  }
  $haddress = $clients[$start]['peer_host'];
  ?>
  <tr>
    <td><?php echo $client_id ?></td>
    <td><?php echo $status ?></td>
    <td><?php echo $haddress ?></td>
  </tr>
  <?php
  $start++;
}
?>
</table>
</body>
</html>
