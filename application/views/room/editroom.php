<?php $this->load->view('inc/header'); ?>
<style>
label {
    font-weight: 600;
    display: inherit;
}
</style>
</head>
<body>

<!-- Page container -->
<div class="page-container">

	<!-- Page Sidebar -->
  <?php $this->load->view('inc/sidebar'); ?>

  <!-- /page sidebar -->

  <!-- Main container -->
  <div class="main-container">

	<!-- Main header -->
  <?php $this->load->view('inc/topnav'); ?>

	<!-- /main header -->

	<!-- Main content -->
		<div class="main-content">
			<h1 class="page-title">Add New Room</h1>
      &nbsp;&nbsp; <?=$this->session->flashdata('message');?>

			<!-- Breadcrumb -->






<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">

            <div class="panel-body">
                <div class="row">




            <form method="post" enctype="multipart/form-data" action="<?=base_url('room/edit-room?id='.$RowRoomData['room_id']);?>">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <div class="col-md-3">
                                          <label class="form-label" for="field-1">Room Type</label>
                                        </div>
                                        <div class="col-md-9">
                                          <select name="room_type" class="form-control m-bot15">
                                          <?php if(!empty($roomType)){
                  							foreach($roomType as $list){?>
                   						        <option <?php echo set_select('room_type', $list['room_type_id']); ?> value="<?=$list['room_type_id']?>"  <?php if($RowRoomData['room_type']==$list['room_type_id']){echo 'selected';}?> ><?=$list['room_type_name']?></option>
                  						<?php  }
                  							}?>
                                            </select>
                                           <?=form_error('room_type', '<div class="error">', '</div>');?>
                                        </div>
                                        <div class="clearfix"></div>
                                      </div>
                                      <div class="form-group">
                                        <div class="col-md-3">
                                          <label class="form-label" for="field-1">Room Name</label>
                                        </div>
                                        <div class="col-md-9">
                                          <div class="controls">
                                            <input type="text" name="room_name" value="<?=$RowRoomData['room_name']?>" class="form-control" id="field-3" >
                                             <?=form_error('room_name', '<div class="error">', '</div>');?>
                                          </div>
                                        </div>
                                        <div class="clearfix"></div>
                                      </div>
                                      <div class="form-group">
                                        <div class="col-md-3">
                                          <label class="form-label" for="field-1">Max Person</label>
                                        </div>
                                        <div class="col-md-9">
                                          <div class="controls">
                                            <input type="number" name="max_person"value="<?=$RowRoomData['max_person']?>" class="form-control" id="field-3" >
                                             <?=form_error('max_person', '<div class="error">', '</div>');?>
                                          </div>
                                        </div>
                                        <div class="clearfix"></div>
                                      </div>
                                      <div class="form-group">
                                        <div class="col-md-3">
                                          <label class="form-label" for="field-1">Adult Price</label>
                                        </div>
                                        <div class="col-md-9">
                                          <div class="controls">
                                            <input type="number" name="adult_price" value="<?=$RowRoomData['adult_price']?>" class="form-control" id="field-3" >
                                             <?=form_error('adult_price', '<div class="error">', '</div>');?>
                                          </div>
                                        </div>
                                        <div class="clearfix"></div>
                                      </div>
                                      <div class="form-group">
                                        <div class="col-md-3">
                                          <label class="form-label" for="field-1">Child Price</label>
                                        </div>
                                        <div class="col-md-9">
                                          <div class="controls">
                                            <input type="number" name="child_price" value="<?=$RowRoomData['child_price']?>" class="form-control" id="field-3" >
                                             <?=form_error('child_price', '<div class="error">', '</div>');?>
                                          </div>
                                        </div>
                                        <div class="clearfix"></div>
                                      </div>


                                      <div class="form-group">
                                        <div class="col-md-3">
                                          <label class="form-label" for="field-1">Add Services</label>
                                        </div>
                                        <div class="col-md-9">
                                        <?php

                   						$Jsonservices = json_decode($RowRoomData['services'],true);
                  					  ?>

                                          <select id="services" name="serviceslist[]" multiple="multiple">

                                           <?php if(!empty($servicesList)){
                  							foreach($servicesList as $list){?>
                   						        <option <?php if(@in_array($list['id'],$Jsonservices)){echo 'selected';}?>  <?php echo set_select('serviceslist[]', $list['id']); ?> value="<?=$list['id']?>"><?=$list['title']?></option>
                  						<?php  }
                  							}?>

                                          </select>
                                          <?=form_error('serviceslist', '<div class="error">', '</div>');?>
                                        </div>
                                        <div class="clearfix"></div>
                                      </div>
                                      <div class="form-group">
                                        <div class="col-md-3">
                                          <label class="form-label" for="field-1">Add Feature</label>
                                        </div>
                                        <div class="col-md-9">

                                            <?php

                  						$Jsonfeatures = json_decode($RowRoomData['features'],true);
                  					  ?>
                                          <!-- Build your select: -->
                                          <select name="featureslist[]" id="example-getting-started" multiple="multiple">
                                           <?php if(!empty($facilitieList)){
                  							foreach($facilitieList as $list){?>
                   						        <option <?php if(@in_array($list['facilitie_id'],$Jsonfeatures)){echo 'selected';}?>  <?php echo set_select('featureslist[]', $list['facilitie_id']); ?> value="<?=$list['facilitie_id']?>"><?=$list['facilitie_name']?></option>
                  						<?php  }
                  							}?>
                                          </select>
                                          <?=form_error('featureslist', '<div class="error">', '</div>');?>
                                        </div>
                                        <div class="clearfix"></div>
                                      </div>
                                      <div class="form-group">
                                        <div class="col-md-3">
                                          <label class="form-label" for="field-1">Tax %</label>
                                        </div>


                                        <div class="col-md-9">
                                          <select name="room_tax" class="form-control m-bot15">
                                          <?php if(!empty($taxesList)){
                  							foreach($taxesList as $list){?>
                   						        <option <?php if($RowRoomData['room_tax']==$list['tax_id']){echo 'selected';}?>   <?php echo set_select('room_tax', $list['tax_id']); ?> value="<?=$list['tax_id']?>"><?=$list['tax_name']. ' ('.$list['tax_percentage'].')%'?></option>
                  						<?php  }
                  							}?>
                                            </select>
                                           <?=form_error('room_tax', '<div class="error">', '</div>');?>
                                        </div>

                                        <div class="clearfix"></div>
                                      </div>



                                      <div class="form-group">
                                        <div class="col-md-3">
                                          <label class="form-label" for="field-1">Room Short Description</label>
                                        </div>
                                        <div class="col-md-9">
                                          <div class="controls">
                                            <textarea class="form-control"  name="room_short_description" cols="5" id="field-6"><?=$RowRoomData['room_short_description']?></textarea>
                                             <?=form_error('room_short_description', '<div class="error">', '</div>');?>
                                          </div>
                                        </div>
                                        <div class="clearfix"></div>
                                      </div>
                                      <div class="form-group">
                                        <div class="col-md-3">
                                          <label class="form-label" for="field-1">Room Long Description</label>
                                        </div>
                                        <div class="col-md-9">
                                          <div class="controls">
                                            <textarea class="form-control" name="room_long_description" cols="5" id="field-6"><?=$RowRoomData['room_long_description']?></textarea>
                                             <?=form_error('room_long_description', '<div class="error">', '</div>');?>
                                          </div>
                                        </div>
                                        <div class="clearfix"></div>
                                      </div>
                                      <div class="form-group">
                                        <div class="col-md-3">
                                          <label class="form-label" for="field-1">Room Main Image</label>
                                        </div>
                                        <div class="col-md-9">
                                          <div class="controls">
                                            <input type="file" name="room_main_image_file">
                                            <?=form_error('room_main_image_file', '<div class="error">', '</div>');?>
                                            <?php if(isset($mainImageError)){echo '<div class="error">'.$mainImageError.'</div>';}?>
                                          </div>
                                        </div>
                                        <div class="clearfix"></div>
                                      </div>
                                      <div class="form-group">
                                        <div class="col-md-3">
                                          <label class="form-label" for="field-1">Other Image</label>
                                           <?php if(isset($mainImageErrorOther)){echo '<div class="error">'.$mainImageErrorOther.'</div>';}?>
                                        </div>
                                        <div class="col-md-9">
                                          <div class="controls">
                                            <input type="file" name="other_image_file">
                                          </div>
                                        </div>
                                        <div class="clearfix"></div>
                                      </div>
                                      <div class="form-group">
                                        <div class="col-md-3">
                                          <label class="form-label" for="field-1">Status</label>
                                        </div>
                                        <div class="col-md-9">
                                          <div class="controls">
                                            <input type="radio" name="status" <?php if($RowRoomData['status']=='published'){echo 'checked';}?>  value="published" class="status">
                                            Published
                                            <input type="radio" name="status" <?php if($RowRoomData['status']=='awaiting'){echo 'checked';}?>    value="awaiting" class="status">
                                            Awaiting </div>
                                             <?=form_error('status', '<div class="error">', '</div>');?>

                                            <span style="color:#900;"> <?=$this->session->flashdata('messageRR');?></span>
                                        </div>
                                        <div class="clearfix"></div>
                                      </div>

                                      <div class="form-group startEndDate" style="display:<?php if($RowRoomData['status'] =='awaiting'){echo 'block';}else{echo 'none';};?>;">
                                        <div class="col-md-3">
                                          <label class="form-label" for="field-1">Start/End Date</label>


                                        </div>
                                        <div class="col-md-9">
                                          <div class="controls">

                                            <input name="start_end_dates" type="text" id="daterange-2" class="form-control daterange"
                                            	data-format="MM-DD-YYYY" data-start-date="<?php if($RowRoomData['start_date']){ echo date('m-d-Y',strtotime($RowRoomData['start_date']));}else{ echo date('m-d-Y');}?>"
                                              data-end-date="<?php if($RowRoomData['end_date']){ echo date('m-d-Y',strtotime($RowRoomData['end_date'])); }else{ echo date('m-d-Y', strtotime("+15 days")); };?>" data-separator=",">

                                             <?=form_error('start_end_dates', '<div class="error">', '</div>');?>
                                          </div>
                                        </div>
                                        <div class="clearfix"></div>
                                      </div>
                                    </div>
                                    <div class="pull-right">
                                      <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                  </form>


                </div>
            </div>
        </div>
    </div>
</div>




		<!-- Footer -->

		<!-- /footer -->

	  </div>

		<!-- Footer -->

		<!-- /footer -->

	  </div>
	  <!-- /main content -->

  </div>
  <!-- /main container -->

</div>
<!-- /page container -->

<!--Load JQuery-->
<?php $this->load->view('inc/footer'); ?>

<!--Float Charts-->
<script src="<?= base_url('assests'); ?>/js/plugins/flot/jquery.flot.min.js"></script>
<script src="<?= base_url('assests'); ?>/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="<?= base_url('assests'); ?>/js/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="<?= base_url('assests'); ?>/js/plugins/flot/jquery.flot.selection.min.js"></script>
<script src="<?= base_url('assests'); ?>/js/plugins/flot/jquery.flot.pie.min.js"></script>
<script src="<?= base_url('assests'); ?>/js/plugins/flot/jquery.flot.time.min.js"></script>
<script src="<?= base_url('assests'); ?>/js/functions.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" type="text/css"/>
</body>

</html>
