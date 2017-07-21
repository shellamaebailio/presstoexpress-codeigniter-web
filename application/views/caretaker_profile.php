<?php 
require('require/header_side.php'); 
?>
<section id="main-content">
          <section class="wrapper">
		  <div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-user-md"></i> Profile</h3>
				</div>
			</div>

       <?php    
        function ftime($time,$f) {
        if (gettype($time)=='string') 
            $time = strtotime($time);  
                              
            return ($f==24) ? date("G:i:s", $time) : date("g:i a", $time);  
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
            return $min." min";
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
                              <h3>Caretaker</h3>
                            </div>
                            <div class="col-lg-4 col-sm-4 follow-info">
                                <p class="capitalize"><?php echo "$fname $mname $lname" ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
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
                              </ul>
                          </header>
                          <div class="panel-body">
                              <div class="tab-content">
                                  <div id="recent-activity" class="tab-pane active">
                                        &nbsp; &nbsp;
                                        <div class="btn-group" style="float:right;">
                                        <a class="btn btn-danger btn-xs" href="<?php echo site_url('caretaker_pdf_c/create_pdf/'.$id); ?>"><i class="fa fa-file-pdf-o "></i> Convert to pdf</a>
                                        </div>
                                       <form autocomplete="on" class="navbar-form" style="float:left;" method="POST" action="<?php echo site_url('caretaker_c/profile/'.$id)?>">
                                            <input style="width:38%;"  class="form-control input-sm" placeholder="Search" value="<?php echo $from; ?>" name="from" type="date"> 
                                            <input style="width:38%;"  class="form-control input-sm" placeholder="Search" value="<?php echo $to; ?>" name="to" type="date">
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

                                      <br><br>

                                      <div class="profile-activity">
                                      <?php if($trans == null){ ?>
                                          <tr>
                                          <br>
                                            <th> &nbsp; &nbsp;  &nbsp; &nbsp;NO TRANSACTION FOUND !</th>
                                          </tr>
                                      <?php }else{ foreach($trans as $t){ ?>   
                                      <?php 

                                                       $time_attended = ftime($t->time_attended,24);
                                                        $time_requested = ftime($t->time,24);
                                                        $time_finished = ftime($t->time_finished,24);

                                                        list($raiat_hr,$raiat_min,$raiat_sec) = explode(':',$time_attended);
                                                        list($rair_hr,$rair_min,$rair_sec) = explode(':',$time_requested);
                                                        list($tf_hr,$tf_min,$tf_sec) = explode(':',$time_finished);

                                                        $request_attend_interval = get_interval($raiat_hr,$raiat_min,$raiat_sec,$raiat_hr,$rair_min,$rair_sec);
                                                        $attend_finish_interval = get_interval($tf_hr,$tf_min,$tf_sec,$raiat_hr,$raiat_min,$raiat_sec);


                                       ?>                                     
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
                                                      }     ?>
                                                       <p class="attribution capitalize">PATIENT: <a href="<?php echo site_url('patient_c/profileses/'.$t->patient_id) ?>"><?php echo "$t->fname $t->mname $t->lname"; ?>
                                                       </a> 
                                                      <p class="attribution capitalize"><strong>Requested time and date :</strong> <?php echo ftime($t->time,24); ?>, <?php echo $t->date; ?></p>
                                                      <p class="attribution capitalize"><strong>time attended :</strong> <?php echo ftime($t->time_attended,24) ?></p>                                                      
                                                      <p class="attribution capitalize"><strong>time finished :</strong> <?php echo ftime($t->time_finished,24) ?></p>                                                      
                                                      <p class="attribution capitalize"><strong>requested - attended interval :</strong> <?php echo $request_attend_interval; ?></p>                                                                                                            
                                                      <p class="attribution capitalize"><strong>attended - finished interval :</strong> <?php echo $attend_finish_interval; ?></p>
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
                                          <div class="row capitalize">
                                              <div class="bio-row ">
                                                  <p><span>First Name </span>: <?php echo $fname; ?> </p>
                                              </div>
                                              <div class="bio-row">
                                                  <p><span>Occupation </span>: <?php echo $staff_type; ?></p>
                                              </div>
                                              <div class="bio-row">
                                                  <p><span>Middle Name </span>: <?php echo $mname; ?></p>
                                              </div>
                                              <div class="bio-row">
                                                  <p><span>Email </span>: <?php echo $email; ?></p>
                                              </div>
                                              <div class="bio-row">
                                                  <p><span>Last Name </span>: <?php echo $lname; ?></p>
                                              </div>
                                              <div class="bio-row">
                                                  <p><span>Gender </span>: <?php echo $gender; ?></p>
                                              </div>
                                              <div class="bio-row">
                                                  <p><span>Mobile </span>: <?php echo $contact; ?></p>
                                              </div>
                                              <div class="bio-row">
                                                  <p><span>Address</span>: <?php echo $address; ?></p>
                                              </div>
                                          </div>
                                      </div>
                                    </section>
                                      <section>
                                          <div class="row">                                              
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