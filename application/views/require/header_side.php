<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/favicon.png">

    <title>Press to Express</title>

    <!-- Bootstrap CSS -->    
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="<?php echo base_url();?>assets/css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="<?php echo base_url();?>assets/css/elegant-icons-style.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>assets/css/font-awesome.min.css" rel="stylesheet" />    
    <!-- full calendar css-->
    <link href="<?php echo base_url();?>assets/assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
  <link href="<?php echo base_url();?>assets/assets/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" />
    <!-- easy pie chart-->
    <link href="<?php echo base_url();?>assets/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <!-- owl carousel -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/owl.carousel.css" type="text/css">
  <link href="<?php echo base_url();?>assets/css/jquery-jvectormap-1.2.2.css" rel="stylesheet">
    <!-- Custom styles -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/fullcalendar.css">
  <link href="<?php echo base_url();?>assets/css/widgets.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/mystyle.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/style-responsive.css" rel="stylesheet" />
  <link href="<?php echo base_url();?>assets/css/xcharts.min.css" rel=" stylesheet">  
  <link href="<?php echo base_url();?>assets/css/jquery-ui-1.10.4.min.css" rel="stylesheet">
    
  </head>

  <body>
    <header class="header dark-bg">
            <div class="toggle-nav">
                <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
            </div>

            <a href="index.html" class="logo">exPress<span class="lite">Admin</span></a>
            
            <div class="top-nav notification-row">       
                <ul class="nav pull-right top-menu">
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="profile-ava">
              <?php if($_SESSION['gender']=="female"){ ?>
                <img height="45" width="45" src="<?php echo base_url();?>assets/img/female.png"> </span>
              <?php }else if($_SESSION['gender']=="male"){ ?> 
                <img height="45" width="45" src="<?php echo base_url();?>assets/img/male.png"> </span>
              <?php }else{ ?>
                <img height="45" width="45" src="<?php echo base_url();?>assets/img/q.png"> </span>
              <?php } ?>
                            <span class="username"><?php echo $_SESSION['fname']." ".$_SESSION['mname']." ".$_SESSION['lname']; ?></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li class="eborder-top">
                                <a href="<?php  echo site_url('login/my_profile'); ?>"><i class="icon_profile"></i> My Profile</a>
                            </li>
                            <li class="eborder-top">
                           
                                <a  data-toggle="modal" data-target="#deactivate<?php echo $_SESSION['id']; ?>" ><i class="fa fa-power-off"></i> Deactivate Account</a>
                                
                            </li>
                            <li>
                                <a href="<?php echo site_url('login/logout');?>"><i class="icon_key_alt"></i> Log Out</a>
                            </li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!-- notificatoin dropdown end-->
            </div>

              
    </header>   
      <div class="modal fade" id="deactivate<?php echo $_SESSION['id']; ?>" role="dialog">
                              <div class="modal-dialog modal-sm" style="width:30%;">
                                <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title"><i style="color:gold;" class="fa fa-exclamation-triangle" aria-hidden="true"> Warning</i></h4>
                                </div>
                                <div class="modal-body">
                                  Are you sure you want to Deactivate your Account?
                                </div>
                                <div class="modal-footer">
                                <a type="button" class="btn btn-danger" href="<?php  echo site_url('admin_c/del_admin/'.$_SESSION['id']); ?>">Confirm</a>
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                                </div>
                              </div>
                           </div>

    <section id="container" class="">
     
    <aside>
      <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu">                
                  <li>
                      <a class="" href="<?php echo site_url('login/home'); ?>">
                          <i class="icon_genius"></i>
                          <span>Admin Accounts</span>
                      </a>
                  </li>
          <li>
                      <a class="" href="<?php echo site_url('account_c/caretaker'); ?>">
                          <i class="fa fa-user"></i>
                          <span>Caretaker</span>
                      </a>
                  </li>
          <li>
                      <a href="<?php echo site_url('patient_c/view_all'); ?>">
                          <i class="fa fa-wheelchair"></i>
                          <span>Patients</span>
                      </a>
                  </li>   
                  <li>
                      <a href="<?php echo site_url('transaction_c/view_transactions'); ?>">
                          <i class="icon_document_alt"></i>
                          <span>Transactions</span>
                      </a>
                  </li>   
          <li>
                      <a href="<?php echo site_url('express_device_c/view_device'); ?>">
                          <i class="fa fa-desktop"></i>
                          <span>Express Devices</span>
                      </a>
                  </li>   
          <li>
                      <a class="" href="<?php echo site_url('bed_rooms'); ?>">
                          <i class="fa fa-university" aria-hidden="true"></i>
                          <span>Bed and Rooms</span>
                      </a>
                  </li>
                  
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->