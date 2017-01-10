<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script src="<?php echo base_url(); ?>tinymce/js/tinymce/tinymce.min.js"></script>
 <script>
  tinymce.init(
{ 
        selector:'#maintextarea',
        menu: {
file: {title: 'File', items: 'newdocument'},
edit: {title: 'Edit', items: 'undo redo | cut copy paste pastetext | selectall'},
insert: {title: 'Insert', items: 'link media | template hr'},
view: {title: 'View', items: 'visualaid'},
format: {title: 'Format', items: 'bold italic underline strikethrough superscript subscript | formats | removeformat'},
table: {title: 'Table', items: 'inserttable tableprops deletetable | cell row column'},
tools: {title: 'Tools', items: 'spellchecker code'}
},
        menubar: 'file edit insert view format table tools image',
        plugins: "code autolink advlist print textcolor link image media anchor imagetools preview lists anchor emoticons",

        toolbar: [
                                'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify |  bullist numlist outdent indent | link image | print preview media | forecolor backcolor emoticons | code '								
                          ]
}
);

function GetHTMLContent()
{
var htmlContent = tinyMCE.get('maintextarea').getContent();

}
function SetHTMLContent(htmlContent)
{
tinyMCE.get('maintextarea').setContent(htmlContent);
}
</script>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div id="main-container2">
    
    
    
    

    <?php include_once(APPPATH."views/common/top_nav.php"); ?>
    <div class="padding-md">
<div class="panel panel-default">
    <div class="panel-heading">
    <h1>Customize Your E-Book</h1>
    <?php if(empty($id)){redirect('ebook/','refresh'); die();} ?>
    </div>
    <div class="panel-body">
        <div class="row">
        <?php 
            $ebook_id =  $this->uri->segment(3);
            $this->load->model('ebookM','',TRUE);
            $contentdata = $this->ebookM->getSaveContent($ebook_id);
            //print_r($contentdata);//die();

        ?>
        <?php echo form_open_multipart('ebook/grabcontent/'.$id,array('class' => '','id'=>'step1')); ?> 
        <div class="col-md-6" style="float: right">
            <div class="input-group">
                <input type="text" class="form-control input-sm" name="grabcontent" placeholder="Enter the URL here....." >
                <div class="input-group-btn">
                    <button type="submit" class="btn btn-sm btn-info" tabindex="-1">Grab Content</button>
                </div> 
                <?php echo form_close(); ?>
            </div> 
        </div>
        <?php echo form_open_multipart('ebook/savecontent/'.$id,array('class' => 'form-horizontal no-margin form-border','id'=>'step1')); ?>     
        <div  class="col-md-6">
                <input type="submit" id="saveButton"  name="saveButton" value="Save E-Book" class="btn btn-primary" />
                <input type="submit" id="submitButton"  name="submitButton" value="Save & Generate E-Book" class="btn btn-primary" />

        </div>
                
        </div>
        <div>
        <?php if(!empty($downloadlink)){ ?>
            Download Your E-Book by clicking here: <a href="<?php echo $downloadlink; ?>" target="_blank" style="color: blue !important; font-size:18px; font-weight:bold;">DOWNLOAD NOW!</a>
        <br/>
        <?php } ?>
            <textarea id="maintextarea" name="mycustomerhtml2" id="mycustomerhtml2" rows=25" cols="150"><?php if(isset($grabcontent)) {echo $grabcontent;} elseif(isset($content)){echo $content; }elseif(isset($contentdata[0]->ebookcontent)){echo $contentdata[0]->ebookcontent;}?></textarea>
        </div>
        <?php echo form_close(); ?>
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
</script>