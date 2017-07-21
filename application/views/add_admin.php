<?php 
require('require/header_side.php'); 
?>
      <section id="main-content">
          <section class="wrapper"> 		
				<div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             Add new Admin
                          </header>
                          <div class="panel-body">
                              <div class="form">
                                  <form class="form-validate form-horizontal " id="register_form" method="post" action="<?php echo site_url('admin_c/add_admin_ac') ?>">
								  <div style="margin-left:17%; color:red;"><span class="font"><?php echo validation_errors(); ?> </span></div>
                                      <div class="form-group">
                                          <label for="fullname" class="control-label col-lg-2">First Name</label>
                                          <div class="col-lg-6">
                                              <input class=" form-control" name="fname" type="text" />
                                          </div>
                                      </div>
									  <div class="form-group">
                                          <label for="fullname" class="control-label col-lg-2">Middle Name</label>
                                          <div class="col-lg-6">
                                              <input class=" form-control" name="mname" type="text" />
                                          </div>
                                      </div>
									  <div class="form-group">
                                          <label for="fullname" class="control-label col-lg-2">Last Name</label>
                                          <div class="col-lg-6">
                                              <input class=" form-control" name="lname" type="text" />
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label for="address" class="control-label col-lg-2">Address</label>
                                          <div class="col-lg-6">
                                              <input class=" form-control" id="address" name="address" type="text" />
                                          </div>
                                      </div>
									  <div class="form-group ">
                                          <label for="address" class="control-label col-lg-2">Gender</label>
                                          <div class="col-lg-6">
                                              <select class="form-control" name="gender">
											  <option>
												</option>
												<option>
													Male
												</option>
												<option>
													Female
												</option>
											  </select>
                                          </div>
                                      </div>
									   <div class="form-group">
                                          <label for="email" class="control-label col-lg-2">Email</label>
                                          <div class="col-lg-6">
                                              <input class="form-control " id="email" name="email" type="email" />
                                          </div>
                                      </div>
									  <div class="form-group">
                                          <label for="email" class="control-label col-lg-2">Contact #</label>
                                          <div class="col-lg-6">
                                              <input class="form-control " name="contact#">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <button class="btn btn-primary" type="submit">Next</button>
                                              <a class="btn btn-default" href="<?php echo site_url('login/home');?>" type="button">Cancel</a>
                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </section>
                  </div>
              </div>
			</section>
		</section>
		
<?php 
require('require/footer.php'); 
?>			  