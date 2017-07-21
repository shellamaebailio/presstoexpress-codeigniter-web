<?php
require('require/header_side.php');
?>
<section id="main-content">
          <section class="wrapper">
		  <div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-user-md"></i> Profile </h3>
        </div>
			</div>

     <?php
        function ftime($time,$f) {
        if (gettype($time)=='string')
            $time = strtotime($time);

            return ($f==24) ? date("G:i:s", $time) : date("g:i:s a", $time);
        }
         function get_interval($ghr,$gmin,$gsec,$lhr,$lmin,$lsec){
          $sec = $gsec-$lsec;
          if($sec<0){
            $gmin-=1;
            $gsec+=60;
            $sec = $gsec-$lsec;
          }
          $min = $gmin-$lmin;
          if($min<0){
            $ghr-=1;
            $gmin+=60;
            $min = $gmin-$lmin;
          }
          $hr = $ghr-$lhr;

          if($hr>0&&$min>0&&$sec>0){      //1 1 1
            return $hr." hr, ".$min." min & ".$sec." sec";
          }elseif($hr>0&&$min>0&&sec<=0){   //1 1 0
            return $hr." hr &".$min." min ";
          }elseif($hr>0&&$min<=0&&$sec>0){   //1 0 1
            return $hr." hr &".$sec." sec";
          }elseif($hr>0&&$min<=0&&$sec<=0){ //1 0 0
            return $hr." hr";
          }elseif($hr<=0&&$min>0&&$sec>0){   //0 1 1
            return $min." min & ".$sec." sec";
          }elseif($hr<=0&&$min>0&&$sec<=0){   //0 1 0
            return $min." min ";
          }elseif($hr<=0&&$min<=0&&$sec>0){   //0 0 1
            return $sec." sec";
          }elseif($hr<=0&&$min<=0&&$sec<=0){   //0 0 0

          }
        } 

      ?>


              <div class="row">
                <!-- profile-widget -->
                <div class="col-lg-12">
                    <div class="profile-widget profile-widget-info">
                          <div class="panel-body">
                            <div class="col-lg-2 col-sm-2">
                              <h3>Patient</h3>
                            </div>
                            <div class="col-lg-4 col-sm-4 follow-info">
                                <p class="capitalize"><?php echo "$fname $mname $lname" ?></p>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								                <p></p>
                                <p></p>
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
                                  <li class="active">
                                      <a data-toggle="tab" href="#recent-activity">
                                          <i class="icon-home"></i>
                                          Transactions
                                      </a>

                                  </li>
                                  <li>
                                      <a data-toggle="tab" href="#profile">
                                          <i class="icon-user"></i>
                                          Profile
                                      </a>
                                  </li>
                                  <li class="">
                                      <a data-toggle="tab" href="#edit-profile">
                                          <i class="icon-envelope"></i>
                                          Edit Profile
                                      </a>
                                  </li>

                              </ul>
                          </header>
                          <div class="panel-body">
                              <div class="tab-content">
                                  <div id="recent-activity" class="tab-pane active">
                                        &nbsp; &nbsp;
                                    <div class="btn-group" style="float:right;">
                                    <a class="btn btn-danger btn-xs" href="<?php echo site_url('patient_pdf_c/create_pdf/'.$id); ?>"><i class="fa fa-file-pdf-o "></i> Convert to pdf</a>
                                    </div>
                                      <form autocomplete="on" class="navbar-form" style="float:left;" method="POST" action="<?php echo site_url('patient_c/profileses/'.$id)?>">
                                            <input style="width:38%;" class="form-control input-sm" placeholder="Search" value="<?php echo $from; ?>" name="from" type="date">
                                            <input style="width:38%;" class="form-control input-sm" placeholder="Search" value="<?php echo $to; ?>" name="to" type="date">
                                            <button class="btn btn-success btn-sm" type="submit">Search</button>
                                      </form>
                                      <center>
                                      <div style="width:63%;">
                                        <br><br>
                                        <table class="table table-striped">
                                          <tbody>
                                            <tr class="success">
                                              <td><button style="width:120px;" class="btn btn-danger btn-xs"><?php  echo"<span style=\" font-size:20px; font-weight:bold;\">".$emergency."</span>"; ?> &nbsp;&nbsp; Emergency</button></td>
                                            
                                              <td><button style="width:120px;" class="btn btn-warning btn-xs"><?php  echo"<span style=\" font-size:20px; font-weight:bold;\">".$cr."</span>"; ?> &nbsp;&nbsp;Restroom</button></td>
                                             
                                              <td><button style="width:120px;" class="btn btn-primary btn-xs"><?php  echo"<span style=\" font-size:20px; font-weight:bold;\">".$water."</span>"; ?> &nbsp;&nbsp;Water</button></td>
                                             
                                              <td><button style="width:120px;" class="btn btn-info btn-xs"><?php  echo"<span style=\" font-size:20px; font-weight:bold;\">".$clothes."</span>"; ?> &nbsp;&nbsp;Clothes</button></td>
                                              
                                              <td><button style="width:120px;" class="btn btn-success btn-xs"><?php  echo"<span style=\" font-size:20px; font-weight:bold;\">".$massage."</span>"; ?> &nbsp;&nbsp;Massage</button></td>
                                              
                                            </tr>
                                          </tbody>
                                        </table>
                                       </div> 
                                     </center>
                                      <br>
                                      <br>
                                      <div class="profile-activity">
                                      <?php if($tran == null){ ?>
                                          <tr>
                                          <br>
                                            <th>NO TRANSACTION FOUND!</th>
                                          </tr>
                                          <?php }else{ foreach($tran as $t){ ?>
                                          <div class="act-time">
                                              <div class="activity-body act-in">
                                                  <span class="arrow"></span>
                                                  <div class="text">
                                                      
                                                      <?php if($t->need=="emergency"){
                                                        echo "<p style=\"text-transform: uppercase; color: #ff2d55; font-weight:bold;\">".$t->need."</p>";
                                                      }elseif ($t->need=="cr") {
                                                        echo "<p style=\"text-transform: uppercase; font-weight:bold; color:#ffcc00;\">restroom</p> ";
                                                      }elseif ($t->need=="water") {
                                                        echo "<p style=\"text-transform: uppercase; font-weight:bold; color:#007aff;\">".$t->need."</p>";
                                                      }elseif ($t->need=="clothes") {
                                                        echo "<p style=\"text-transform: uppercase; font-weight:bold; color:#34aadc;\">".$t->need."</p>";
                                                      }elseif ($t->need=="massage") {
                                                        echo "<p style=\"text-transform: uppercase; font-weight:bold; color:#4cd964;\">".$t->need."</p>";
                                                      }   
                                                        $time_attended = ftime($t->time_attended,24);
                                                        $time_requested = ftime($t->time,24);
                                                        $time_finished = ftime($t->time_finished,24);

                                                        list($raiat_hr,$raiat_min,$raiat_sec) = explode(':',$time_attended);
                                                        list($rair_hr,$rair_min,$rair_sec) = explode(':',$time_requested);
                                                        list($tf_hr,$tf_min,$tf_sec) = explode(':',$time_finished);

                                                        $request_attend_interval = get_interval($raiat_hr,$raiat_min,$raiat_sec,$raiat_hr,$rair_min,$rair_sec);
                                                        $attend_finish_interval = get_interval($tf_hr,$tf_min,$tf_sec,$raiat_hr,$raiat_min,$raiat_sec);

                                                      ?>

                                                      <p class="attribution capitalize">ATTENDED BY: <a href="<?php echo site_url('caretaker_c/profile/'.$t->staff_id); ?>">
                                                        <?php echo "$t->fname $t->mname $t->lname"; ?>
                                                      </a> 
                                                        
                                                      </p>
                                                      <p class="attribution capitalize"><strong>Requested time and date :</strong><?php echo ftime($t->time,24); ?> , <?php echo $t->date; ?></p>
                                                      <p class="attribution capitalize"><strong>Time Attended :</strong><?php echo ftime($t->time_attended,24) ?></p>
                                                      <p class="attribution capitalize"><strong>Time Finished :</strong><?php echo ftime($t->time_finished,24) ?></p>
                                                      <p class="attribution capitalize"><strong>Requested Attended Interval :</strong><?php echo $request_attend_interval; ?></p>
                                                      <p class="attribution capitalize"><strong>Attended Finished Interval :</strong><?php echo $attend_finish_interval; ?></p>
                                                      <p class="attribution capitalize"><strong>Details :</strong> <?php echo $t->details; ?></p>
                                                  </div>
                                              </div>
                                          </div>
                                          <?php }} ?>
                                      </div>
                                  </div>
                                  <!-- profile -->
                                  <div id="profile" class="tab-pane">
                                    <section class="panel">
                                      <div class="panel-body bio-graph-info">
                                          <h1>Bio Graph</h1>
                                          <div class="row">
                                              <div class="bio-row">
                                                  <p><span>First Name </span>: <?php echo $fname; ?> </p>
                                              </div>
                                              <div class="bio-row">
                                                  <p><span>Gender </span>: <?php echo $gender; ?></p>
                                              </div>
                                              <div class="bio-row">
                                                  <p><span>Middle Name </span>: <?php echo $mname; ?></p>
                                              </div>
                                              <div class="bio-row">
                                                  <p><span>Age
                                                      </span>: <?php echo $age; ?></p>
                                              </div>
                                              <div class="bio-row">
                                                  <p><span>Lastname </span>: <?php echo $lname; ?></p>
                                              </div>
                                              <div class="bio-row">
                                                  <p><span>Address </span>: <?php echo $address; ?></p>
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
                                  <div id="edit-profile" class="tab-pane">
                                    <section class="panel">
                                          <div class="panel-body bio-graph-info">
                                              <h1> Profile Info</h1>
                                              <form class="form-horizontal" role="form" method="POST" action="<?php echo site_url('patient_c/up_patient/'.$id); ?>" autocomplete="on">
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">First Name</label>
                                                      <div class="col-lg-6">
                                                          <input type="text" class="form-control" name="fname" value="<?php echo $fname; ?>" placeholder="<?php echo $fname; ?>">
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Middle Name</label>
                                                      <div class="col-lg-6">
                                                          <input type="text" class="form-control" name="mname" value="<?php echo $mname; ?>" placeholder=" ">
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Last Name</label>
                                                      <div class="col-lg-6">
                                                          <input type="text" class="form-control" name="lname" value="<?php echo $lname; ?>" placeholder=" ">
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Gender</label>
                                                      <div class="col-lg-6">
                                                          <select class="form-control" id="gen" name="gender">
                                                            <option></option>
                                                            <option value="Male" <?php if ($gender == 'Male') echo 'selected = "selected"'; ?> >Male</option>
                                                            <option value="Female" <?php if ($gender == 'Female') echo 'selected = "selected"'; ?>>Female</option>
                                                          </select>
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Birthdate</label>
                                                      <div class="col-lg-6">
                                                          <input type="date" class="form-control" name="bday" placeholder="" value="<?php echo $bday;  ?>">
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Address</label>
                                                      <div class="col-lg-6">
                                                          <input type="text" class="form-control" name="address" value="<?php echo $address; ?>" placeholder=" ">
                                                      </div>
                                                  </div>
                                                  <div class="form-group ">
                                                        <label for="address" class="control-label col-lg-2">Room and Bed Number</label>
                                                        <div class="col-lg-6">
                                                        <select class="form-control" name="room_no">
                                                              <?php foreach($dev_bed as $key){ ?>
                                                              <option value="<?php echo $key->id; ?>"><?php echo "bed ".$key->bed_no." room ".$key->room_no; ?></option>
                                                              <?php }?>

                                                              <?php foreach ($room as $key) {?>
                                                              <option value="<?php echo $key->id; ?>"><?php echo "bed ".$key->bed_no." room ".$key->room_no; ?></option>
                                                              <?php }?>
                                                            </select>
                                                        </div>
                                                  </div>

                                                  <div class="form-group">
                                                      <label class="col-lg-2 control-label">Device</label>
                                                      <div class="col-lg-6">
                                                        <!-- value="<?php echo "($device_id) $dev_name"; ?>" -->
                                                          <select class="form-control" name="device_id">
                                                            <?php foreach ($all_device as $k) { //current device
                                                              if($device_id==$k->device_id){ ?>
                                                                <option value="<?php echo $k->device_id;?>"><?php echo $k->name; ?></option>
                                                            <?php } }?>
                                                            <?php foreach ($device as $k) { //all not used device
                                                              ?> 
                                                                <option value="<?php echo $k->device_id; ?>"><?php echo $k->name; ?></option>
                                                            <?php } ?>
                                                          </select>

                                                      </div>
                                                  </div>

                                                  <div class="form-group">
                                                      <div class="col-lg-offset-2 col-lg-10">

                                                          <button type="submit" class="btn btn-primary">Update</button>
                                                          <a class="btn btn-danger" href="<?php echo site_url('patient_c/profileses/'.$id);?>" type="button">Cancel</a>
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