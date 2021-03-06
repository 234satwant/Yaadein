<!-- Form.php
	This is main home page. Sass is used for css and it is in 
	application/views/form/stylesheets/screen.sass and changes
	are made in screen.css
-->
<html ng-app>
<head>
	<title>Form</title>	
	<meta charset="utf-8"> <!-- Character set -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="<?php echo base_url();?>application/views/Form/stylesheets/screen.css" media="screen,projection" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/views/Home/stylesheets/mobileView.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.0-beta.13/angular.min.js"></script>
	<script src="<?php echo base_url();?>application/views/Home/js/modernizr.custom.js"></script>
</head>
<body>
	<div class="container performa">
	<header class="header">
		<h1 class="heading1">Fill Form</h1>
	</header>
        <div class="s_data shrink">
            <div class="content">
            	
            	<?php echo $error;?>
				<?php echo form_open_multipart('form/do_upload');?>					
            	<form class="performa" method="post" accept-charset="utf-8" action="<?php echo base_url();?>index.php/form">
					<!-- Student Data -->

					<h2 class="name">Name</h2><br>
					<input type="text" ng-model="firstname" class="firstname" name="Firstname"  pattern="[a-zA-Z\s]+" title="Characters Only." placeholder="First Name" required /><br>
					<input type="text" ng-model="middlename" class="middlename" name="Middlename"  pattern="[a-zA-Z\s]+" title="Characters Only." placeholder="Middle Name" /><br>
					<input type="text" ng-model="lastname" class="lastname" name="Lastname"  pattern="[a-zA-Z\s]+" title="Characters Only." placeholder="Last Name" required /><br><br>
					
					<!-- Family -->
					<h2 class="name">Family Details</h2><br><br>
					<h2 class="name">Father Name Details</h2><br>
					<select name="Fatherprefix" class="prefix1" ng-model="prefix1" >
                		<option value="" disabled selected>Select Name Prefix</option>
                		<option value="Mr.">Mr.</option>
                		<option value="Sardar">Sardar</option>
                		<option value="Dr.">Dr.</option>
                		<option value="Er.">Er.</option>
        			</select><br>
					<input type="text" ng-model="fatherfirstname" class="father-firstname" name="Fatherfirstname"  pattern="[a-zA-Z\s]+" title="Characters Only." placeholder="Father's First Name" required /><br>
					<input type="text" ng-model="fathermiddlename" class="father-middlename" name="Fathermiddlename"  pattern="[a-zA-Z\s]+" title="Characters Only." placeholder="Father's Middle Name" /><br>
					<input type="text" ng-model="fatherlastname" class="father-lastname" name="Fatherlastname"  pattern="[a-zA-Z\s]+" title="Characters Only." placeholder="Father's Last Name"  required /><br><br>
					<h2 class="name">Mother Name Details</h2><br>
					<select name="Motherprefix" class="prefix2" ng-model="prefix2"  >
                		<option value="" disabled selected>Select Name Prefix</option>
                		<option value="Mrs.">Mrs.</option>
                		<option value="Dr.">Dr.</option>
                		<option value="Er.">Er.</option>
        			</select><br>
					<input type="text" ng-model="motherfirstname" class="mother-firstname" name="Motherfirstname"  pattern="[a-zA-Z\s]+" title="Characters Only." placeholder="Mother's First Name" required /><br>
					<input type="text" ng-model="mothermiddlename" class="mother-middlename" name="Mothermiddlename"  pattern="[a-zA-Z\s]+" title="Characters Only." placeholder="Mother's Middle Name" /><br>
					<input type="text" ng-model="motherlastname" class="mother-lastname" name="Motherlastname"  pattern="[a-zA-Z\s]+" title="Characters Only." placeholder="Mother's Last Name"  required /><br><br>	
					
					<!-- Personal Details -->
					<h2 class="name">Personal Details</h2><br>
					<!-- Date Of Birth -->
					<input type="text" ng-model="sex" class="sex" name="Gender"  pattern="[A-Z]{1}" title="Characters Only." placeholder="Gender : M/F" required /><br>
					<input type="text" ng-model="dob" class="dob" name="DOB" title="D.O.B : date/month_name/year" pattern="[0-3]{1}[0-9]{1}[/]{1}(January|Ferburary|March|April|May|June|July|August|September|October|November|December|)[/]{1}[0-9]{4}" placeholder="D.O.B Eg: 02/June/2000" title="DOB" required />
					<input type="number" ng-model="telephone" class="telephone" name="Mobile" title="Mobile Number" pattern="[0-9]{10}" placeholder="Mobile Number" required /><br>	
					<input type="number" ng-model="postalcode" class="postalcode" name="Postalcode"  pattern="[0-9]{6}" title="Number Only." placeholder="Postal Code" required /><br>
					<input type="textarea" ng-model="address" class="address" name="Address"  pattern="[a-zA-Z0-9.,-:/\s]+" title="Characters, Number, Dot, Comma, Colon and Backslash Only." placeholder="Address" required /><br><br>

					<!-- Image -->
					<h2 class="name">Upload Photo</h2><br>	
					<p style="text-align: center;"><input id="uploadImage" class="uploadImage" ng-model="image" type="file" name="userfile" onchange="PreviewImage();" size="20" required /></p><br><br>
					
					<!-- Class Details -->
					<h2 class="name">Class Details</h2><br>
					<select name="Branch" class="branch" ng-model="branch" placeholder="Enter Branch Name"  >
                		<option value="" disabled selected>Select Branch</option>
                		<option value="Mechanical">Mechanical</option>
                		<option value="Production">Production</option>
                		<option value="Civil">Civil</option>
                		<option value="Computer Science">Computer Science</option>
                		<option value="Information Technology">Information Technology</option>
                		<option value="Electrical">Electrical</option>
                		<option value="Electronics and Communication">Electronics and Communication</option>
        			</select>
					<input type="email" ng-model="email" class="eMail" name="Email" placeholder="E-mail" title="Please Fill Valid Email Address" required /><br>
					<input type="number" ng-model="classronum" class="classronum" name="Classronum"  pattern="[0-9\s]+" title="Number Only." placeholder="Class Roll Number" required /><br>
					<input type="number" ng-model="unironum" class="unironum" name="Unironum"  pattern="[0-9\s]+" title="Number Only." placeholder="University Roll Number" required /><br>
					<textarea class="textarea" ng-model="textarea" name="Comment" placeholder="Enter 2-3 Lines Comment" required  ></textarea><br><br>
					<p style="text-align: center;"><input type='submit' class="submit" value='Upload'/></p>
				<?php echo form_close();?>
				</form>	
        		
        	</div>

        	<div class="verticalLine">
        	</div>
			
			<!-- AngularJS -->
        	<div class="angular">
        		<!-- Image Preview -->
            	<img id="uploadPreview" class="upload_image"/>{{image}}
            		<script type="text/javascript">
						function PreviewImage() {
					    	var oFReader = new FileReader();
					    	oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
					   			oFReader.onload = function (oFREvent) {
					    			document.getElementById("uploadPreview").src = oFREvent.target.result;
								};
					    	};
					</script>
				<!-- Angular classes -->
				<h1 class="first_name">First Name : {{firstname}} {{middlename}} {{lastname}}</h1>
	            <h1 class="father_name">Father Name : {{prefix1}} {{fatherfirstname}} {{fathermiddlename}} {{fatherlastname}}</h1>
	            <h1 class="mother_name">Mother Name : {{prefix2}} {{motherfirstname}} {{mothermiddlename}} {{motherlastname}}</h1>
	            <h1 class="gender">Gender : {{sex}}</h1>
	            <h1 class="d_o_b">D.O.B : {{dob}}</h1>
	            <h1 class="ph_no">Mobile Number : {{telephone}}</h1>
	            <h1 class="postal_code">Postal Code : {{postalcode}}</h1>
	            <h1 class="add">Address : {{address}}</h1>
	            <h1 class="field">Branch : {{branch}}</h1>
	            <h1 class="mailid">E-mail : {{email}}</h1>	
	            <h1 class="class">Class Roll Number : {{classronum}}</h1>
	            <h1 class="university">University Roll Number : {{unironum}}</h1>            		
	            <h1 class="comment">Comment : {{textarea}}</h1>            
            </div>
            <div style="clear:both;">
           	</div>
    	</div>	
	</div>
</body>
<!-- Script files for mobile view  -->
<script src="<?php echo base_url();?>application/views/Home/js/classie.js"></script>
<script src="<?php echo base_url();?>application/views/Home/js/borderMenu.js"></script>
</html>