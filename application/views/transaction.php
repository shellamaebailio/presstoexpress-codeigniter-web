<?php 
require('require/header_side.php'); 

?>
<!-- <head>
  <meta http-equiv="refresh" content="0.5">
</head> -->
    
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
            return $hr." hr ,".$min." min & ".$sec." sec";
          }elseif($hr>0&&$min>0&&sec<=0){   //1 1 0
            return $hr." hr &".$min." min ";
          }elseif($hr>0&&$min<=0&&$sec>0){   //1 0 1
            return $hr." hr &".$sec." sec";
          }elseif($hr>0&&$min<=0&&$sec<=0){ //1 0 0
            return $hr." hr &";
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
      <section id="main-content">
          <section class="wrapper">            
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Transaction Table
                              <a id="pdf" style="float:right;" class="btn btn-danger btn-xs" href="<?php echo site_url('c_test/create_pdf/'); ?>"><i class="fa fa-file-pdf-o "></i> Convert to PDF</a>
                          </header>
                          <form autocomplete="on" class="navbar-form" style="float:left; padding: 0 4px 0 4px ;" method="POST" action="<?php echo site_url('transaction_c/view_transactions')?>">
                                            <input style="width:38%;" class="form-control input-sm" name="from" value="<?php echo $froms; ?>" type="date"> - 
                                             <input style="width:38%;" class="form-control input-sm" name="to" value="<?php echo $to; ?>" type="date">
                                            <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-search "></i> search</button>
                            </form>
                          <table class="table table-striped table-advance table-hover">
                           <tbody>
                            <?php if($tran == null){ ?>
                              <tr>
                                <th>NO TRANSACTION FOUND!</th>
                              </tr>

                            <?php }else{ ?>
                              <tr>
                                 <th><i class="icon_profile"></i> Patient Full Name</th>
                                 <th><i class="fa fa-comments-o"></i> Need</th>
                                 <th><i class="fa fa-calendar"> </i> Date</th>
                                 <th><i class="icon_profile"></i> Caretaker Name</th>
                                 <th><i class="fa fa-comments-o"></i> Details</th>
                                 <th><i class="fa fa-clock-o"></i> Time Requested</th>
                                 <th><i class="fa fa-clock-o"></i> Time Attended</th>
                                 <th><i class="fa fa-clock-o"></i> Time Finished</th>
                                  <th><i class="fa fa-clock-o"></i> Requested-Attended Interval</th>
                                  <th><i class="fa fa-clock-o"></i> Attended-finished Interval</th>
                              </tr>
                              <tr>
                                 <?php 
									         foreach($tran as $d){
                            $time_attended = ftime($d->time_attended,24);
                            $time_requested = ftime($d->time,24);
                            $time_finished = ftime($d->time_finished,24);

                            list($raiat_hr,$raiat_min,$raiat_sec) = explode(':',$time_attended);
                            list($rair_hr,$rair_min,$rair_sec) = explode(':',$time_requested);
                            list($tf_hr,$tf_min,$tf_sec) = explode(':',$time_finished);

                            $request_attend_interval = get_interval($raiat_hr,$raiat_min,$raiat_sec,$raiat_hr,$rair_min,$rair_sec);
                            $attend_finish_interval = get_interval($tf_hr,$tf_min,$tf_sec,$raiat_hr,$raiat_min,$raiat_sec);

                            

											echo "<td style=\"text-transform: capitalize;\">".$d->fname." ".$d->mname." ".$d->lname."</td>";
											echo "<td style=\"text-transform: capitalize;\">".$d->need."</td>";
											echo "<td style=\"text-transform: capitalize;\">".$d->date."</td>";
											echo "<td style=\"text-transform: capitalize;\">".$d->s_fname." ".$d->s_mname." ".$d->s_lname."</td>";
											echo "<td style=\"text-transform: capitalize;\">".$d->details."</td>";
                      echo "<td style=\"text-transform: capitalize;\">".ftime($d->time,24)."</td>";
                      echo "<td style=\"text-transform: capitalize;\">&nbsp;&nbsp;&nbsp;&nbsp;".ftime($d->time_attended,24)."</td>";
                      echo "<td style=\"text-transform: capitalize;\">&nbsp;&nbsp;&nbsp;&nbsp;".ftime($d->time_finished,24)."</td>";
                      echo "<td style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;".$request_attend_interval."</td>";
                      echo "<td style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;".$attend_finish_interval."</td>";
 
									?>


								                  <td>
                                  <div class="btn-group"><!-- 
                                      <a class="btn btn-success" href="<?php echo site_url('caretaker_c/profile/'.$d->id); ?>"><i class="fa fa-eye"></i></a>
                                      <a class="btn btn-danger" data-toggle="modal" data-target="#myModal<?php echo $d->id; ?>"><i class="icon_close_alt2"></i></a> -->
                                  </div>
                                  </td>
                              </tr>
                              <?php } ?>
									<?php } ?>
                           </tbody>
                        </table>
                      </section>
                  </div>
              </div>
          </section>
      </section>
  </section>
  <?php 
require('require/footer.php'); 
?>