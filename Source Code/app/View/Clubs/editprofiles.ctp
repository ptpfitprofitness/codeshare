<?php
/*echo '<pre>';
print_r($setSpecalistArr);
//print_r($this->data);
echo '</pre>';*/

if($this->Session->read('USER_ID'))
{
	
if($setUser=='ClubBranch')
	{
		$utype='ClubBranch';
	}
	else {
$utype=$this->Session->read('UTYPE');
	}


  if($utype=='Club' || $utype=='ClubBranch' || $utype=='Trainer')
  {
  	if($setSpecalistArr[$utype]['logo']!='')
  	{
  		$logo=$config['url'].'uploads/'.$setSpecalistArr[$utype]['logo'];
  	}
  	$uname=$setSpecalistArr[$utype]['full_name'];
  	
  }
  elseif($utype=='Trainee')
  {
  	
  	if($setSpecalistArr[$utype]['photo']!='')
  	{
  		$logo=$config['url'].'uploads/'.$setSpecalistArr[$utype]['photo'];
  	}
  	$uname=$setSpecalistArr[$utype]['full_name'];
  }
  if($utype=='Corporation')
  {
  	$uname=$setSpecalistArr[$utype]['company_name'];
  }	
	
}

?>
<script>
function editstatus(str)
{
	//alert(str);
	var editsecHtml='<textarea name="userfb_status" id="userfb_statusid"></textarea><input type="button" name="submit" value="Save" onclick="saveedit('+str+');" class="change-pic-nav" style="width:50px;"/><input type="button" name="cancel" class="change-pic-nav" style="width:58px;margin-left:10px;" onclick="canceledit('+str+');" value="Cancel"/>';
	$('#userfb_status').html(editsecHtml);
	
}
function validuppic()
{
	var pic=$('#ClubLogo').val();
	if(pic=='')
	{
		alert('Please select the photo');
		return false;
	}
	else
	{
		return true;
	}
	
}
function validcuppic()
{
	var pic=$('#<?php echo $this->Session->read('UTYPE');?>Cpic').val();
	if(pic=='')
	{
		alert('Please select the Cover photo');
		return false;
	}
	else
	{
		return true;
	}
	
}
function saveedit(str2)
{
	var sthtml=$('#userfb_statusid').val();
	//alert(sthtml);
	 $.post("<?php echo $config['url'];?>clubs/userfbstatus", {userfb_status: sthtml, id: str2}, function(data)
            {
            	if(data==1)
            	{
            		$('#userfb_status').html('<a href="javascript:void(0);" onclick="editstatus('+str2+');" style="color:#fff;">'+sthtml+'<a>');
            	}
            	else
            	{
            		$('#userfb_status').html('<a href="javascript:void(0);" onclick="editstatus('+str2+');" style="color:#fff;">Set your current status, click here!!!</a>');
            	}
            });
}
function canceledit(str3)
{
	
	 $.post("<?php echo $config['url'];?>clubs/userfbstatusget", {id: str3}, function(data)
	 {
	 	if(data!='')
	 	{
	 		$('#userfb_status').html('<a href="javascript:void(0);" onclick="editstatus('+str3+');" style="color:#fff;">'+data+'</a>');
	 	}
	 	else
	 	{
	 		$('#userfb_status').html('<a href="javascript:void(0);" onclick="editstatus('+str3+');" style="color:#fff;">Set your current status, click here!!!</a>');
	 	}
	 });
	
}

function removePic(elem) {
		
	r = confirm("Are you sure want to remove the image ?");
	if(r){
		elem.innerHTML = "Please Wait,while deleting";
		$.ajax({
				url:"<?php echo $config['url'];?>clubs/removePic/",
				type:"POST",
				data:{id:elem.id},
				success:function(e) {
					var response = eval(' ( '+e+' ) ');
					if( response.responseclassName == "nSuccess" ) {
						elem.innerHTML = "Successfully deleted";
						$("#imgCont").slideUp("slow");
						$("#image").val("");
						$("#new_image").val("");
						$("#CategoryImagePath").val("");
						$("#ClubOldImage").val("");
						$("#file").className  = 'validate[required]';
					}
				}
		});
	}
}
function validateconfirmpass()
{
	   var oldpassword=$('#oldpassword').val();
	   var newpassword=$('#newpassword').val();
	   var conpassword= $('#conpassword').val();
	  
		
		if(oldpassword=='' || newpassword=='' || conpassword=='')
		{
		alert('Please Fill all fields');
		return false;
		}
		
		
	else
	{
		return true;
	}

}
</script>
<style>
.sltbx{font-family: Arial, Helvetica, sans-serif;
height: 36px;
left: 6px;
opacity: 0;
position: absolute;
top: 0;
width: 97%;
z-index: 99999;}
.fullper{width:100%;height:1280px;}

<?php if($setSpecalistArr[$utype]['cpic']!=''){?>
.inside-banner{ background: url("<?php echo $config['url'];?>uploads/<?php echo $setSpecalistArr[$utype]['cpic'];?>") no-repeat scroll 0 0 / cover rgba(0, 0, 0, 0);}
<?php }?>
</style>
<section class="contentContainer clearfix">
    <div class="inside-banner changecover-pic">
    <div class="change-coverpic" onclick="popupOpen('pop5');"><img src="<?php echo $config['url'];?>images/pencial_icon.png" /> Change Cover </div>
      <div class="row">
        <div class="eight inside-head offset-by-four columns">
          <h2 class="client-name"><?php echo $uname;?></h2>
          <h3 class="client-details">from <?php echo $setSpecalistArr[$utype]['city'].', '.$setSpecalistArr[$utype]['state'];?></h3>
          <p class="client-discription" id="userfb_status"><?php if($setSpecalistArr[$utype]['userfb_status']!=''){ if($this->Session->read('USER_ID') && ($this->Session->read('USER_ID')==$setSpecalistArr[$utype]['id'])){ echo '<a href="javascript:void(0);" onclick="editstatus('.$setSpecalistArr[$utype]['id'].');" style="color:#fff;">'.$setSpecalistArr[$utype]['userfb_status'].'</a>';} else {echo $setSpecalistArr[$utype]['userfb_status'];}} elseif($this->Session->read('USER_ID') && ($this->Session->read('USER_ID')==$setSpecalistArr[$utype]['id'])){ echo '<a href="javascript:void(0);" onclick="editstatus('.$setSpecalistArr[$utype]['id'].');" style="color:#fff;">Set your current status, click here!!!</a>';}?></p>
        </div>
      </div>
    </div>
    <div class="row">
       <?php echo $this->element('leftclub');?>
      
      <div class="eight inside-head columns">
        <ul class="profile-tabs-list desktop-tabs clearfix">
          <li><a href="#Profile" class="active"><span class="profile-ico"></span>Edit Profile</a></li>
       
        </ul>    
        
        <ul class="profile-tabs-list mobile-tab clearfix">
          <li class="mobile-tab-list"><a href="#Profile" class="active"><span class="profile-ico"></span>Edit Profile</a></li>
          <div class="clear"></div>
          <div id="Profile" class="euual-height desktop-tab profile-tabs-content clearfix fullper" >
          <div class="row">
            <div class="two columns change-pic">
              <div class="change-pic-img"> <img src="<?php echo $logo;?>" width="75" height="76" /> </div>
              <a href="#" class="change-pic-nav" onclick="popupOpen('pop4');">Change Pic</a> 
               
              </div>
            <!-- CHANGE PASSWORD-->
			<div class="two columns change-pic" style="float:right">
               <a href="#" class="change-pic-nav" onclick="popupOpen('popchangepass');">Change Password</a> 
            </div>
			<!-- CHANGE PASSWORD-->  
            <div class="ten columns profile-change-pictext">
              <!--<h2>About Me</h2>-->
              <p><?php echo $setSpecalistArr[$utype]['about_us'];?></p>
            </div>
            
          </div>
          <div>
          
            <form accept-charset="utf-8" method="post" id="valid" class="resform-wrap" enctype="multipart/form-data" controller="clubs" action="/clubs/editprofiles/">
		<?php echo $this->Form->hidden('ClubBranch.id'); ?>
            
                       
            <?php //echo $this->Form->text('ClubBranch.username', array('maxlength'=>255,'id'=>'Username','readonly'=>'readonly', 'class'=>'validate[required]','placeholder'=>'Username')); ?>

				<?php echo $this->Form->error('ClubBranch.username', null, array('class' => 'error')); ?>
           <?php echo $this->Form->text('ClubBranch.email', array('maxlength'=>255,'id'=>'EmailAddress','readonly'=>'readonly', 'class'=>'validate[required,custom[email],ajax[agantEmailValidate]]','placeholder'=>'Email Address')); ?>

				<?php echo $this->Form->error('ClubBranch.email', null, array('class' => 'error')); ?>
				 <?php //echo $this->Form->password('ClubBranch.password', array('maxlength'=>255, 'class'=>'validate[required]','placeholder'=>'Password')); ?>

				<?php //echo $this->Form->error('ClubBranch.password', null, array('class' => 'error')); ?>
            <div class="row">
              <div class="six columns">
             
				
<?php echo $this->Form->text('ClubBranch.first_name', array('maxlength'=>255,'id'=>'FirstName','class'=>'validate[required]','placeholder'=>'First name')); ?>

				<?php echo $this->Form->error('ClubBranch.first_name', null, array('class' => 'error')); ?>
                
               
              </div>
              <div class="six columns">
             
				
				<?php echo $this->Form->text('ClubBranch.last_name', array('maxlength'=>255,'id'=>'LastName','class'=>'validate[required]','placeholder'=>'Last name')); ?>

				<?php echo $this->Form->error('ClubBranch.last_name', null, array('class' => 'error')); ?>

               
              
              </div>
            </div>
            	<?php echo $this->Form->text('ClubBranch.address', array('maxlength'=>255,'id'=>'Address','placeholder'=>'Address')); ?>

				<?php echo $this->Form->error('ClubBranch.address', null, array('class' => 'error')); ?>
           
            <div class="row">
              <div class="six columns">
              <?php echo $this->Form->text('ClubBranch.city', array('maxlength'=>255, 'id'=>'city','placeholder'=>'City')); ?>
				
				<?php echo $this->Form->error('ClubBranch.city', null, array('class' => 'error')); ?>
               
              </div>
              <div class="six columns">
              <?php echo $this->Form->text('ClubBranch.state', array('maxlength'=>255, 'id'=>'state','placeholder'=>'State')); ?>
				
				<?php echo $this->Form->error('ClubBranch.state', null, array('class' => 'error')); ?>
               
              </div>
            </div>
            <div class="row">
              <div class="twelve form-select columns">
              
              
				<?php echo $this->Form->select('ClubBranch.country', $countries, array('style'=>'','onChange'=>'document.getElementById(\'customSelect\').value= this.options[this.selectedIndex].text','default'=>226));?>
				
				<?php echo $this->Form->error('ClubBranch.country', null, array('class' => 'error')); ?>
              
               
                <input type="text" id="customSelect" value="<?php if($this->data['ClubBranch']['country']!=''){
                foreach($countries as $key=>$val)
                {
                  if($key==$this->data['ClubBranch']['country'])
                  {
                  	 echo $val;
                  }	
                	
                }
                }else{echo 'UNITED STATES';}?>"/>
              </div>
            </div>
       
            

            
            <?php echo $this->Form->text('ClubBranch.zip', array('maxlength'=>255, 'id'=>'zip','placeholder'=>'Zip code')); ?>
				
				<?php echo $this->Form->error('ClubBranch.zip', null, array('class' => 'error')); ?>
            
            <div class="row">
              <div class="six columns">
              	<?php echo $this->Form->text('ClubBranch.phone', array('maxlength'=>255,'id'=>'Phone','placeholder'=>'Phone')); ?>

				<?php echo $this->Form->error('ClubBranch.phone', null, array('class' => 'error')); ?>
              </div>
              <div class="six columns">
                <?php echo $this->Form->text('ClubBranch.mobile', array('maxlength'=>255,'id'=>'Mobile')); ?>

				<?php echo $this->Form->error('ClubBranch.mobile', null, array('class' => 'error')); ?>
              </div>
            </div>
           
            <div class="row">
              <div class="six columns"><span class="file-wrapper">
              	<?php echo $this->Form->file('ClubBranch.logo');?>
								<?php echo $this->Form->error('Club.logo', null, array('class' => 'error'));?>
							</div>
							<div class="fix"></div>
							<?php echo $this->Form->hidden('ClubBranch.id'); ?>
							
							 <?php echo $this->Form->hidden('ClubBranch.old_image',array('value'=>$this->request->data["ClubBranch"]["logo"]));?>
							
						</div>
							<div id="imgCont" class="rowElem noborder">
						<div class="formRight">
						
							<div style="float:left;<?php if( array_key_exists("logo",$this->request->data["ClubBranch"]) && !empty($this->request->data["ClubBranch"]["logo"]) ) { ?>border:1px solid #d8d8d8;<?php } ?>padding:8px;" id="video_container">
							<?php if( array_key_exists("logo",$this->request->data["ClubBranch"]) && !empty($this->request->data["ClubBranch"]["logo"]) ) { ?>
								<img border="1"  width="100px" src="<?php echo $config["imgurl"];?>uploads/<?php echo $this->data["ClubBranch"]["logo"];?>"/>
								<span style="margin-left:11px;margin-top:-22px;position:absolute;">
									<a id="<?php echo $this->data["ClubBranch"]["id"];?>" onclick="removePic(this);"  style="cursor:pointer" title="click to delete">
										<img border="1" src="<?php echo $config["imgurl"];?>img/cross.png"/>
									</a>
								</span>
							<?php 	} ?>	
							</div>
						</div>
						
					<div class="clear"></div>
						<?php echo $this->Form->file('ClubBranch.logo');?>
								<?php echo $this->Form->error('ClubBranch.logo', null, array('class' => 'error'));?>
							
							<?php echo $this->Form->hidden('ClubBranch.id'); ?>
							
							 <?php echo $this->Form->hidden('ClubBranch.old_image',array('value'=>$this->request->data["ClubBranch"]["logo"]));?>
				<div class="row">		
				<br/>
				<br/>
					 
                <?php echo $this->Form->textarea('ClubBranch.about_us', array('maxlength'=>500,'placeholder'=>'About Us')); ?>

				<?php echo $this->Form->error('ClubBranch.about_us', null, array('class' => 'error')); ?>
				</div>
               </div>
             
            </div>
            <!--<input type="text" name="" value="" placeholder="Certifications" />
            <input type="text" name="" value="" placeholder="Degrees" />-->
         
            <input type="submit" class="submit-nav" name="submit" value="Save"  />
          </form>
          
         

          </div>
        </div>
         
         
        </div>
        </ul>      
      </div>
    </div>
  </section>
  <!-- contentContainer ends -->
  <div class="clear"></div>
    <!-- Change Cover popup -->
                <div id="pop5" class="main-popup">
                  <div class="overlaybox common-overlay"></div>
                  <div id="thirtydays" class="register-form-popup common-overlaycontent"> <a class="close-nav" onclick="popupClose('pop5');" id="pop5" href="javascript:void(0);"></a>
                    <div class="row register-popup-form">
                      <div class="twelve field-pad columns">
                        <form action="/<?php if($setUser=='ClubBranch'){ echo 'clubs/coverpicbr/';} else{echo 'home/coverpic/';}?>" controller="home" enctype="multipart/form-data" class="resform-wrap" id="valid" method="post" accept-charset="utf-8" onsubmit="return validcuppic();">
                          <h2>Upload Cover Pic</h2>
                           <input type="file" name="data[<?php echo $this->Session->read('UTYPE');?>][cpic]" id="<?php echo $this->Session->read('UTYPE');?>Cpic" />
                           <?php echo $this->Form->hidden($this->Session->read('UTYPE').'id',array('value'=>$this->Session->read('USER_ID')));?>
                           <?php echo $this->Form->hidden($this->Session->read('UTYPE').'old_covimage',array('value'=>$setSpecalistArr[$utype]['logo']));?>
                          <!--<input type="file" name="" value="" placeholder="upload pic" />-->
                               
                            <div class="row">
                        
                        <div class="twelve already-member columns">
                          <input type="submit" value="Submit" name="" class="submit-nav">
                       </div>   
                      </div>                    
                        </form>
                      </div>
                     
                    </div>
                  </div>
                </div>
                <!-- Change Cover End --> 
                
   <!-- Change Pic popup -->
                <div id="pop4" class="main-popup">
                  <div class="overlaybox common-overlay"></div>
                  <div id="thirtydays" class="register-form-popup common-overlaycontent"> <a class="close-nav" onclick="popupClose('pop4');" id="pop4" href="javascript:void(0);"></a>
                    <div class="row register-popup-form">
                      <div class="twelve field-pad columns">
                        <form action="/clubs/<?php if($setUser=='ClubBranch'){ echo 'uploadpicbr/';} else{echo 'uploadpic/';}?>" controller="home" enctype="multipart/form-data" class="resform-wrap" id="valid" method="post" accept-charset="utf-8" onsubmit="return validuppic();">
                          <h2>Upload Profile Pic</h2>
                           <input type="file" name="data[Club][logo]" id="ClubLogo" />
                           <?php echo $this->Form->hidden('Club.id',array('value'=>$this->Session->read('USER_ID')));?>
                           <?php echo $this->Form->hidden('Club.old_image',array('value'=>$setSpecalistArr[$utype]['logo']));?>
                          <!--<input type="file" name="" value="" placeholder="upload pic" />-->
                               
                            <div class="row">
                        
                        <div class="twelve already-member columns">
                          <input type="submit" value="Submit" name="" class="submit-nav">
                       </div>   
                      </div>                    
                        </form>
                      </div>
                     
                    </div>
                  </div>
                </div>
                <!-- Change Pic popup End -->   
<!-- Change Password popup -->
                <div id="popchangepass" class="main-popup">
                  <div class="overlaybox common-overlay"></div>
                  <div id="thirtydays" class="register-form-popup common-overlaycontent"> <a class="close-nav" onclick="popupClose('popchangepass');" id="popchangepass" href="javascript:void(0);"></a>
                    <div class="row register-popup-form">
                      <div class="twelve field-pad columns">
					       
                        <form action="/clubs/changepass/" controller="club" enctype="multipart/form-data" class="resform-wrap" id="changepassword" method="post" accept-charset="utf-8" onsubmit="return validateconfirmpass();">
                          <h2>Change Password</h2>
                          
						  <input type="password" class="validate[required,minSize[8]] text-input" placeholder="Old Password" id="oldpassword" value="" name="oldpassword">
						  <?php //echo $this->Form->error('Trainee.password', null, array('class' => 'error')); ?>						  
						  <input type="password" class="validate[required,minSize[8]] text-input" placeholder="New Password" id="newpassword" value="" name="newpassword">
						  
						  <input type="password" class="validate[required,equals[newpassword],minSize[8]]" placeholder="Comfirm Password" id="conpassword" value="" name="conpassword">
						  
						  <input type="hidden" id="originalpassword" value="<?php echo $pas = $this->data[ClubBranch][password]; ?>" name="originalpassword">
						  
						  
                          
                        <div class="row">
                        <div class="twelve already-member columns">
							<input type="submit" value="Submit" name="" class="submit-nav">
                        </div>   
						</div>                    
                        </form>
                      </div>
                     
                    </div>
                  </div>
                </div>
<!-- Change Password popup End --> 	