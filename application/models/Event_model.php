<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Event_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();

    }




    /*
     * Insert services
     */
 		public function Insertevent($data){

			$result = $this->db->insert('af_story', $data );
			if($result == 1)
				return true;
			  else
				return false;
		}



 		public function InsertEventData($data){

			$result = $this->db->insert('event', $data );
			if($result == 1)
				return true;
			  else
				return false;
		}

		
		
		 
		
		public function dataentry($s,$e)
		{







		
 			$this->db->select('*');
			$this->db->from('dataentry2');
			//$this->db->order_by("a", 157);
			$this->db->order_by("a", "asc");
            $this->db->offset($s);
            $this->db->limit($e);
 //$query = $this->db->get();
 //return $query->result_array();
		 	
			$totaldat = array();
	 $query = $this->db->get();
$ii = 0 ;
foreach ($query->result() as $row)
{  
//sleep(2);

$url= $row->b;;

$apiURL = 'https://www.googleapis.com/urlshortener/v1/url';
$key = 'AIzaSyC8NX04TF5Qip6K_BSFQC7kzYBi2gomYp0';
$mmm = $apiURL.'?key='.$key; 
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$mmm.'&shortUrl='.$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		// Execute the post
		$result = curl_exec($ch);
		// Close the connection
		curl_close($ch);
		// Return the result
	//	echo "<pre>";
		//print_r(json_decode($result,true));
		$nn = json_decode($result,true);
print_r($nn);
$pizza  = urldecode ($nn['longUrl']);;
$pieces = explode("/", $pizza);


if(count($pieces) > 4)
{
if( $pieces[4]  == 'place' )
{
foreach($pieces as $val)
{
if(substr($val, 0, 1) == "@") { $cordi =   $val ; }
}
$mm = str_replace("@","",$pieces[6]);
$mm =  str_replace("z","",$mm);
$mmdata = explode(",", $mm);

  $latitude = $mmdata[0]; 
  $longitude = $mmdata[1]; // Longitude
}
else
{	
$pieces2 = explode("&", $pieces[3]);
$mm2 = str_replace("?q=","",$pieces2[0]);
$geo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($mm2).'&key=AIzaSyBnblzAjsuQTQKZs6ixj8R1PKKDAxL30cU');
$geo = json_decode($geo, true); // Convert the JSON to an array
if (isset($geo['status']) && ($geo['status'] == 'OK')) {
  $latitude = $geo['results'][0]['geometry']['location']['lat']; // Latitude
  $longitude = $geo['results'][0]['geometry']['location']['lng']; // Longitude
}
}
}
else{
$pieces2 = explode("&", $pieces[3]);
$mm2 = str_replace("?q=","",$pieces2[0]);
$address = 'BTM 2nd Stage, Bengaluru, Karnataka 560076'; // Address
$geo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($mm2).'&key=AIzaSyBnblzAjsuQTQKZs6ixj8R1PKKDAxL30cU');
$geo = json_decode($geo, true); // Convert the JSON to an array
if (isset($geo['status']) && ($geo['status'] == 'OK')) {
  $latitude = $geo['results'][0]['geometry']['location']['lat']; // Latitude
  $longitude = $geo['results'][0]['geometry']['location']['lng']; // Longitude
}	
}

















	$totaldat[$ii]['id'] = $row->a;; 
	$totaldat[$ii]['emp_id'] = 0; 
	$totaldat[$ii]['latlong'] = $latitude.",".$longitude; 
	$totaldat[$ii]['image'] = "sample.jpg" ; 
	$totaldat[$ii]['unit'] = $row->c; 
	$totaldat[$ii]['sitename'] = $row->d; 
	$totaldat[$ii]['ownername'] = $row->e; 
	$totaldat[$ii]['status'] = $row->f; 
	$totaldat[$ii]['phone'] = $row->g; 
	$totaldat[$ii]['mobile'] = $row->h; 	
	$totaldat[$ii]['notes'] = ""; 	
	
	
	
	
	
	
	
	
$ii++;
    // if ($ii == 6) {
    //    break;    /* You could also write 'break 1;' here. */
    //} 	
	
}	
//print_r($totaldat);

//die();
	return $totaldat;		
			
			
		}		
		
		
		
    /*
     * list of services
     */
		public function ListEvent()
		{
 			$this->db->select('*');
			$this->db->from('event');
			$query = $this->db->get();
			return $query->result_array();
		}


		public function ListCountry()
		{
 			$this->db->select('*');
			$this->db->from('countries');
			$query = $this->db->get();
			return $query->result_array();
		}

    /*
     * Edit services
     */
		public function EditRowStory($id)
		{
 			$this->db->select('*');
			$this->db->from('af_story');
			$this->db->where('id',$id);
 			$query = $this->db->get();
			return $query->row_array();
		}
		public function EditRowEvent($id)
		{
 			$this->db->select('*');
			$this->db->from('event');
			$this->db->where('event_id',$id);
 			$query = $this->db->get();
			return $query->row_array();
		}

    /*
     * Update services
     */
		public function UpdateStory($data,$id){

			$result = $this->db->update('af_story', $this->security->xss_clean($data), ['id' => $id] );
			if($result == 1)
				return true;
			else
				return false;
		}



		public function UpdateEvent($data,$id){

			$result = $this->db->update('event', $this->security->xss_clean($data), ['event_id' => $id] );
			if($result == 1)
				return true;
			else
				return false;
		}

    /*
     * Delete services
     */
		public function DeleteEvent($id){
			$this->db->where('event_id', $id);
			$res = $this->db->delete('event');
			if($res == 1)
				return true;
			else
				return false;

		}
		public function DeleteStory($id){
			$this->db->where('id', $id);
			$res = $this->db->delete('af_story');
			if($res == 1)
				return true;
			else
				return false;

		}

}
