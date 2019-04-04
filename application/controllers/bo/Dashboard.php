<?php
/*
 * Developed By : OptiSoft
 * www.optisoft.in
 */

class Dashboard extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Sales_model','Story_model', 'App_model','User_model','Service_model','Event_model'));

    }

    function index()
    {
      $data = array('page_title' => 'Dashboard Penal');
      $data['dbsalesapprovelist'] =$this->Sales_model->Dashboardlistpendingsalesperson();
      $data['alluserslist'] =$this->User_model->approveUsersList();
      $data['monthUsersList'] =$this->User_model->monthUsersList();
      $data['pendingUsersList'] =$this->User_model->pendingUsersList();

      $data['ListStory'] =$this->Story_model->ListStory();
      $data['ListService'] =$this->Service_model->ListService();

      $data['EventList'] = $this->Event_model->ListEvent();

      $this->parser->parse('dashboard/index', $data);
    }
}
