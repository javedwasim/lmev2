<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div id="main-container2">
    
    
    
   

    <?php include_once(APPPATH."views/common/top_nav.php"); ?>
    <div class="padding-md">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1 style="">Business Builder</h1>
            </div>
            <div class="panel-body">
                <div id="form-container">
                    <?php echo form_open_multipart('businessplan/step1',array('class' => 'form-horizontal no-margin form-border')); ?>
                       <div class="form-group">
                            <label class="col-lg-2 control-label">&nbsp;</label>
                            <div class="col-lg-8">
                                <div class="seperator"></div>
                                <input class="form-control" required=""  type="text" placeholder="Enter the name of business plan here" id="planname" name="planname" >
                            </div><!-- /.col -->
                            <label class="col-lg-2 control-label">&nbsp;</label>
                        </div><!-- /form-group -->
                        <div class="form-group">
                            <label class="col-lg-2 control-label">&nbsp</label>
                            <div class="col-lg-10">                       
                                <input type="submit" id="submitButton"  name="submitButton" value="Create New Business Plan" class="btn btn-primary">
                            </div><!-- /.col -->
                            <div class="seperator"></div>
                        </div><!-- /form-group -->
                    <?php form_close(); ?>
                </div>
            </div>
        </div><!-- /panel -->
        
      <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <h1>Your SAVED Business Plans</h1>
            <?php if(!empty($accessdetail)): ?>
                <h4><?php echo $accessdetail; ?></h4>
            <?php endif; ?>
        </div>
        <div class="padding-md clearfix">
            <table class="table table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th>Business Plan Name</th>
                            <th>Created Date</th>
                            <th>Last Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($allplanes as $plan): ?>
                        <tr>
                            <td><?php echo $plan->planname; ?></td>
                            <td><?php echo $plan->datecreated; ?></td>
                            <td><?php echo $plan->lastupdate; ?></td>
                            <td>
                                <a href="<?php echo base_url()."businessplan/step1/".$plan->id; ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit fa-lg"></i> Edit Plan</a>
                                
                                <a href="<?php echo base_url()."businessplan/deleteplan/".$plan->id; ?>" onclick="return confirm('Are you sure you want to delete this plan?');"class="btn btn-xs btn-danger"><i class="fa fa-trash-o fa-lg"></i> Delete Plan</a>
                            </td>         
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
            </table>
        </div><!-- /.padding-md -->
    </div><!-- /panel -->
  </div><!-- /.padding-md -->
</div><!-- /main-container -->

<script type='text/javascript'>
    /* attach a submit handler to the form */
    $("#step").submit(function(event) {

      /* stop form from submitting normally */
      event.preventDefault();

      /* get some values from elements on the page: */
      var $form = $( this ),
          url = $form.attr( 'action' );

      /* Send the data using post */
      var posting = $.post( url, { planname: $('#planname').val() } );

      /* Alerts the results */
      posting.done(function( data ) {
          $(".padding-md").html(data);
      
      });
    });
    
    function deletePlan(){
        alert("are you sure to delete this plan!");
    }
</script>