<?php 
require('require/header_side.php'); 
?>
<section id="main-content">
          <section class="wrapper">
		  <div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-user-md"></i> MY Profile</h3>
				</div>
			</div>
              <div class="row">
                <!-- profile-widget -->
                <div class="col-lg-12">
                    <div class="profile-widget profile-widget-info">
                          <div class="panel-body">
                            <div class="col-lg-2 col-sm-2">
                            </br>
                              <h4><?php echo $_SESSION['fname']." ".$_SESSION['mname']." ".$_SESSION['lname']; ?></h4>               
                              
                              <h6>Admin</h6>
                            </div>
                            <div class="col-lg-4 col-sm-4 follow-info">
                                <p>Email: <?php echo $_SESSION['email']; ?></p>
								<p>Username: <?php echo $_SESSION['username']; ?></p>
                                <h6>
                                    <span><i class="icon_clock_alt"></i><?php echo date('H:i'); ?></span>
                                    <span><i class="icon_calendar"></i><?php echo date('m.d.Y'); ?></span>
                                    <span><i class="icon_pin_alt"></i>St. Joseph</span>
                                </h6>
                            </div>
                           
                          </div>
                    </div>
                </div>
              </div>
              <!-- page start-->
              <div class="row">
                 <div class="col-lg-12">
                    <section class="panel">
                          <header class="panel-heading tab-bg-info">
                              <ul class="nav nav-tabs">
                                  <li class="<?php if($tab==""){?>active<?php } ?>">
                                      <a data-toggle="tab" href="#profile">
                                          <i class="icon-user"></i>
                                          Profile
                                      </a>
                                  </li>
                                  <li class="<?php if($tab=="pro"){?>active<?php }  ?>">
                                      <a data-toggle="tab" href="#edit-profile">
                                          <i class="icon-envelope"></i>
                                          Edit Profile
                                      </a>
                                  </li>
								  <li class="<?php if($tab=="pass"){?>active<?php }  ?>">
                                      <a data-toggle="tab" href="#password">
                                          <i class="icon-envelope"></i>
                                          Edit Password
                                      </a>
                                  </li>
                              </ul>
                          </header>
                          <div class="panel-body">
                              <div class="tab-content">
                                  <!-- profile -->
                                  <div id="profile" class="tab-pane <?php if($tab==""){?>active<?php } ?>">
                                    <section class="panel">
                                      
                                      <div class="panel-body bio-graph-info">
                                          <h1>Bio Graph</h1>
                                          <div class="row " style="text-transform: capitalize;">
											   
                                              <div class="bio-row">
                                                  <p><span>First Name </span>: <?php echo $_SESSION['fname']; ?></p>
                                              </div>
											  <div class="bio-row">
                                                  <p><span>UserName </span>: <?php echo $_SESSION['username']; ?></p>
                                              </div> 											  
											  <div class="bio-row">
                                                  <p> <span>Middle Name </span>: <?php echo $_SESSION['mname']; ?></p>
                                              </div>    
                                              <div class="bio-row">
                                                  <p><span>Mobile </span>: <?php echo $_SESSION['contact_no']; ?></p>
                                              </div>
											  <div class="bio-row">
                                                  <p><span>Last Name </span>: <?php echo $_SESSION['lname']; ?></p>
                                              </div> 
                                              <div class="bio-row">
                                                  <p><span>Email </span>: <?php echo $_SESSION['email']; ?></p>
                                              </div>
											  <div class="bio-row">
                                                  <p ><span>Gender</span>: <?php echo $_SESSION['gender']; ?></p>
                                              </div>
                                          </div>
                                      </div>
                                    </section>
                                      <section>
                                          <div class="row">                                              
                                          </div>
                                      </section>
                                  </div>
								  
								  
								  
								  
                                  <!-- edit-profile -->
                                  <div id="edit-profile" class="tab-pane <?php if($tab=="pro"){?>active<?php }  ?>">
                                    <section class="panel">                                          
                                          <div class="panel-body bio-graph-info">
                                              <h1> Profile Info</h1>
                                              <form class="form-horizontal" role="form" method="post" action="<?php echo site_url('account_c/edit_bio'); ?>">                                                  
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">First Name</label>
                                                      <div class="col-lg-6">
                                                          <input type="text" class="form-control" name="fname" placeholder=" " value="<?php echo $_SESSION['fname']; ?>">
                                                      </div>
                                                  </div>
												  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Middle Name</label>
                                                      <div class="col-lg-6">
                                                          <input value="<?php echo $_SESSION['mname']; ?>" type="text" class="form-control" name="mname" placeholder=" ">
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Last Name</label>
                                                      <div class="col-lg-6">
                                                          <input value="<?php echo $_SESSION['lname']; ?>" type="text" class="form-control" name="lname" placeholder=" ">
                                                      </div>
                                                  </div>
												  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Username</label>
                                                      <div class="col-lg-6">
                                                          <input value="<?php echo $_SESSION['username']; ?>" type="text" class="form-control" name="username" placeholder=" ">
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Gender</label>
                                                      <div class="col-lg-6">
                                                          <select  class="form-control" name="gender">
															<option></option>
															<option <?php if($_SESSION['gender']=="male"){?>selected="true" <?php } ?> >male</option>
															<option <?php if($_SESSION['gender']=="female"){?>selected="true" <?php } ?> >female</option>
														  </select>
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Email</label>
                                                      <div class="col-lg-6">
                                                          <input value="<?php echo $_SESSION['email']; ?>" type="text" class="form-control" name="email" placeholder=" ">
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Contact No</label>
                                                      <div class="col-lg-6">
                                                          <input value="<?php echo $_SESSION['contact_no']; ?>" type="text" class="form-control" name="contact_no" placeholder=" ">
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <div class="col-lg-offset-2 col-lg-10">
                                                          <button type="submit" class="btn btn-primary">Save</button>
                                                      </div>
                                                  </div>
                                              </form>
                                          </div>
                                      </section>
                                  </div>
								  
								  
								  
								  
								  <div id="password" class="tab-pane <?php if($tab=="pass"){?>active<?php }?>">
                                    <section class="panel">                                          
                                          <div class="panel-body bio-graph-info">
                                              <h1> Profile Info</h1>
                                              <form class="form-horizontal" role="form" method="post" action="<?php echo site_url('account_c/edit_pass'); ?>">    
											  <div style="margin-left:17%;"><i style="color: red; " class="font"><?php echo validation_errors(); ?></i></div>                                              
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">New Password</label>
                                                      <div class="col-lg-6">
                                                          <input type="password" class="form-control" name="pass" placeholder=" ">
                                                      </div>
                                                  </div>
												  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Confirm New Password</label>
                                                      <div class="col-lg-6">
                                                          <input type="password" class="form-control" name="pass_c" placeholder="">
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <div class="col-lg-offset-2 col-lg-10">
                                                          <button type="submit" class="btn btn-primary">Save</button>
                                                      </div>
                                                  </div>
                                              </form>
                                          </div>
                                      </section>
                                  </div>
								  
								  
								  
                              </div>
                          </div>
                      </section>
                 </div>
              </div>

              <!-- page end-->
          </section>
      </section>
<?php 
require('require/footer.php'); 
?>