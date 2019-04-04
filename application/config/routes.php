<?php

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = 'bo/Login/index';




$route['rooms-available'] = 'front/BookingController/rooms_available';
$route['rooms-available/:num'] = 'front/BookingController/rooms_available';
$route['single-room'] = 'front/BookingController/single_room_details';

$route['single-room-display'] = 'front/BookingController/single_room_display';

$route['booking-step-1'] = 'front/BookingStepsController/Step_I';
$route['booking-step-2'] = 'front/BookingStepsController/Step_II';
$route['booking-step-2/:num'] = 'front/BookingStepsController/Step_II';
$route['booking-step-3'] = 'front/BookingStepsController/Step_III';
$route['booking-complete'] = 'front/BookingStepsController/Step_IV';

$route['apply-coupon'] = 'front/BookingStepsController/apply_coupon';

$route['booking-cancle'] = 'front/BookingStepsController/booking_cancle';
$route['booking-status'] = 'front/BookingStepsController/booking_status';
$route['booking-status-cancellation'] = 'front/BookingStepsController/confirm_booking_cancellation';



$route['add-guest-user-data'] = 'front/BookingStepsController/add_guest_user_data';

$route['things-to-do'] = 'front/PagesController/things_to_do';
$route['contact-us'] = 'front/PagesController/contact_us';
$route['careers'] = 'front/PagesController/careers';
$route['subscribe'] = 'front/PagesController/subscribe';
$route['thank-you'] = 'front/PagesController/thank_you';


/////////////////////////////////////////////////////////////////////







$route['Checker']             = 'PermissionController/Checker';
$route['admin/access-denied'] = 'PermissionController/Error';

$route['access-denied']      = 'bo/Access/index';
$route['adminlogin']      = 'bo/Login/index';
$route['admin-login']     = 'bo/Login/doLogin';
$route['admin-logout']    = 'bo/Login/logout';
$route['admin/dashboard'] = 'bo/Dashboard/index';

$route['admin/hotel-add']    = 'Hotel/add';
$route['admin/hotel-list']   = 'Hotel/index';
$route['admin/delete-hotel'] = 'Hotel/delete';
$route['admin/edit-hotel']   = 'Hotel/edit';

$route['clerk/clerk-add']     = 'bo/Clerk/add';
$route['clerk/clerk-list']    = 'bo/Clerk/index';
$route['clerk/delete-clerk']  = 'bo/Clerk/delete';
$route['clerk/edit-clerk']    = 'bo/Clerk/edit';

$route['Chemistry/Chemistry-add']        = 'bo/Facility/add';
$route['Chemistry/Chemistry-submit']     = 'bo/Facility/save';
$route['Chemistry/Chemistry-update']     = 'bo/Facility/update';
$route['Chemistry/Chemistry-list']      = 'bo/Facility/index';
$route['facility/edit-facilitie']       = 'bo/Facility/edit';
$route['facility/delete-facilitie']     = 'bo/Facility/delete';
$route['facility/facilitie-ajax_submit']= 'bo/Facility/ajax_submit';

$route['coupon/coupon-add']   = 'bo/Coupon/add';
$route['coupon/coupon-list']  = 'bo/Coupon/index';
$route['coupon/edit-coupon']  = 'bo/Coupon/edit';
$route['coupon/delete-coupon']= 'bo/Coupon/delete';

$route['couponcode/couponcode-add']   = 'bo/Coupontype/add';
$route['couponcode/couponcode-list']  = 'bo/Coupontype/index';
$route['couponcode/edit-couponcode']  = 'bo/Coupontype/edit';
$route['couponcode/delete-couponcode']= 'bo/Coupontype/delete';


$route['admin/email-template-add']    = 'EmailTemplateController/Add_data';
$route['admin/email-template-list']   = 'EmailTemplateController/ListData';
$route['admin/edit-email-template']   = 'EmailTemplateController/Edit_data';
$route['admin/delete-email-template'] = 'EmailTemplateController/Delete_data';


$route['booking/booking-add']        = 'bo/Booking/add';
$route['booking/booking-list']       = 'bo/Booking/index';
$route['booking/booking-view']       = 'bo/Booking/view_booking';

$route['admin/search-booking']       = 'bo/Booking/search_booking';
$route['admin/apply-coupon-admin']   = 'bo/Booking/apply_coupon_admin';


$route['admin/list-contact-us'] = 'front/PagesController/list_contact_admin';
$route['admin/list-careers']    = 'front/PagesController/list_careers_admin';

$route['contact/list-contact-us'] = 'bo/Contact/index';
$route['careers/list-careers']    = 'bo/Contact/careerslist';

$route['calander/view-calander']  = 'bo/Schedule/index';



$route['hotel/hotel-add']     = 'bo/Hotel/add';
$route['user/user-list']    = 'bo/Hotel/index';
$route['user/user-pending'] = 'bo/User/pending_list';
$route['user/add-user'] = 'bo/User/AddUser';
$route['user/delete-user']  = 'bo/Hotel/delete';
$route['user/update-user']  = 'bo/Hotel/update';

$route['hotel/hoteltype-add']  = 'bo/Hotel/hoteltype';

//=================== HRK ROUTERS========================================



$route['approve-pending-usr']      = 'bo/Hotel/ApproveUsr';
$route['delete-pending-usr']      = 'bo/Hotel/ApproveUsr';



$route['manager/manager-add']     = 'bo/Manager/AddManager';
$route['manager/manager-list']    = 'bo/Manager/index';
$route['manager/delete-manager']  = 'bo/Manager/delete_manager';
$route['manager/edit-manager']    = 'bo/Manager/EditManager';

$route['tax/tax-add']     = 'bo/Tax/Add_data';
$route['tax/taxes-list']  = 'bo/Tax/index';
$route['tax/edit-tax']    = 'bo/Tax/Edit_data';
$route['tax/delete-tax']  = 'bo/Tax/Delete_data';

$route['room/room-list']    = 'bo/Room/index';
$route['room/room-add']     = 'bo/Room/RoomAdd';
$route['room/delete-room']  = 'bo/Room/Delete';
$route['room/edit-room']    = 'bo/Room/Edit';

$route['event/event-add']    = 'bo/Event/Add';
$route['event/event-list']   = 'bo/Event/index';
$route['event/event-edit']   = 'bo/Event/EventEdit';
$route['event/event-delete']   = 'bo/Event/EventDelete';



$route['hair/hair-list']      = 'bo/Hair/index';
$route['hair/hair-add']       = 'bo/Hair/AddHair';
$route['hair/hair-edit']      = 'bo/Hair/EditHair';
$route['hair/hair-delete']    = 'bo/Hair/DeleteHair';

$route['bodytype/bodytype-list']      = 'bo/Bodytype/index';
$route['bodytype/bodytype-add']       = 'bo/Bodytype/AddBodytype';
$route['bodytype/bodytype-edit']      = 'bo/Bodytype/EditBodytype';
$route['bodytype/bodytype-delete']    = 'bo/Bodytype/DeleteBodytype';

$route['eyecolor/eyecolor-list']      = 'bo/Eyecolor/index';
$route['eyecolor/eyecolor-add']       = 'bo/Eyecolor/AddEyecolor';
$route['eyecolor/eyecolor-edit']      = 'bo/Eyecolor/EditEyecolor';
$route['eyecolor/eyecolor-delete']    = 'bo/Eyecolor/DeleteEyecolor';

$route['religion/religion-list']      = 'bo/Religion/index';
$route['religion/religion-add']       = 'bo/Religion/AddReligion';
$route['religion/religion-edit']      = 'bo/Religion/EditReligion';
$route['religion/religion-delete']    = 'bo/Religion/DeleteReligion';

$route['profession/profession-list']      = 'bo/Profession/index';
$route['profession/profession-add']       = 'bo/Profession/AddProfession';
$route['profession/profession-edit']      = 'bo/Profession/EditProfession';
$route['profession/profession-delete']    = 'bo/Profession/DeleteProfession';

$route['education/education-list']      = 'bo/Education/index';
$route['education/education-add']       = 'bo/Education/AddEducation';
$route['education/education-edit']      = 'bo/Education/EditEducation';
$route['education/education-delete']    = 'bo/Education/DeleteEducation';



$route['slip/pay-slip']      = 'bo/Hair/PaySlip';


$route['height/height-list']      = 'bo/Height/index';
$route['height/height-add']       = 'bo/Height/AddHeight';
$route['height/height-edit']      = 'bo/Height/EditHeight';
$route['height/height-delete']    = 'bo/Height/DeleteHeight';

$route['plan/plan-list']      = 'bo/Plan/index';
$route['plan/plan-add']       = 'bo/Plan/AddPlan';
$route['plan/plan-edit']      = 'bo/Plan/EditPlan';
$route['plan/plan-delete']    = 'bo/Plan/DeletePlan';

$route['order-history/order-history-list']      = 'bo/OrderHistory/index';
$route['order-history/order-history-add']       = 'bo/OrderHistory/AddOrderHistory';
$route['order-history/order-history-edit']      = 'bo/OrderHistory/EditOrderHistory';
$route['order-history/order-history-delete']    = 'bo/OrderHistory/DeleteOrderHistory';



$route['roomtype/edit-room-type']   = 'bo/Roomtype/Edit';
$route['roomtype/delete-room-type'] = 'bo/Roomtype/Delete';

$route['tribe/add-tribe'] = 'bo/Service/add_services';
$route['tribe/tribelist'] = 'bo/Service/index';
$route['service/edit-service'] = 'bo/Service/edit_services';
$route['service/delete-service'] = 'bo/Service/delete_services';

$route['hotel_service/add-service']    = 'bo/HotelService/add_services';
$route['hotel_service/servicelist']    = 'bo/HotelService/index';
$route['hotel_service/edit-service']   = 'bo/HotelService/edit_services';
$route['hotel_service/delete-service'] = 'bo/HotelService/delete_services';

$route['Story/Storylist']     = 'bo/Story/index';
$route['Story/addStory']      = 'bo/Story/addstory';
$route['Story/editStory']      = 'bo/Story/editstory';
$route['Story/deleteStory']      = 'bo/Story/deletestory';



$route['sales/sales-approve'] = 'bo/Sales/approvelist';
$route['sales/approvesales']  = 'bo/Sales/approvesales';
$route['sales/editsales']     = 'bo/Sales/singlesalesperson';
$route['sales/update_sales_team'] = 'bo/Sales/singlesalesperson';



$route['clients/clientlist'] = 'bo/Clients/index';
$route['clients/view-client'] = 'bo/Clients/viewclient';
//$route['clients/view-client'] = 'bo/Clients/selectClientNotes';
$route['clients/edit-client'] = 'bo/Clients/editclient';


$route['front/faq'] = 'Pages/faq';
$route['front/about'] = 'Pages/about';
$route['front/terms-and-condition'] = 'Pages/TermsCondition';
$route['front/privacy-policy'] = 'Pages/PrivacyPolicy';
$route['sales-join'] = 'Pages/SalesJoin';
$route['hotelier-join'] = 'Pages/HotelierJoin';
$route['customer-join'] = 'Pages/CustomerJoin';

//=================== HRK ROUTERS========================================

$route['send-email-to']     = 'bo/Email/SendEmailTo';
$route['email-send']     = 'bo/Email/SendEmail';










//=================== APP API ROUTERS========================================

$route['signup/verifyclient'] = 'AppController/verifyclient';
$route['signup/insertuser'] = 'AppController/insertuser';




//=================== APP API ROUTERS========================================





//========================= ADD EVENT ===================
$route['event/eventlist']     = 'bo/EventController/index';
$route['event/addevent']      = 'bo/EventController/addevent';
$route['event/editevent']      = 'bo/EventController/editevent';
$route['event/deleteevent']      = 'bo/EventController/deleteevent';
