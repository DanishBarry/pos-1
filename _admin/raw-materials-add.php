<?php
include('../sulata/includes/config.php');
include('../sulata/includes/functions.php');
include('../sulata/includes/connection.php');
include('../sulata/includes/get-settings.php');
include('../sulata/includes/db-structure.php');
checkLogin();
$pageName='Add Raw Materials';$pageTitle='Add Raw Materials';
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include('inc-head.php'); ?>
        <script type="text/javascript">
            $(document).ready(function() {
                //Keep session alive
                $(function() {
                    window.setInterval("suStayAlive('<?php echo PING_URL; ?>')", 300000);
                });
                //Disable submit button
                suToggleButton(1);
            });
        </script> 
    </head>

    <body>

        <div class="outer">

            <!-- Sidebar starts -->

            <?php include('inc-sidebar.php'); ?>
            <!-- Sidebar ends -->

            <!-- Mainbar starts -->
            <div class="mainbar">
                <?php include('inc-heading.php'); ?>
                <!-- Mainbar head starts -->
                <div class="main-head">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3 col-sm-4 col-xs-6">
                                <!-- Bread crumbs -->
                                <?php include('inc-breadcrumbs.php'); ?>
                            </div>

                            <div class="col-md-3 col-sm-4 col-xs-6">
                                <!-- Search block -->

                            </div>

                            <div class="col-md-3 col-sm-4 hidden-xs">
                                <!-- Notifications -->
                                <div class="head-noty text-center">

                                </div>
                                <div class="clearfix"></div>
                            </div>


                            <div class="col-md-3 hidden-sm hidden-xs">
                                <!-- Head user -->

                                <?php include('inc-header.php'); ?>
                                <div class="clearfix"></div>
                            </div>
                        </div>	
                    </div>

                </div>

                <!-- Mainbar head ends -->

                <div class="main-content">
                    <div class="container">

                        <div class="page-content">

                            <!-- Heading -->
                            <div class="single-head">
                                <!-- Heading -->
                                <h3 class="pull-left"><i class="fa fa-desktop purple"></i> <?php echo $pageTitle; ?></h3>
                                <div class="pull-right">
                                    <a href="<?php echo ADMIN_URL; ?>raw-materials-cards/"><i class="fa fa-th-large"></i></a>
                                    <a href="<?php echo ADMIN_URL; ?>raw-materials/"><i class="fa fa-table"></i></a>
                                </div>

                                <div class="clearfix"></div>
                            </div>

                            <div id="content-area">

                                <div id="error-area">
                                    <ul></ul>
                                </div>    
                                <div id="message-area">
                                    <p></p>
                                </div>
                                <!--SU STARTS-->
                                
        <form class="form-horizontal" action="<?php echo ADMIN_SUBMIT_URL; ?>raw-materials-remote/add/" accept-charset="utf-8" name="suForm" id="suForm" method="post" target="remote" >

            <div class="gallery clearfix">
<div class="form-group">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">                
<label><?php echo $dbs_sulata_raw_materials['rawmaterial__Material_req']; ?>Material:</label>
                                <?php
                                $arg = array('type' => $dbs_sulata_raw_materials['rawmaterial__Material_html5_type'] , 'name' => 'rawmaterial__Material', 'id' => 'rawmaterial__Material', 'autocomplete' => 'off', 'maxlength' =>  $dbs_sulata_raw_materials['rawmaterial__Material_max']  , 'value'=>'',$dbs_sulata_raw_materials['rawmaterial__Material_html5_req'] => $dbs_sulata_raw_materials['rawmaterial__Material_html5_req'],'class'=>'form-control');
                                echo suInput('input', $arg);
                                ?>
</div>
</div>

<div class="form-group">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">        
<label><?php echo $dbs_sulata_raw_materials['rawmaterial__Unit_req']; ?>Unit:</label>
                                <?php
                                $options = $dbs_sulata_raw_materials['rawmaterial__Unit_array'];
                                    $js = "class='form-control'";
                                echo suDropdown('rawmaterial__Unit', $options, '',$js)
                                ?>
</div>
</div>

        
        </div>
        <div class="lineSpacer clear"></div>
        <p>
        <?php
        $arg = array('type' => 'submit', 'name' => 'Submit', 'id' => 'Submit', 'value' => 'Submit', 'class' => 'btn btn-primary pull-right');
        echo suInput('input', $arg);
        ?>                              
        </p>
        <p>&nbsp;</p>
        </form>

                                <!--SU ENDS-->
                            </div>
                        </div>
                        <?php include('inc-site-footer.php'); ?>
                    </div>
                </div>

            </div>

            <!-- Mainbar ends -->

            <div class="clearfix"></div>
        </div>
        <?php include('inc-footer.php'); ?>
        <?php suIframe(); ?>  
    </body>
    <!--PRETTY PHOTO-->
    <?php include('inc-pretty-photo.php'); ?>    
</html>