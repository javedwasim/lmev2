<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div id="main-container2">
    
    
    
    

    <?php include_once(APPPATH."views/common/top_nav.php"); ?>
    <div class="padding-md">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1> E-Book Generator Tool</h1>
            </div>
            <div class="panel-body">
                <div id="form-container">
                    <?php echo form_open_multipart('ebook/generate',array('class' => 'form-horizontal no-margin form-border')); ?>
                       <div class="form-group">
                            <label class="col-lg-2 control-label">&nbsp;</label>
                            <div class="col-lg-8">
                                <div class="seperator"></div>
                                <input class="form-control" type="text" placeholder="Enter the name of your E-Book here" id="ebookname" name="ebookname" >
                            </div><!-- /.col -->
                            <label class="col-lg-2 control-label">&nbsp;</label>
                        </div><!-- /form-group -->
                        <div class="form-group">
                            <label class="col-lg-2 control-label">&nbsp</label>
                            <div class="col-lg-10">                       
                                <input type="submit" id="submitButton"  name="submitButton" value="Create New E-Book" class="btn btn-primary">
                            </div><!-- /.col -->
                            <div class="seperator"></div>
                        </div><!-- /form-group -->
                    <?php form_close(); ?>
                </div>
            </div>
        </div><!-- /panel -->
        
      <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <h1>Your SAVED E-Books</h1>

        </div>
        <div class="padding-md clearfix">
            <table class="table table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th>E-Book Name</th>
                            <th>Created Date</th>
                            <th>Last Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($myAllEbooksData as $ebookitem): ?>
                        <tr>
                            <td><?php echo $ebookitem->ebookname; ?></td>
                            <td><?php echo $ebookitem->datecreated; ?></td>
                            <td><?php echo $ebookitem->lastupdate; ?></td>
                            <td>
                                
								 <a href="<?php echo base_url()."ebook/savecontent/".$ebookitem->id; ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit fa-lg"></i> Edit Plan</a>
                                
								<a href="#" onclick="deletePlan();"class="btn btn-xs btn-danger"><i class="fa fa-trash-o fa-lg"></i> Delete Plan</a>
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
        alert("Are you sure to delete this e-book?");
    }
</script>