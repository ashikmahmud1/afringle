<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Booking extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('App_model', 'Booking_model'));
    }

    /*
    *Get All Booking List
    */
    function index()
    {
        $data = array( 'page_title' => 'Booking List' );
        $data['BookingList'] = $this->Booking_model->AllBookingsData();
        $this->parser->parse('booking/bookinglist', $data);
    }

    /*
    *Add Booking
    */
    public function add(){

  		if($this->Permissions->is_Clerk() == 1){ redirect('access-denied');}

     		$data = array(
          'page_title' => 'Add Booking',
   		);

  		if(!empty($this->input->get('booking_id'))){
  			$data['roomData'] = $this->Booking_model->RoomData($this->input->get('booking_id'));
  		}

   		$data['Services'] = $this->Booking_model->Services();

  		$this->form_validation->set_rules('first_name', 'First Name', 'required');
      $this->form_validation->set_rules('last_name', 'Last Name', 'required');
      $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
      $this->form_validation->set_rules('phone_number', 'phone number', 'required');
      $this->form_validation->set_rules('address_line_1', 'address', 'required');
      $this->form_validation->set_rules('city', 'city', 'required');
      $this->form_validation->set_rules('zip_postcode', 'post code', 'required');
      $this->form_validation->set_rules('Card_holder_name', 'Card Holder Name', 'required');
      $this->form_validation->set_rules('CardNumber', 'Debit/Credit Card Number', 'required');
      $this->form_validation->set_rules('expiry_month', 'Expiration Month', 'required');
      $this->form_validation->set_rules('expiry_year', 'Expiration Year', 'required');
      $this->form_validation->set_rules('cvv', 'Card CVV', 'required');

   		if ($this->form_validation->run() == FALSE)
      {
           $this->parser->parse('booking/addbooking', $data);
      }
      else
      {
  			$post = $this->input->post();

				$customer_data = [
                'first_name'    => $post['first_name'],
                'last_name'     => $post['last_name'],
                'email'         => $post['email'],
                'phone_number'  => $post['phone_number'],
                'address_line_1'=> $post['address_line_1'],
                'address_line_2'=> $post['address_line_2'],
                'city'          => $post['city'],
                'state'         => $post['state'],
                'zip_postcode'  => $post['zip_postcode'],
                'country'       => $post['country'],
                'special_requirements' => $post['special_requirements'],
                'tc'             => 1,
            ];
            $customer_id = $this->Booking_model->CustomerData($customer_data);
            if ($customer_id != false)
            {
                $payment_details = [
                    'Card_holder_name' => $post['Card_holder_name'],
                    'CardNumber' => $post['CardNumber'],
                    'Month' => $post['expiry_month'],
                    'Year' => $post['expiry_year'],
                    'Cvv' => $post['cvv']
                ];
                $guestRoom_data = $this->Booking_model->GetRoomDataByM( $this->input->get('booking_id') );

                $booking_room_json = [];
                $room_ids = [];
                foreach($guestRoom_data as $key => $value) {

                    $room_ids[] = $value['room_id'];
                    $booking_room_json[] = ['Room_id' => $value['room_id'],
                        'Room_name' => $value['room_name'],
                        'total_person' => $value['max_person'],
                        'total_price' => $value['adult_price'] + $value['child_price']
                    ];
                }
                $customerName = $post['first_name'].' '.$post['last_name'];
                if ($this->session->userdata('admin_coupon_code')) {
                    $coupon_code = $this->session->userdata('admin_coupon_code');
                } else {
                    $coupon_code = $post['coupon_code'];
                }

        				$access_token = time().$post['email'];
        				$t=time().$this->session->userdata('guest_user_id') ;
                $booking_token = $this->encryptIt($t.'+'.$post['email'].'+'.$customerName);
                $room_arry = array_merge(
          								['rooms' => $booking_room_json],
          								['service' => json_encode($post['guest_service'])],
          								['coupon' => $coupon_code],
          								['adults' => $this->session->userdata['Admin_Search']['adults']],
          								['childs' => $this->session->userdata['Admin_Search']['childs']]
                       );
                $booking_data = [
              					'booking_token' => $booking_token,
              					'timetoken' => $t,
              					'client_id' => $customer_id,
                        'client_email' => $post['email'],
                        'payment_details' => json_encode($payment_details),
                        'booking_start_date' => date('Y-m-d', strtotime($this->session->userdata['Admin_Search']['start_date'])),
                        'booking_end_date' => date('Y-m-d', strtotime($this->session->userdata['Admin_Search']['end_date'])),
                        'booking_room_json' => json_encode($room_arry),
              					'room_ids' => $room_ids[0],//json_encode($room_ids),
              					'booking_create_date' => date('Y-m-d H:i:s') ,
              					'hotel_id' => 2,

                    ];

                  $booking_id = $this->Booking_model->BookingData($booking_data);
                  if ($booking_id != false)
                  {
                      $this->session->set_flashdata('message', 'Details of your reservation have just been sent to you in a confirmation email, we look forward to seeing you soon. In the meantime if you have any questions feel free to contact us.');
                      $booking_cancle_url = base_url('booking-cancle?token='.$booking_token);
                      $this->Booking_email($post['email'], $room_arry, $booking_cancle_url, $customerName,$booking_id);
                      $array_items = array('Admin_Search','admin_coupon_code');
                      $this->session->unset_userdata($array_items);
                      redirect('booking/booking-add?booking_status=complete');
                  }
                  else
                  {
                      $this->session->set_flashdata('message', '<span style="color:red;">Booking Failed Please try again !</span>');
                      redirect('booking/booking-add?booking_status=incomplete');
                  }
  		     }
  		}

  	}




    public function apply_coupon_admin() {
          $coupon_code = $this->input->post('couponcode');
          //echo $coupon_code;
          $result = $this->Booking_model->GetCouponDiscount($coupon_code);
          $json_response = [];
          if (!empty($result)) {
              if (strtotime($result['end_date']) <= strtotime(date('Y/m/d'))) {
                  $this->session->set_userdata('admin_coupon_code', $result['code']);
                  $json_response = ['status' => 1, 'message' => '<span style="color:#060;">Coupon Apply</span>'];
              } else {
                  $json_response = ['status' => 0, 'message' => '<span style="color:#900;">Coupon Code Expired !</span>'];
              }
              //print_r($result);
          } else {
              $json_response = ['status' => 0, 'message' => '<span style="color:#900;">Coupon Code mis-match !</span>'];
          }
          echo json_encode($json_response);

      }

  	    public function Booking_email($to, $mail_data, $booking_cancle_url, $customerName,$booking_id) {

          $data['booking_id'] = $booking_id;
  		    $data['details'] = $mail_data;
          $data['email'] = $to;
          $data['customerName'] = $customerName;
          $data['booking_cancle_url'] = $booking_cancle_url;


  		    $admin_Email = 'assad@riversidenpr.com';
          $manager_Email = 'info@riversidenpr.com';

          $from_email = 'reservations@riversidenpr.com';
          $replyemail = 'reservations@riversidenpr.com';



          $to_email = $to;
          $subject = 'Your Room Booking Details';
          $this->Booking_model->SMTP_config(); //
          $this->email->set_newline("\r\n");
          $this->email->set_mailtype("html");
          $this->email->from($from_email, $name = '');
          $this->email->to($to_email);
          $this->email->cc($admin_Email);
          $this->email->bcc($manager_Email);
          $this->email->reply_to($replyemail);
          $this->email->subject($subject);
          $this->email->message($this->parser->parse('front/mail_template', $data, true));
          return $this->email->send();

      }

  	    public function encryptIt($q) {
          $cryptKey = '59d86cbd51c35';
          $qEncoded = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), $q, MCRYPT_MODE_CBC, md5(md5($cryptKey))));
          return ($qEncoded);
      }

      public function decryptIt($q) {
          $cryptKey = '59d86cbd51c35';
          $qDecoded = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), base64_decode($q), MCRYPT_MODE_CBC, md5(md5($cryptKey))), "\0");
          return ($qDecoded);
      }


      /*
      *Search Booking
      */
  	public function search_booking(){

    	$post = $this->input->post();

  		$start = date('Y-m-d',strtotime($post['start_date']));
  		$end =  date('Y-m-d',strtotime($post['end_date']));
  		$max_person = $post['adults']+$post['childs'];
  		$post = $this->input->post();
      if (!empty($post)) {
          $this->session->set_userdata('Admin_Search', $post);
      }
   		$rooms = $this->Booking_model->RoomsAvailablesSearchManger($start,$end,$max_person);

  		$ResultsArray=[];
  		foreach($rooms as $row){
  			//echo strtotime(date('Y-m-d')).'??'.strtotime($row['end_date']).'<br>';
  			if( strtotime(date('Y-m-d')) < strtotime($row['end_date'])  ){
  				//echo $row['end_date'];
  				//echo $row['room_name'].'?00<br>';
  			}else{
  				//echo $row['end_date'];
  				//echo $row['room_name'].'????<br>';
  				  $room = $this->Booking_model->RoomData($row['room_id']);
  					$ResultsArray[] = [
  						'room_id' => $room['room_id'],
  						'room_name' => $room['room_name'],
  						'room_slug' => $room['room_slug'],
  						'total_person' => $room['max_person'],
  						'adults' => $room['adult_price'],
  						'childs' => $room['child_price'],
  						'total_price' => $room['adult_price'] + $room['child_price'],
  						'services' => $this->Booking_model->GetRoomServices(json_decode($room['services'])),
  						'features' => $this->Booking_model->GetRoomFeatures(json_decode($room['features'])),
  						'room_tax' => $room['room_tax'],
  						'short_description' => $room['room_short_description'],
  						'full_description' => $room['room_long_description'],
  						'main_image' => base_url('upload/room/'.$room['room_main_image']),
  						'other_image' => base_url('upload/room/'.$room['other_image']),
  					];

  			}
   		}

  		$this->session->set_tempdata('ResultsArray',$ResultsArray,5);
  		redirect('booking/booking-add');

  	}


  	public function view_booking(){// ajax call in fucnitn

  		$booking_id = $this->input->post('id');

  		$res = $this->Booking_model->GetBookingRow($booking_id);
   		$client = $this->Booking_model->GetClientDetail($res['client_id']);
  		$details =  json_decode($res['booking_room_json'],true);
  		$payment =  json_decode($res['payment_details'],true);

  		$room = $this->Booking_model->RoomData($details['rooms'][0]['Room_id']);
   		?>
              <table id="example" class="display table table-hover table-condensed">
                  <thead>
                      <tr>
                        <th colspan="3">Client Personal Details</th>
                      </tr>
                      <tr>
                      	<td><?=$client[0]['first_name']." ".$client[0]['last_name'];?></td>
                          <td><?=$client[0]['email'];?></td>
                          <td><?=$client[0]['phone_number'];?></td>
                      </tr>
                  </thead>
                  <tr>
                    <td>Address line 1 : <?=$client[0]['address_line_1'];?></td>
                    <td>Address line 2 : <?=$client[0]['address_line_2'];?></td>
                    <td>City : <?=$client[0]['city'];?></td>
                  </tr>

                  <tr>
                    <td>State : <?=$client[0]['state'];?></td>
                    <td>Zip/Postal Code : <?=$client[0]['zip_postcode'];?></td>
                    <td>Country : <?=$client[0]['country'];?></td>
                  </tr>

                  <tr>
                    <th colspan="3">Client Card Details</th>
                  </tr>
                  <tr>
                  	<td>Card Holder Name : <?=$payment['Card_holder_name'];?></td>
                      <td>Card Number : <?=$payment['CardNumber'];?></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td>Month/Year : <?=$payment['Month'];?>/<?=$payment['Year'];?></td>
                      <td>CVV Code : <?=$payment['Cvv'];?></td>
                      <td></td>
                  </tr>
                  <tr>
                    <th>Room</th>
                    <th>Total Persons</th>
                    <th>Per Night Price</th>
                  </tr>
                  <tbody>
                  <?php
          					$room_tax_id = $room['room_tax'];
           					$tax = $this->Booking_model->GetTax($room_tax_id);

				            $total_days = $this->getDaysCount($res['booking_start_date'],$res['booking_end_date']);
				            if( $total_days > 1) {  $total_days = $total_days -1 ; } else { $total_days = 1 ; }
                    $total_Amt=[];
                    for($i=0; $i<count($details['rooms']); $i++ )
                    {
  					             $multipleAmount = $details['rooms'][0]['total_price']*$total_days;
                         $total_Amt[]= $tax['tax_percentage']/100*$multipleAmount+$multipleAmount; //$details['rooms'][$i]['total_price']+$details['rooms'][0]['total_price']; //$details['rooms'][$i]['total_price'];
                  ?>
                    <tr>
                      <td><?=$details['rooms'][$i]['Room_name']?></td>
                      <td><?=$details['rooms'][$i]['total_person']?></td>
                      <td>$<?=$details['rooms'][$i]['total_price']?></td>
                    </tr>

                   <?php }?>
                    <tr> <th>Room Tax : -</th>
                    		<td><?=$tax['tax_name']?></td>
                        <td><?=$tax['tax_percentage']?>%</td>
                    </tr>
                    <tr>
                      <th>Room Check-in Check-out </th>
                      <td colspan="2"><?=$res['booking_start_date'];?>  to <?=$res['booking_end_date'];?></td>
                    </tr>
                     <tr>
                       <th>Room Amount with Total Days : </th>
                    		<td><?=$total_days?> Days</td>
                    		<td>$<?=$details['rooms'][0]['total_price']?> x <?=$total_days?> = $<?=$details['rooms'][0]['total_price']*$total_days?></td>
                    </tr>
                    <tr>
                      <th colspan="2">Room Amount With Tax : </th>
                    	<td>$<?=$tax['tax_percentage']/100*$multipleAmount+$multipleAmount;?></td>
                    </tr>
                  </tbody>
                  <tr>
                    <th colspan="3">Special Requirements</th>
                  </tr>
                  <tr>
                    <td colspan="3"><?=$client[0]['special_requirements'];?></td>
                  </tr>
                  <tr>
                    <th colspan="1">Extra Room Services</th>
                    <th colspan="2">Service Tax</th>
                  </tr>
                   <?php
                   $service = json_decode($details['service'],true);
                   $servicTotalAmt=[];
                   if (!empty($service))
                    foreach($service as $id)
                    {
                        $s = $this->db->get_where('services',['service_id' =>$id ])->row_array();
  						          $tax = $this->Booking_model->GetTax($s['tax_type']);
                        $tax_amount = $tax['tax_percentage']/100*$s['price']+$s['price'];
                        $servicTotalAmt[]=$tax_amount*$total_days;
                  ?>
                  <tr>
                    <td><?=$s['title']?>  (<?=$s['description']?>) </td>
                    <td><?=$tax['tax_name']?> (<?=$tax['tax_percentage']?>%) </td>
                    <td>$<?=$tax_amount;?> x <?=$total_days;?> = $<?=$tax_amount*$total_days;?></td>
                  </tr>
                  <?php }
                      $total=array_sum($total_Amt)+array_sum($servicTotalAmt);
                      $discount=0;

                   if(!empty($details['coupon'])){ ?>
                  <tr>
                    <th colspan="3">Coupons</th>
                  </tr>
                  <tr>
                    <td colspan="2">
                    <?php
                    $c = $this->db->get_where('coupon_code',['code' => $details['coupon'] ])->row_array();
                    echo $c['code'];
                    $discount = $total/$c['discount'];
                    ?>
                    </td>
                    <td>- <?=$c['discount']?>%</td>
                  </tr>
                  <?php }?>
                  <tr>
                    <th colspan="2">Total Due Amount</th>
                    <th>$<?=$total-$discount;?></th>
                  </tr>
                </table>
          <?php
  	}


  /*
  *Get Days Count
  */
  	function getDaysCount($startDate, $endDate) {
  		$holidays=['0'];
  		$day = 86400; // Day in seconds
  		$sTime = strtotime($startDate); // Start as time
  		$eTime = strtotime($endDate); // End as time
  		$numDays = round(($eTime - $sTime) / $day) + 1;
  		$days = array();

  		for ($d = 0; $d < $numDays; $d++) {
  			$day_number = date('N', ($sTime + ($d * $day)));
  			if (!in_array($day_number, $holidays)) {
  				$days[] = date('Y-m-d N', ($sTime + ($d * $day)));
  			}
  		}
  		return count($days);
  	}
}
