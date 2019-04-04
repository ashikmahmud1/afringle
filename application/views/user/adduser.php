<?php $this->load->view('inc/header'); ?>
<?php
$role = $this->session->userdata('is_logged_admin')['admin_role'];
if ($role != "Admin") {
  redirect("admin/dashboard");
} ?>
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
			<h1 class="page-title">Add User</h1>
      &nbsp;&nbsp; <?=$this->session->flashdata('message');?>


			<!-- Breadcrumb -->






<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">

            <div class="panel-body">
                <div class="row">
                    <form method="post" action="<?php echo base_url('user/add-user'); ?>" enctype="multipart/form-data">
                        <div class="col-md-12 col-sm-9 col-xs-10">
                          <div class="col-md-12">

                            <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">User Name</label>
                                  <div class="controls">
                                      <input type="text" class="form-control" name="username"  value="" />
                                        <?=form_error('username', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Email</label>
                                  <div class="controls">
                                      <input type="text" class="form-control" name="email"  value="" />
                                        <?=form_error('email', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Password</label>
                                  <div class="controls">
                                      <input type="password" class="form-control" name="password"  value="" />
                                        <?=form_error('password', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Confirm Password</label>
                                  <div class="controls">
                                      <input type="password" class="form-control" name="con_password"  value="" />
                                        <?=form_error('con_password', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Gender</label>
                                  <div class="controls">
                                    <select class="form-control" name="gender" >
          <option selected="" >Gender*
          </option><option>Male
          </option><option>Female
        </option></select>

                                        <?=form_error('gender', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Date of birth</label>
                                  <div class="controls">
                                      <input type="date" class="form-control" name="dob"  value="" />
                                        <?=form_error('dob', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>

                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Your Home town</label>
                                  <div class="controls">
                                    <select class="form-control" id="select_hometown" name="select_hometown">
                                        <option selected >Select home town</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>

                                        <?=form_error('profession', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>

                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Select Country</label>
                                  <div class="controls">
                                    <select class="form-control" id="select_country" name="select_country">
                                        <option selected >Select Country</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>

                                        <?=form_error('profession', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Select Tribe</label>
                                  <div class="controls">
                                    <select class="form-control" id="select_tribe" name="select_tribe">
                                        <option selected >Select Tribe</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>

                                        <?=form_error('profession', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>

                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Country</label>
                                  <div class="controls">
                                    <select class="form-control" id="countryCode" name="country"  onchange="contryChange()">
                                        <option selected >Select Country</option>
                                        <?php
                                        foreach($ListCountry['data'] as $country){ ?>
                                        <option value="<?php echo $country->sortname; ?>"><?php echo $country->name; ?></option>
                                      <?php } ?>

                                    </select>

                                        <?=form_error('country', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Tribe</label>
                                  <div class="controls">
								   <select class="form-control" id="tribe" name="tribe" >
                                        <option selected >Select Tribe</option>

                                    </select>
                                        <?=form_error('tribe', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Contact number</label>
                                  <div class="controls">
                                      <input type="text" class="form-control" name="contact"  value="" />
                                        <?=form_error('contact', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Postel code</label>
                                  <div class="controls">
                                      <input type="text" class="form-control" name="zip"  value="" />
                                        <?=form_error('zip', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">State</label>
                                  <div class="controls">
								  <select class="form-control" id="state" name="state" onchange="stateChange()" >
                                        <option selected >Select State</option>

                                    </select>

                                        <?=form_error('state', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">City</label>
                                  <div class="controls">
								   <select class="form-control" id="city" name="city" >
                                        <option selected >Select City</option>

                                    </select>
                                        <?=form_error('city', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Do you Want Children</label>
                                  <div class="controls">
                                    <select class="form-control" name="children">
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                    </select>
                                        <?=form_error('children', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Marital Status</label>
                                  <div class="controls">
                                    <select class="form-control" name="marital">
                                      <option value="Married">Married</option>
                                      <option value="UnMarried">UnMarried</option>
                                    </select>

                                        <?=form_error('marital', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Do you have children?	</label>
                                  <div class="controls">
                                    <select class="form-control" name="haveChildren">
                                      <option value="Yes">Yes</option>
                                      <option value="No">No</option>
                                      <option value="All my kids are over 18">All my kids are over 18</option>
                                    </select>
                                        <?=form_error('haveChildren', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>
                              <div class="col-md-6">

                              <div class="form-group">
                                  <label class="form-label" for="field-1">Height</label>
                                  <div class="controls">
                                      <input type="text" class="form-control" name="height"  value="" />
                                        <?=form_error('height', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Do you smoke?</label>
                                  <div class="controls">
                                    <select class="form-control" name="isSmoke">
                                      <option value="2">Yes</option>
                                      <option value="1">No</option>
                                      <option value="3">I only date smokers</option>
                                    </select>
                                        <?=form_error('isSmoke', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Do You Own A Car?</label>
                                  <div class="controls">
                                    <select class="form-control" name="isCar">
                                      <option value="Yes">Yes</option>
                                      <option value="No">No</option>
                                    </select>
                                        <?=form_error('isCar', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">I Am Looking For</label>
                                  <div class="controls">
                                    <select class="form-control" name="lookingFor">
                                      <option value="0">Select</option>
                                      <option value="1">Hang Out</option>
                                      <option value="2">Friends</option>
                                      <option value="3">Dating</option>
                                      <option value="4">Long Term</option>
                                    </select>
                                        <?=form_error('lookingFor', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Do you do drugs?	</label>
                                  <div class="controls">
                                    <select class="form-control" name="isDrugs">
                                      <option value="1">No</option>
                                      <option value="2">Socially</option>
                                      <option value="3">Often</option>

                                    </select>
                                        <?=form_error('isDrugs', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Do you drink?	</label>
                                  <div class="controls">
                                    <select class="form-control" name="isDrink">
                                      <option value="1">No</option>
                                      <option value="2">Socially</option>
                                      <option value="3">Often</option>

                                    </select>
                                        <?=form_error('isDrink', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Hair Color	</label>
                                  <div class="controls">


                                    <select class="form-control" name="isHair">
                                      <?php
                                      foreach ($ListOfHair as $list) { ?>
                                          <option value="<?php echo $list['id']; ?>"><?php echo $list['hair_color']; ?></option>
                                      <?php } ?>
                                    </select>
                                        <?=form_error('isHair', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Education</label>
                                  <div class="controls">
                                    <select class="form-control" name="education">
                                      <?php
                                      foreach ($ListOfEducation as $list) { ?>
                                          <option value="<?php echo $list['id']; ?>"><?php echo $list['name']; ?></option>
                                      <?php } ?>
                                    </select>
                                        <?=form_error('isHair', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Profession</label>
                                  <div class="controls">
                                    <select class="form-control" name="profession">
                                      <?php
                                      foreach ($ListOfProfession as $list) { ?>
                                      <option value="<?php echo $list['id']; ?>"><?php echo $list['name']; ?></option>
                                      <?php } ?>
                                    </select>
                                        <?=form_error('isHair', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Body Type	</label>
                                  <div class="controls">


                                    <select class="form-control" name="bodyType">
                                      <?php
                                      foreach ($ListOfbodytype as $list) { ?>
                                          <option value="<?php echo $list['id']; ?>"><?php echo $list['name']; ?></option>
                                      <?php } ?>


                                    </select>
                                        <?=form_error('isHair', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>

                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Eye color	</label>
                                  <div class="controls">
                                    <select class="form-control" name="eye">
                                      <?php
                                      foreach ($ListOfeye as $list) { ?>
                                          <option value="<?php echo $list['id']; ?>"><?php echo $list['name']; ?></option>
                                      <?php } ?>


                                    </select>
                                        <?=form_error('eye', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Do you have pets?	</label>
                                  <div class="controls">
                                    <select class="form-control" name="pets">
                                      <option value="1">Cat</option>
                                      <option value="2">Dog</option>
                                      <option value="3">Cat & Dog</option>
                                      <option value="4">Birds</option>
                                      <option value="5">Other</option>
                                    </select>
                                        <?=form_error('pets', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>

                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">How ambitious are you?</label>
                                  <div class="controls">
                                      <select name="ambitious" class="form-control">
                                          <option selected="" value="0">How ambitious are you?
                                          </option><option value="10">Not Ambitious</option>
                                          <option value="11">Somewhat Ambitious</option>
                                          <option value="12">Ambitious</option>
                                          <option value="13">Very Ambitious</option>
                                      </select>
                                        <?=form_error('ambitious', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Language</label>
                                  <div class="controls">

                                    <select name="language" class="form-control" >
										  <option value="1">Arabic</option>
                                          <option value="2">Chinese</option>
                                          <option value="3">Dutch</option>
                                          <option value="4">English</option>
                                          <option value="5">French</option>
                                          <option value="6">German</option>
                                          <option value="7">Hebrew</option>
                                          <option value="8">Hindi</option>
                                          <option value="9">Italian</option>
                                          <option value="10">Japanese</option>
                                          <option value="11">Norwegian</option>
                                          <option value="12">Portuguese</option>
                                          <option value="13">Russian</option>
                                          <option value="14">Spanish</option>
                                          <option value="15">Swedish</option>
                                          <option value="16">Tagalog</option>
                                          <option value="17">Urdu</option>
                                          <option value="18">Other</option>
                                  </select>

                                        <?=form_error('language', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>



                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Describe your personality in one word</label>
                                  <div class="controls">
                                    <select class="form-control" name="personality">
                                      <option value="30">Adventurer</option>
                                      <option value="31">Animal Lover</option>
                                      <option value="32">Artsy</option>
                                      <option value="33">Athletic</option>
                                      <option value="34">Beach Bum</option>
                                      <option value="35">Blogger</option>
                                      <option value="36">Blue Collar</option>
                                      <option value="37">Bookworm</option>
                                      <option value="38">Brogrammer</option>
                                      <option value="39">Chef</option>
                                      <option value="40">Class Clown</option>
                                      <option value="41">Club Kid</option>
                                      <option value="42">Coffee Snob</option>
                                      <option value="43">Comic Nerd</option>
                                      <option value="44">Crafty</option>
                                      <option value="45">Daredevil</option>
                                      <option value="46">Design Snob</option>
                                      <option value="47">Diva</option>
                                      <option value="48">Fashionista</option>
                                      <option value="49">Film/TV Junkie</option>
                                      <option value="50">Free Thinker</option>
                                      <option value="51">Foodie</option>
                                      <option value="52">Geek</option>
                                      <option value="53">Gamer</option>
                                      <option value="54">Hedonist</option>
                                      <option value="55">Hipster</option>
                                      <option value="56">Hippie</option>
                                      <option value="57">Homebody</option>
                                      <option value="58">Hopeless Romantic</option>
                                      <option value="59">Humanist</option>
                                      <option value="60">Intellectual</option>
                                      <option value="61">Maker</option>
                                      <option value="62">Music Snob</option>
                                      <option value="63">Night Owl</option>
                                      <option value="64">Nomad</option>
                                      <option value="65">Photographer</option>
                                      <option value="66">Player</option>
                                      <option value="67">Poet</option>
                                      <option value="68">Princess</option>
                                      <option value="69">Professional</option>
                                      <option value="70">Rockstar</option>
                                      <option value="71">Starving Artist</option>
                                      <option value="72">Straight Edge</option>
                                      <option value="73">Traveler</option>
                                      <option value="74">Techie</option>
                                      <option value="75">Treehugger</option>
                                      <option value="76">Sapiophile</option>
                                      <option value="77">Tattooed/Pierced</option>
                                      <option value="78">Vegetarian</option>
                                      <option value="79">Vegan</option>
                                      <option value="80">Yogi</option>
                                      <option value="81">Yuppy</option>


                                    </select>
                                        <?=form_error('personality', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">When it comes to dating what best describes your intent?</label>
                                  <div class="controls">
                                    <select name="your_intent" class="form-control">

                                      <option value="2">I want to date but nothing serious.</option>
                                      <option value="3">I want a relationship.</option>
                                      <option value="4">I am putting in serious effort to find someone.</option>
                                      <option value="5">I am serious and I want to find someone to marry.</option>
                                    </select>
                                <?=form_error('your_intent', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>

                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">What is the longest relationship you have been in?</label>
                                  <div class="controls">
                                            <select name="longest_relationship" class="form-control">
                                                <option value="0">Under 1 year</option>
                                                  <option value="1">Over 1 year</option>
                                                  <option value="2">Over 2 years</option>
                                                  <option value="3">Over 3 years</option>
                                                  <option value="4">Over 4 years</option>
                                                  <option value="5">Over 5 years</option>
                                                  <option value="6">Over 6 years</option>
                                                  <option value="7">Over 7 years</option>
                                                  <option value="8">Over 8 years</option>
                                                  <option value="9">Over 9 years</option>
                                                  <option value="10">Over 10 years</option>

                                            </select>

                                <?=form_error('longest_relationship', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>


                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Frist Name:</label>
                                  <div class="controls">
                                      <input type="text" class="form-control" name="first_name"  value="" />
                                        <?=form_error('	first_name', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Last Name</label>
                                  <div class="controls">
                                      <input type="text" class="form-control" name="last_name"  value="" />
                                        <?=form_error('last_name', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">What is the longest relationship you have been in?</label>
                                  <div class="controls">
                                    <select name="show_publically" class="form-control">
                                        <option value="0">what do you want to show publically ?
                                        </option><option value="1">User Name</option>
                                        <option value="2">Full Name</option>
                                    </select>

                                <?=form_error('show_publically', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Income - We use income and birth order behind the scenes for matching.</label>
                                  <div class="controls">
                                              <select name="income" class="form-control">
                                                <option value="1">Less Than 25,000</option>
                                                  <option value="2">25,001 to 35,000</option>
                                                  <option value="3">35,001 to 50,000</option>
                                                  <option value="4">50,001 to 75,000</option>
                                                  <option value="5">75,001 to 100,000</option>
                                                  <option value="6">100,001 to 150,000</option>
                                                  <option value="7">150,000+</option>
                                            </select>


                                <?=form_error('income', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Would you date someone who has kids?</label>
                                  <div class="controls">
                                            <select name="isKids" class="form-control">
                                              <option value="0">Select</option>
                                              <option value="1">No</option>
                                              <option value="2">Yes</option>
                                              <option value="3">I only date single parents</option>
                                              </select>

                                <?=form_error('isKids', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Would you date someone that has BBW or a few extra pounds selected as a body type?</label>
                                  <div class="controls">
                                        <select name="isBodyType" class="form-control">
                                        <option value="0">Select</option>
                                        <option value="2">Yes</option>
                                        <option value="1">No</option>
                                        <option value="3">I only date a few extra pounds or BBW</option>
                                        </select>

                                <?=form_error('isBodyType', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>

                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Heading</label>
                                  <div class="controls">
                                      <input type="text" class="form-control" name="headline"  value="" />
                                        <?=form_error('headline', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Description</label>
                                  <div class="controls">
                                      <input type="text" class="form-control" name="description"  value="" />
                                        <?=form_error('description', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Interests</label>
                                  <div class="controls">
                                      <input type="text" class="form-control" name="interests"  value="" />
                                        <?=form_error('interests', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Seeking</label>
                                  <div class="controls">
                                    <select name="seeking" class="form-control">
                                    <option value="0">Select seeking</option>
                                    <option value="Women">Women</option>
                                    <option value="Man">Man</option>
                                    </select>
                                    <?=form_error('seeking', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Image</label>
                                  <div class="controls">
                                      <input type="file" class="form-control" name="imageData"  value="" />
                                        <?=form_error('imageData', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="field-1">Upload Pay Slip</label>
                                  <div class="controls">
                                      <input type="file" class="form-control" name="documents"  value="" />
                                        <?=form_error('documents', '<div class="error">', '</div>');?>
                                  </div>
                              </div>
                              </div>




                          </div>



                           <div class="pull-right">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
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
<script src="<?= base_url('assets'); ?>/js/plugins/flot/jquery.flot.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/plugins/flot/jquery.flot.selection.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/plugins/flot/jquery.flot.pie.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/plugins/flot/jquery.flot.time.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/functions.js"></script>

<script>
  function contryChange(){
	  var  country_code = $('#countryCode').val();
	  var  state_id = $('#state').val();

	$.ajax({
	  dataType : "json",
	  type : "get",
	  url: "<?php echo site_url('AppController/tribePicker'); ?>?country_code="+country_code,
	success:function(data)
	{
		$.ajax({
			  dataType : "json",
			  type : "get",
			  url: "<?php echo site_url('AppController/statePicker'); ?>?country_code="+country_code,
			success:function(data)
			{
				if(data.status == 1){
				  let tribeList = data.data;
				  $('#state').children('option:not(:first)').remove();
				  $.each(tribeList, function (i, item) {

					$('#state').append($('<option>', {
						value: item.id,
						text : item.name
					}));
				});

				}else{
					alert(data.message);
				}
			}

			});

		if(data.status == 1){
		  let tribeList = data.data;
		  $('#tribe').children('option:not(:first)').remove();
		  $.each(tribeList, function (i, item) {

			$('#tribe').append($('<option>', {
				value: item.id,
				text : item.name
			}));
		});

		}else{
			alert(data.message);
		}
	}

    });



}

function stateChange(){
	  var  state_id = $('#state').val();

	$.ajax({
	  dataType : "json",
	  type : "get",
	  url: "<?php echo site_url('AppController/cityPicker'); ?>?state_id="+state_id,
	success:function(data)
	{
		if(data.status == 1){
		  let stateList = data.data;
		  $('#city').children('option:not(:first)').remove();
		  $.each(stateList, function (i, item) {

			$('#city').append($('<option>', {
				value: item.id,
				text : item.name
			}));
		});

		}else{
			alert(data.message);
		}
	}

    });
}

</script>

</body>

</html>
