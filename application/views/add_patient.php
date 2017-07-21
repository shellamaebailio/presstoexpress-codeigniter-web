<?php 
require('require/header_side.php'); 
?>
      <section id="main-content">
          <section class="wrapper"> 		
				<div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             Add New Patient
                          </header>
                          <div class="panel-body">
                              <div class="form">
                                  <form class="form-validate form-horizontal " id="register_form" method="post" action="<?php echo site_url('patient_c/add_patientses') ?>">
								  <div style="margin-left:17%; color:red;"><span class="font"><?php echo validation_errors(); ?> </span></div>
                                      <div class="form-group">
                                          <label for="fullname" class="control-label col-lg-2">First Name</label>
                                          <div class="col-lg-6">
                                              <input class=" form-control" name="fname" type="text" required="require" />
                                          </div>
                                      </div>
									  <div class="form-group">
                                          <label for="fullname" class="control-label col-lg-2">Middle Name</label>
                                          <div class="col-lg-6">
                                              <input class=" form-control" name="mname" type="text" required="require" />
                                          </div>
                                      </div>
									  <div class="form-group">
                                          <label for="fullname" class="control-label col-lg-2">Last Name</label>
                                          <div class="col-lg-6">
                                              <input class=" form-control" name="lname" type="text" required="require"/>
                                          </div>
                                      </div>
                    <div class="form-group ">
                                          <label for="address" class="control-label col-lg-2">Address</label>
                                          <div class="col-lg-6">
                                              <input class=" form-control" id="address" name="address" type="text" required="require" />
                                          </div>
                                      </div>
									  <div class="form-group ">
                                          <label for="address" class="control-label col-lg-2">Gender</label>
                                          <div class="col-lg-6">
                                              <select class="form-control" name="gender" required="require">
                        											  <option></option>
                        												<option>Male</option>
                        												<option>Female</option>
                        											</select>
                                          </div>
                                      </div>
									  
									 <div class="form-group">
                                          <label class="control-label col-lg-2">Birthdate</label>
                                          <div class="col-lg-6">
                                              <input class="form-control "  name="bday" type="date" required="require"/>
                                          </div>
                                      </div>
                    <div class="form-group ">
                                          <label for="address" class="control-label col-lg-2">Room and Bed Number</label>
                                          <div class="col-lg-6">
                                          <select class="form-control" name="room_no" required="require">
                                                <option></option>
                                              <?php foreach($room as $r){ ?>
                                                    <?php if($r->patient_id==null && $r->deleted==0){ ?>
                                                <option value="<?php echo $r->id; ?>">
                                                  <?php echo "Bed ".$r->bed_no." "."of"." "."Room #"." ".$r->room_no; ?>
                                                </option>
                                                    <?php } elseif($r->patient_id!=null && $r->deleted==1){ ?>
                                                 <option value="<?php echo $r->id; ?>">
                                                  <?php echo "Bed ".$r->bed_no." "."of"." "."Room #"." ".$r->room_no; ?>
                                                </option>
                                                    <?php } ?>
                                              <?php }?>
                                              </select>
                                          </div>
                                    </div>
              
									  <div class="form-group ">
                                          <label for="address" class="control-label col-lg-2">Express Device</label>
                                          <div class="col-lg-6">
                                              <select class="form-control" name="device_id" required="require">
                                                <option></option>
                                              <?php foreach($device as $r){ ?>
                                                <?php if($r->patient_id==null && $r->deleted==0){ ?>
                        												<option value="<?php echo $r->device_id; ?>">
                        													<?php echo $r->name; ?>
                        												</option>
                                                <?php }elseif($r->patient_id!=null && $r->deleted==1) { ?>
                                                <option value="<?php echo $r->device_id; ?>">
                                                  <?php echo $r->name; ?>
                                                </option>
                                                  <?php }  ?>
                      												<?php }?>
                      											  </select>
                                          </div>
                                      </div>
									  
                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <button class="btn btn-primary" type="submit">Add</button>
                                              <a class="btn btn-default" href="<?php echo site_url('patient_c/view_all');?>" type="button">Cancel</a>
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