<?php
include('../sulata/includes/config.php');
include('../sulata/includes/functions.php');
include('../sulata/includes/connection.php');
include('../sulata/includes/get-settings.php');
include('../sulata/includes/db-structure.php');
checkLogin();

$id = suSegment(1);
if(!is_numeric($id)){
	suExit(INVALID_RECORD);
}
$sql = "SELECT menu__ID,menu__Title,menu__Status FROM sulata_menus WHERE menu__dbState='Live' AND menu__ID='" . $id . "'";
$result = suQuery($sql);
if (suNumRows($result) == 0) {
    suExit(INVALID_RECORD);
}
$row = suFetch($result);
suFree($result);    

$pageName='Update Menus';$pageTitle='Update Menus';
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
                                    <a href="<?php echo ADMIN_URL; ?>menus-cards/"><i class="fa fa-th-large"></i></a>
                                    <a href="<?php echo ADMIN_URL; ?>menus/"><i class="fa fa-table"></i></a>
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
                                
        <form class="form-horizontal" action="<?php echo ADMIN_SUBMIT_URL; ?>menus-remote/update/" accept-charset="utf-8" name="suForm" id="suForm" method="post" target="remote" >
            <div class="gallery clearfix">
<div class="form-group">
<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">                
<label><?php echo $dbs_sulata_menus['menu__Title_req']; ?>Title:</label>
                                <?php
                                $arg = array('type' => $dbs_sulata_menus['menu__Title_html5_type'] , 'name' => 'menu__Title', 'id' => 'menu__Title', 'autocomplete' => 'off', 'maxlength' =>  $dbs_sulata_menus['menu__Title_max']  , 'value'=>suUnstrip($row['menu__Title']),$dbs_sulata_menus['menu__Title_html5_req'] => $dbs_sulata_menus['menu__Title_html5_req'],'class'=>'form-control');
                                echo suInput('input', $arg);
                                ?>
</div>

<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">        
<label><?php echo $dbs_sulata_menus['menu__Status_req']; ?>Status:</label>
                                <?php
                                $options = $dbs_sulata_menus['menu__Status_array'];
                                    $js = "class='form-control'";
                                echo suDropdown('menu__Status', $options,  suUnstrip($row['menu__Status']),$js)
                                ?>
</div>
</div>
                <div class="form-group">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="single-head">
                                                    <!-- Heading -->
                                                    <h3 class="pull-left"><i class="fa fa-list purple"></i> Add Products</h3> 
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div id="checkboxArea" style="margin-bottom: 20px !important">
<?php
$chkArr = array();
//Get entered data
$sql = "SELECT menudetail__Product  FROM sulata_menu_details WHERE  menudetail__dbState ='Live' AND  menudetail__Menu ='" . $id . "'";
$result = suQuery($sql);
while ($row = suFetch($result)) {
    array_push($chkArr, $row['menudetail__Product']);
}suFree($result);

$sql = "SELECT product__ID, product__Name FROM sulata_products WHERE product__dbState ='Live' AND product__Status = 'Available' ORDER BY product__Code";
$result = suQuery($sql);
                                            while ($row = suFetch($result)) {
                                                $chkUid = $row['product__ID'];
                                                if (in_array($row['product__ID'], $chkArr)) {
                                                    ?>

                                                    <table id="chkTbl<?php echo $chkUid; ?>" class="checkTable"><tbody><tr><td class="checkTd"><?php echo suUnstrip($row['product__Name']); ?></td><td onclick="removeCheckbox('<?php echo $row['product__ID']; ?>')" class="checkTdCancel"><a onclick="removeCheckbox('<?php echo $row['product__ID']; ?>')" href="javascript:;">x</a></td></tr><input type="hidden" name="product__Name[]" value="<?php echo $row['product__ID']; ?>"></tbody></table>
                                           <?php
                                                }
                                            }suFree();
                                            ?>    
</div> 
                                                <p class="clearfix">&nbsp;</p>
                                                <div class="clearfix"></div>
                                                <?php
                                                $sqlCategories = "SELECT category__ID,category__Category FROM sulata_categories WHERE category__dbState = 'Live'";
                                                $rsCategories = suQuery($sqlCategories);
                                                $i = 1;
                                                while ($rowCategories = suFetch($rsCategories)) {
                                                    
                                                    ?>
                                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="float: left;height: 250px">
                                                    
                                                    <h4 style="padding-top: 20px"><?php echo $i . ' - ' . $rowCategories['category__Category'] ?></h4>
                                                    <div class="clearfix"></div>

                                                    <p class="clearfix">&nbsp;</p>                                
                                                    <div id="checkboxLinkArea">
                                                        <?php
//Build checkboxes

                                                        $sql = "SELECT product__ID, product__Name FROM sulata_products WHERE product__dbState ='Live' AND product__Status = 'Available' AND product__Category = '" . $rowCategories['category__ID'] . "' ORDER BY product__Name";
                                                        $result = suQuery($sql);
                                                        ?>
                                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >


                                                            <?php
                                                            while ($row = suFetch($result)) {
                                                                $chkUid = $row['product__ID'];
                                                              
if (in_array($row['product__ID'], $chkArr)) {
                                                        $display = "style='display:none'";
                                                    } else {
                                                        $display = '';
                                                    }
                                                                ?>
                                                            <a <?php echo $display; ?> id="chk<?php echo $chkUid; ?>" href="javascript:;" class="underline" onclick="loadCheckbox('<?php echo $chkUid; ?>', '<?php echo addslashes(suUnstrip($row['product__Name'])); ?>', 'product__Name_2')" onmouseover="toggleCheckboxClass('over', '<?php echo $chkUid; ?>');" onmouseout="toggleCheckboxClass('out', '<?php echo $chkUid; ?>');"><i id="fa<?php echo $chkUid; ?>" class="fa fa-square-o"></i> <?php echo suUnstrip($row['product__Name']); ?>.</a><br>

                                                            
                                                                <?php
                                                            }suFree($result);
                                                            ?>
                                                            <p class="clearfix">&nbsp;</p>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                               
                                         
                                                <?php
                                                $i++;
                                            }suFree($rsCategories);
                                            ?>
                                            <div class="clearfix"></div>


                                        </div>      
                                    </div>

        
        <p>
        <?php
        $arg = array('type' => 'submit', 'name' => 'Submit', 'id' => 'Submit', 'value' => 'Submit', 'class' => 'btn btn-primary pull-right');
        echo suInput('input', $arg);
        ?>                              
        </p>
        <?php
        //Referrer field
        $arg = array('type' => 'hidden', 'name' => 'referrer', 'id' => 'referrer', 'value' => $_SERVER['HTTP_REFERER']);
        echo suInput('input', $arg);                       
        //Id field
        $arg = array('type' => 'hidden', 'name' => 'menu__ID', 'id' => 'menu__ID', 'value' => $id);
        echo suInput('input', $arg);
        ?>
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