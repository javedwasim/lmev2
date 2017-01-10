


<!DOCTYPE html>
<html>
<head>
  <script src="tinymce/js/tinymce/tinymce.min.js"></script>
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
</script>
</head>
<body>
<!--
<form method="post" action="pdf_from_html2.php">
  Put Your HTML Here:<br>
  <textarea name="mycustomerhtml" id="mycustomerhtml"" rows=4" cols="50">

</textarea>
 <input type="submit" value="Submit">
</form>
-->
<br/><br/><br/>

	
<form id="my-htmleditor-form" method="post" action="pdf_from_html3.php">
  
  <input type="button" onclick=" GetSourceCode();" value="Generate EBook" style="background: #4B94B7;
    padding: 20px;
    border-radius: 10px;
    color: white;
    font-size: 20px;    cursor: pointer;">
	
  
   
  <textarea id="maintextarea" name="mycustomerhtml2" id="mycustomerhtml2"" rows=25" cols="150">

</textarea>
<input type="hidden" id="customHTML" name="customHTML"> 

</form>

<script>
function GetSourceCode()
{
	//alert(tinyMCE.get('maintextarea').getContent());
	
	var allHTML = tinyMCE.get('maintextarea').getContent();
	document.getElementById('customHTML').value = allHTML;
	document.getElementById('my-htmleditor-form').submit();
}
</script>
</body>
</html>