<?php
echo $this->Html->css(array('jquery-ui',"bootstrap-select",'jquery.fancybox.css?v=2.1.5'));
echo $this->Html->script(array('jquery-migrate-1.2.1.min',"bootstrap-select",'jquery.fancybox.js?v=2.1.5'));
// echo $this->Html->css(array('jquery.fancybox.css?v=2.1.5'));
// echo $this->Html->script(array('jquery.fancybox.js?v=2.1.5'));
?>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" /> 
<style>
	.pjoin_btn{background: none;
    border-radius: 2px;
    color: #ffffff;
    float: right;
    font-size: 21px;
    font-weight: bold;
    margin: 35px 0 0;
    padding: 12px 24px;
    position: absolute;
    top: 51px;
    left: 73%;
}
.btn-link.book-btn {
    color: #fff;
    font-size: 16px;
}
.btn-join{
	background-color: #003ccc;
    border-radius: 4px;
    box-shadow: 0 3px 0 #333333,0 7px 9px rgba(0,0,0,0.35);
    color: #fff;
    display: inline-block;
    float: left;
    font-family: "Pacifico",Arial,sans-serif;
    font-size: 13px;
    font-weight: bold;
    line-height: 1;
    margin: 0 4px 0 0;
        margin-top: 0px;
    padding: 7px 10px;
    text-align: center;
    text-transform: uppercase;
    transition: background-color 0.2s ease-in-out 0s,transform 0.1s ease-in-out 0s;
    margin-top: 5px;
}
</style>
<?php 
if(!$this->Session->check("Auth.User.id"))
{
	echo $this->element('header'); 
	?>
	<div class="Admin_header">
		<div class="container">
			<div class="row">
				<?php echo $this->Html->link($this->Html->image('logo.png',array('class'=>'img-responsive')),array('plugin'=>false,'controller'=>'/'),array('id'=>'logo','escape'=>false)); ?>
				<div class="clearfix"></div>
				</br></br>
				<?php 	$images	=	$this->Html->image('spot_light_members.png',array('class'=>'')); ?>
				<center><?php echo $images ; ?></center>
				</br></br></br>
			</div>
		</div>
	</div>
	<?php
}
else
{
	echo $this->element('profile_header'); ?>
	<div class="Admin_header">
		<div class="container">
			<div class="row">
				<?php echo $this->Html->link($this->Html->image('logo.png',array('class'=>'img-responsive')),array('plugin'=>false,'controller'=>'/'),array('id'=>'logo','escape'=>false)); ?>
				<div class="clearfix"></div>
				<div class="col-md-12">
					<?php echo $this->element('breadcrumb');?>	
					<?php 
					$pageheading	=	'';
					if(!empty($app_user))
					{
						//echo '<pre>'; print_r($app_user); echo '</pre>';
						//pr($app_user);
						if($app_user['Spotlight']['spotlight_type']	==	'Individual')
						{
							$pageheading = 'individualSpotlight.png';
						}
						elseif($app_user['Spotlight']['spotlight_type']	==	'Trainer')
						{
							$pageheading = 'trainerSpotlight.png';
						}
						elseif($app_user['Spotlight']['spotlight_type']	==	'Gymstar')
						{
							$pageheading = 'gymSpotlight.png';
						}
						elseif($app_user['Spotlight']['spotlight_type']	==	'Mogul')
						{
							$pageheading = 'businessSpotlight.png';
						}
						else
						{
							$pageheading = 'businessSpotlight.png';
						}
					} 
					?>
					<center>
	                	<?php echo $this->Html->image("".$pageheading."",array('class'=>'title-img'));?>
	                </center>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>
<?php //echo $this->element('breadcrumb');?>

<style>
#ui-id-1 {
  height: 30px;
  overflow: visible;
}
</style>

<div class="spotlight_content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!--<ul class="nav nav-pills nav-justified">
				  <li  class="active"><a href="#individual" data-toggle="tab">INDIVIDUAL</a></li>
				  <li><a href="#trainer" data-toggle="tab">TRAINER</a></li>
				  <li><a href="#gym" data-toggle="tab">GYM/STUDIO</a></li>
				  <li><a href="#bussiness" data-toggle="tab">BUSSINESS</a></li>
				</ul>-->
				
				<div class="tab-content">
					<div class="tab-pane active" id="individual">					
						<?php
						if($back_page!='')
						{ 
							if($back_page=='flist')
							{
								?>
                            	<a href="<?php echo Router::url('/users/view_users/'.base64_encode($backid).'/fback', true); ?>" class="btn-link back pull-left"><i class="fa fa-chevron-left"></i>Back</a>
                            	<?php 
                        	} 
                        	else 
                    		{ 
                    			?>
                            	<a href="<?php echo Router::url('/users/'.$back_page, true); ?>" class="btn-link back pull-left"><i class="fa fa-chevron-left"></i>Back</a>
                             	<?php 
                         	} 
                     	} 
                     	else 
                     	{
							if ($this->Session->check('back')) 
							{
								$back_link	=	$this->Session->read('back');
								echo $this->Html->link('<i class="fa fa-chevron-left"></i>'.__(' Back'),$back_link ,array('class'=>'btn-link back pull-left','escape'=>false));								
							}
							else
							{
								echo $this->Html->link('<i class="fa fa-chevron-left"></i>'.__(' Back'),array('plugin'=>'','controller'=>'users','action'=>'individual_spotlight_users'),array('class'=>'btn-link back pull-left','escape'=>false));
							}	
						}
					 	?>
						<div class="individuel_profile">
							<h2><?php
								/* 	$string =  $app_user['Spotlight']['name'];
									$pieces = explode(' ', $string);
									if((isset($pieces[0])) && (!empty($pieces[0]))){
										$pieces = array_filter($pieces);
										if(count($pieces) > 1){
											$last_word = array_pop($pieces);
											$firstchar_last_word	=	 substr($last_word, 0, 1);
											//echo $pieces[0].' '.$firstchar_last_word.'.';
											echo "<b>".$pieces[0].' '.$firstchar_last_word.'.' . " </b> <br>";
										}else {
											echo "<b>".$pieces[0] . " </b> <br>";
										
										}
									}	 */
									
								echo "<b>".$app_user['Spotlight']['name']. " </b> <br>";	
								$cname = $app_user['Spotlight']['name'];
									
								if($app_user['Spotlight']['spotlight_type']	!=	'Mogul' && $app_user['Spotlight']['spotlight_type']	!=	'Gymstar')
								{
									echo $app_user['Spotlight']['gender'].", ".$app_user['Spotlight']['age']."<br/>";
								}
								?>
								<span>
									<?php
									if($app_user['Spotlight']['location_us_state'] != '')
										echo $app_user['Spotlight']['location_city'].', '.$app_user['Spotlight']['location_us_state'];
									else
										echo $app_user['Spotlight']['location_city'].', '.$app_user['Spotlight']['location_state'].', '.$app_user['LocationCountry']['name'];
									?>
								</span>
							</h2>
							<?php  
							// pr($app_user);
							if($app_user['Spotlight']['image'] != '')
							{
								if(is_file(SPOTLIGHT_SHOW . $app_user['Spotlight']['image']))
								{
									$images	=	$this->Image->resize(SPOTLIGHT_SHOW . $app_user['Spotlight']['image'], 721, 546, array("alt" => $app_user['Spotlight']['image'], "class" => "admin_ad img-responsive"));	
								}
								else
								{
									$images	= "<center>".$this->Image->resize(NO_IMAGE,200,200,array("alt"=>$app_user['Spotlight']["name"]))."</center>";
								}				
							}
							else 
							{ 
								$images	= "<center>".$this->Image->resize(NO_IMAGE,200,200,array("alt"=>$app_user['Spotlight']["name"]))."</center>";
							}
							echo $images;
							// pr($app_user['Spotlight']);							
							?>
							
							<!--<div class="profile_detail">
								<a href="javascript:void(0);" class="mark_profile"><span><h2>12</h2><h4>Photos</h4></span></a>
								<a href="javascript:void(0);" class="mark_profile"><span><h2>2</h2><h4>Friends</h4></span></a>
								<a href="javascript:void(0);" class="mark_profile"><span><h2>200</h2><h4>Points</h4></span></a>
								<div class="clearfix"></div>
							</div>-->
							<?php
								
								//echo $app_user['Spotlight']['is_connected_sender']."gg".$app_user['Spotlight']['is_connected_receiver'];
							if(!$is_friend) 
							{
		if(($app_user['Spotlight']['spotlight_type'] == 'Individual') || ($app_user['Spotlight']['spotlight_type'] == 'Trainer')){ 
			?>
			<br />
			<center>
				<!--<a href="#" class="blueBtn btn-center"><span>Connect</span></a>-->
				<a href="javascript:void(0);" class="blueBtn btn-center get_connectss" cname="<?php echo $cname;?>"alt="<?php echo $app_user['Spotlight']['appusers_id']; ?>"><span>G-Connect</span></a>
			</center>	
			<?php
			}
							}							
							?>
							<br><br>

							<div class="clearfix"></div>
							<?php 
							/**********************Individual*************************/
							
							if($app_user['Spotlight']['spotlight_type'] == 'Individual')
							{ 
								//pr($app_user);
								?>
								<h3><?php echo __('My Gym'); ?><h5><?php echo $app_user['Spotlight']['gym_name']; ?></h5></h3>
								<h3><?php echo __('Training Preferences'); ?></h3>
								<h5>
									<?php
									$activity_name	=	array();
									if($spotlights['Appuser']['weight_training'] ==  1)
									{ 
										$activity_name[] = 'Free Weight Training';
									}
									
									if($spotlights['Appuser']['pilates'] ==  1)
									{ 
										$activity_name[] = 'Pilates';
									}
									
									if($spotlights['Appuser']['cardio'] ==  1)
									{ 
										$activity_name[] = 'Cardio';
									}
									
									if($spotlights['Appuser']['aerobics'] ==  1)
									{ 
										$activity_name[] = 'Aerobics Classes';
									}
									
									if($spotlights['Appuser']['jogging'] ==  1)
									{ 
										$activity_name[] = 'Jogging';
									}
									
									if($spotlights['Appuser']['martial_arts'] ==  1)
									{ 
										$activity_name[] = 'Martial Arts';
									}
									
									if($spotlights['Appuser']['conditioning'] ==  1)
									{ 
										$activity_name[] = 'Conditioning';
									}
									
									if($spotlights['Appuser']['yoga'] ==  1)
									{ 
										$activity_name[] = 'Yoga';
									}
									
									if($spotlights['Appuser']['cycling'] ==  1)
									{ 
										$activity_name[] = 'Studio Cycling';
									}
									
									if($spotlights['Appuser']['camping'] ==  1)
									{ 
										$activity_name[] = 'Boot Camp';
									}
									
									if($spotlights['Appuser']['swimming'] ==  1)
									{ 
										$activity_name[] = 'Swimming';
									}
									
									if($spotlights['Appuser']['cross_training'] ==  1)
									{ 
										$activity_name[] = 'Cross Training ';
									}
									
									$final_activity	=	implode(',',$activity_name);
									echo $final_activity;
									?>
								</h5>
								<div class="clearfix"></div>		
								<h3><?php echo __('Bio'); ?><h5><?php echo $app_user['Spotlight']['biography'];// echo $spotlights['Appuser']['aboutme']; ?></h5></h3>						
								<h3><?php echo __('Education'); ?><h5><?php echo $app_user['Spotlight']['certifications']; ?></h5></h3>
								<?php 
							} 
							?>
							<!-- Trainer -->
							<?php 	
							if($app_user['Spotlight']['spotlight_type'] == 'Trainer')
							{ 
								// pr($app_user['Spotlight']);
								?>
								<h3><?php echo __('My Gym'); ?></h3>
								<h5><?php echo $app_user['Spotlight']['gym_name']; ?></h5>
								<h3><?php echo __('Bio'); ?></h3>
								<h5><?php echo $app_user['Spotlight']['biography']; ?></h5>
								<div class="clearfix"></div>
								<h3><?php echo __('Training schedule');?>: </h3>	
								<table class="table table-bordered gy_table">
									<tr>
										<td>Sun</td>
										<td><?php if(!empty($app_user['Spotlight']['ophours'])) echo $operationhour[$app_user['Spotlight']['ophours']]; else echo "N/A";?></td>
										<td><?php if(!empty($app_user['Spotlight']['ophoursend'])) echo $operationhour[$app_user['Spotlight']['ophoursend']]; else echo "N/A";?></td>
									</tr>
									<tr>
										<td>Mon</td>
										<td><?php if(!empty($app_user['Spotlight']['ophours2'])) echo $operationhour[$app_user['Spotlight']['ophours2']]; else echo "N/A";?></td>
										<td><?php if(!empty($app_user['Spotlight']['ophoursend2'])) echo $operationhour[$app_user['Spotlight']['ophoursend2']]; else echo "N/A";?></td>
									</tr>
									<tr>
										<td>Tues</td>
										<td><?php if(!empty($app_user['Spotlight']['ophours3'])) echo $operationhour[$app_user['Spotlight']['ophours3']]; else echo "N/A";?></td>
										<td><?php if(!empty($app_user['Spotlight']['ophoursend3'])) echo $operationhour[$app_user['Spotlight']['ophoursend3']]; else echo "N/A";?></td>
									</tr>
									<tr>
										<td>Wed</td>
										<td><?php if(!empty($app_user['Spotlight']['ophours4'])) echo $operationhour[$app_user['Spotlight']['ophours4']]; else echo "N/A";?></td>
										<td><?php if(!empty($app_user['Spotlight']['ophoursend4'])) echo $operationhour[$app_user['Spotlight']['ophoursend4']]; else echo "N/A";?></td>
									</tr>
									<tr>
										<td>Thus</td>
										<td><?php if(!empty($app_user['Spotlight']['ophours5'])) echo $operationhour[$app_user['Spotlight']['ophours5']]; else echo "N/A";?></td>
										<td><?php if(!empty($app_user['Spotlight']['ophoursend5'])) echo $operationhour[$app_user['Spotlight']['ophoursend5']]; else echo "N/A";?></td>
									</tr>
									<tr>
										<td>Fri</td>
										<td><?php if(!empty($app_user['Spotlight']['ophours6'])) echo $operationhour[$app_user['Spotlight']['ophours6']]; else echo "N/A";?></td>
										<td><?php if(!empty($app_user['Spotlight']['ophoursend6'])) echo $operationhour[$app_user['Spotlight']['ophoursend6']]; else echo "N/A";?></td>
									</tr>
									<tr>
										<td>Sat</td>
										<td><?php if(!empty($app_user['Spotlight']['ophours7'])) echo $operationhour[$app_user['Spotlight']['ophours7']]; else echo "N/A";?></td>
										<td><?php if(!empty($app_user['Spotlight']['ophoursend7'])) echo $operationhour[$app_user['Spotlight']['ophoursend7']]; else echo "N/A";?></td>
									</tr>									
								</table>
								<div class="clearfix"></div>
							
								<h3>Personal Training:</h3>
								<h4>Hour Session:</h4>
								<table class="table table-bordered gy_table">
									<tr>
										<th>Hour</th><th>Per/Session rate</th>
									</tr> 
					 				<?php 
					 				if($countFullTraining > 0)
					 				{
										//pr($countFullTraining); 
					 					foreach($countFullTraining as $personalTraining)
			   							{
											?>
											<tr>
				    							<td><?php echo $personalTraining['SpotlightPersonalTraining']["hour"];?></td><td><?php echo "$".$personalTraining['SpotlightPersonalTraining']["rate"];?></td>
			    							</tr>
				  							<?php  
			  							}
			  							
									} 
									else 
									{ 
										echo "<tr><th colspan='2'>No Data Available!</th></tr>";
									}
									?>
								</table>
								
								<h4>Half Hour Session:</h4>
								<table class="table table-bordered gy_table">
									<tr>
										<th>Hour</th><th>Per/Session rate</th>
									</tr> 
					 				<?php 
					 				if($countHalfTraining > 0)
				 					{
				 						foreach($countHalfTraining as $personalTraining)
						   				{
											?>
											<tr>
												<td><?php echo $personalTraining['SpotlightPersonalTraining']["hour"];?></td>
												<td><?php echo "$".$personalTraining['SpotlightPersonalTraining']["rate"];?></td>
											</tr> 
						  					<?php  
					  					}
				  					} 
				  					else 
			  						{ 
			  							echo "<tr><th colspan='2'>No Data Available!</th></tr>";
		  							}
				  					?>
				 				</table>
								
								<h3><?php echo __("Education and Certifications"); ?></h3>
								<h5><?php echo $app_user['Spotlight']['certifications']; ?></h5>
								<h3><?php echo __("Hobbies and Interests "); ?></h3>
								<h5><?php echo $app_user['Spotlight']['hobbies']; ?></h5>
								<?php 
							} 
							?>
							<!-- Business -->
							<?php 	
							if($app_user['Spotlight']['spotlight_type'] == 'Mogul')
							{
								// pr($spotlights['Appuser']);
								// pr($app_user['Spotlight']);							
								?>
								<h3><?php echo __('Business Bio'); ?></h3>
								<h5><?php echo $app_user['Spotlight']['description']; ?></h5>
								<div class="clearfix"></div>
								<h3><?php echo __('Operational Hours');?>: </h3>	

								<table class="table table-bordered gy_table">
									<tr>
										<td>Sun</td>
										<td><?php if(!empty($app_user['Spotlight']['ophours'])) echo $operationhour[$app_user['Spotlight']['ophours']]; else echo "N/A";?></td>
										<td><?php if(!empty($app_user['Spotlight']['ophoursend'])) echo $operationhour[$app_user['Spotlight']['ophoursend']]; else echo "N/A";?></td>
									</tr>
									<tr>
										<td>Mon</td>
										<td><?php if(!empty($app_user['Spotlight']['ophours2'])) echo $operationhour[$app_user['Spotlight']['ophours2']]; else echo "N/A";?></td>
										<td><?php if(!empty($app_user['Spotlight']['ophoursend2'])) echo $operationhour[$app_user['Spotlight']['ophoursend2']]; else echo "N/A";?></td>
									</tr>
									<tr>
										<td>Tues</td>
										<td><?php if(!empty($app_user['Spotlight']['ophours3'])) echo $operationhour[$app_user['Spotlight']['ophours3']]; else echo "N/A";?></td>
										<td><?php if(!empty($app_user['Spotlight']['ophoursend3'])) echo $operationhour[$app_user['Spotlight']['ophoursend3']]; else echo "N/A";?></td>
									</tr>
									<tr>
										<td>Wed</td>
										<td><?php if(!empty($app_user['Spotlight']['ophours4'])) echo $operationhour[$app_user['Spotlight']['ophours4']]; else echo "N/A";?></td>
										<td><?php if(!empty($app_user['Spotlight']['ophoursend4'])) echo $operationhour[$app_user['Spotlight']['ophoursend4']]; else echo "N/A";?></td>
									</tr>
									<tr>
										<td>Thus</td>
										<td><?php if(!empty($app_user['Spotlight']['ophours5'])) echo $operationhour[$app_user['Spotlight']['ophours5']]; else echo "N/A";?></td>
										<td><?php if(!empty($app_user['Spotlight']['ophoursend5'])) echo $operationhour[$app_user['Spotlight']['ophoursend5']]; else echo "N/A";?></td>
									</tr>
									<tr>
										<td>Fri</td>
										<td><?php if(!empty($app_user['Spotlight']['ophours6'])) echo $operationhour[$app_user['Spotlight']['ophours6']]; else echo "N/A";?></td>
										<td><?php if(!empty($app_user['Spotlight']['ophoursend6'])) echo $operationhour[$app_user['Spotlight']['ophoursend6']]; else echo "N/A";?></td>
									</tr>
									<tr>
										<td>Sat</td>
										<td><?php if(!empty($app_user['Spotlight']['ophours7'])) echo $operationhour[$app_user['Spotlight']['ophours7']]; else echo "N/A";?></td>
										<td><?php if(!empty($app_user['Spotlight']['ophoursend7'])) echo $operationhour[$app_user['Spotlight']['ophoursend7']]; else echo "N/A";?></td>
									</tr>									
								</table>
								<div class="clearfix"></div>
								<h3><?php 	echo __("Locations").":"; ?></h3>
								<?php  
								$locations = $app_user['Spotlight']['branches'];
			            		$locationList = explode(",",$locations);
				    			foreach($locationList as $locList)
			    				{ 	
			    					echo $locList."<br>";
		    					}
		    					?> 
								<h3> <?php 	echo __("Meet the Owners");?></h3>
								
								<?php 
								if(!empty($teams))
								{
				 					// pr($teams);
			      					$t = 0;
				     				foreach($teams as $spotlightOwner)
				     				{						
				     					?>
					    				<div class="col-md-6">                        
										   <?php /*
											if($spotlightOwner['Spotlightowner']['owner_image'] != ''){
												if(is_file(SPOTLIGHT_SHOW .$spotlightOwner['Spotlightowner']['owner_image'])){
												// $big_image_url	=	$this->Image->resize(SPOTLIGHT_SHOW . $spotlightOwner['Spotlightowner']['owner_image'], 700, 500, array("alt" => $spotlightOwner['Spotlightowner']['owner_image'], "class" => "admin_ad"));
												
												$big_image_url	=	''; 
												?>
												
												<h5>
													<a id="single_1" href="<?php echo $big_image_url; ?>" title=''>
														<?php echo $this->Image->resize(SPOTLIGHT_SHOW . $spotlightOwner['Spotlightowner']['owner_image'], 400, 300, array("alt" => $spotlightOwner['Spotlightowner']['owner_image'], "class" => "admin_ad")); ?>
													</a>
												</h5>
												<?php 	//echo '<h5>'.$this->Image->resize(SPOTLIGHT_SHOW . $spotlightOwner['Spotlightowner']['owner_image'], 400, 300, array("alt" => $spotlightOwner['Spotlightowner']['owner_image'], "class" => "admin_ad")).'</h5>';	
												}
												?>
											<?php } */?>
											<?php 
											$file_path = SPOTLIGHT_UPLOAD_IMAGE_PATH ;
											$file_name = $spotlightOwner['Spotlightowner']['owner_image'];
											$image_url = $this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',300,225,base64_encode($file_path),$file_name),true);
											$big_image_url		=	$this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',800,600,base64_encode($file_path),$file_name),true);
											
											if(is_file($file_path . $file_name)) 
											{
												// $images = $this->Html->image($image_url,array('alt' => $spotlightOwner['Spotlightowner']['owner_image'],'name' => $spotlightOwner['Spotlightowner']['owner_image'],'height'=>225,'width'=>300));
												$images = $this->Image->resize(SPOTLIGHT_SHOW . $spotlightOwner['Spotlightowner']['owner_image'], 332, 500, array("alt" => $spotlightOwner['Spotlightowner']['owner_image'], "class" => "admin_ad"));
												?>
												<a id="single_1" href="<?php echo $big_image_url; ?>" title='<?php echo ucfirst($spotlightOwner['Spotlightowner']['owner_name']); ?>'>
													<?php echo $images; ?>
												</a>
												<?php	
											}
											else 
											{
												echo $this->Html->image('no_image.jpg',array('width'=>'100px','height'=>'100px'));
											}
											?>
											
											<blockquote><?php echo $spotlightOwner['Spotlightowner']['owner_name'];?></blockquote>
											<a class="btn btn-primary" href="mailto:<?php echo $app_user['Spotlight']['email']; ?>?Subject=Gymatch Contact" target="_top">Email now</a>
													<blockquote><?php echo $spotlightOwner['Spotlightowner']['email'];?></blockquote>
											<h4><?php echo $spotlightOwner['Spotlightowner']['owner_designation'];?></h4>
											<!--<a class="javascript:void(0);">Bio</a>-->
										</div>			      
			       						<?php 
			       						$t++;
								       	if($t%2 == 0)
								       		echo '<div class="clearfix"></div>';
							   		}
				   				}
				   				?>
	                    		<div class="clearfix"></div>  
								<h3><?php 	echo __("Meet The Team"); ?></h3>				
			      				<?php 
			      				if(!empty($teamss))
			      				{
				  					// pr($teamss);
			      					$tt = 0;
				    				foreach($teamss as $spotlightOwner)
				    				{				        
				     					?>  
										<div class="col-md-6"> 
											<?php /*
											if($spotlightOwner['spotlightteams']['team_image'] != ''){
												if(is_file(SPOTLIGHT_SHOW .$spotlightOwner['spotlightteams']['team_image'])){
													echo '<h5>'.$this->Image->resize(SPOTLIGHT_SHOW . $spotlightOwner['spotlightteams']['team_image'], 300, 200, array("alt" => $spotlightOwner['spotlightteams']['team_image'], "class" => "admin_ad")).'</h5>';	
												}
												?>
											<?php } */ ?>
											<?php 
											$file_path		=	SPOTLIGHT_UPLOAD_IMAGE_PATH ;
											$file_name		=	$spotlightOwner['spotlightteams']['team_image'];
											$image_url		=	$this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',300,225,base64_encode($file_path),$file_name),true);
											$big_image_url		=	$this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',800,600,base64_encode($file_path),$file_name),true);
											if(is_file($file_path . $file_name)) 
											{
												// $images = $this->Html->image($image_url,array('alt' => $spotlightOwner['spotlightteams']['team_image'],'name' => $spotlightOwner['spotlightteams']['team_image'],'height'=>225,'width'=>300));
												$images = $this->Image->resize(SPOTLIGHT_SHOW . $spotlightOwner['spotlightteams']['team_image'], 332, 500, array("alt" => $spotlightOwner['spotlightteams']['team_image'], "class" => "admin_ad"));
												?>
												<a id="single_1" href="<?php echo $big_image_url; ?>" title='<?php echo ucfirst($spotlightOwner['spotlightteams']['team_name']); ?>'>
													<?php echo $images; ?>
												</a>
												<?php	
											}
											else 
											{
												echo $this->Html->image('no_image.jpg',array('width'=>'100px','height'=>'100px'));
											}
											?>
											<blockquote><?php echo $spotlightOwner['spotlightteams']['team_name'];?></blockquote>
											<h4><?php echo $spotlightOwner['spotlightteams']['team_designation'];?></h4>
											<p><?php echo $spotlightOwner['spotlightteams']['team_description'];?></p>	  
											<!--<a class="javascript:void(0);">Bio</a>-->
									 	</div>
							       		<?php 
							       		$tt++;
							       		if($tt%2 == 0)
							       			echo '<div class="clearfix"></div>';
						   			}
							   	}
							   	?>
								<div class="clearfix"></div>
								<h3><?php 	echo __("Special Offers & Discounts"); ?></h3>
								<?php  
								$discounts = $app_user['Spotlight']['discounts'];
			            		$discountsList = explode(",",$discounts);
								// pr($discountsList);
				    			foreach($discountsList as $locList)
				    			{
									echo '<div class="col-md-6">';
									if($locList != '')
									{
										if(is_file(SPOTLIGHT_SHOW .$locList))
										{
											echo '<h5>'.$this->Image->resize(SPOTLIGHT_SHOW . $locList, 300, 200, array("alt" => $locList, "class" => "admin_ad")).'</h5>';	
										}
									}
									echo '</div>';
								}
							} 
							?>
							<div class="clearfix"></div>
							
							<!-- GYM/STUDIO -->
							<?php 	//pr($app_user['Spotlight']);
							if($app_user['Spotlight']['spotlight_type'] == 'Gymstar')
							{
								// pr($spotlights['Appuser']);
								// pr($app_user['Spotlight']);							
								?>
								<h3><?php echo __('Gym Bio'); ?></h3>
								<h5><?php echo $app_user['Spotlight']['description']; ?></h5>
								<div class="clearfix"></div>	
								<h3><?php echo __('Club Features');?>:
									<h5>
										<?php  
										// $SpotlightClubFeatures = $SpotlightClubFeature['SpotlightClubFeature']['club_feature_name'];
										// $SpotlightClubFeaturesList = explode(",",$SpotlightClubFeatures);
										foreach($SpotlightClubFeature as $SpotlightClubFeaturesList)
										{
											echo $SpotlightClubFeaturesList."<br>";
										}
										?>
									</h5>
								</h3>
								<div class="clearfix"></div>	
								<h3><?php echo __('Club Locations');?>:
									<h5>
										<?php  
										$locations = $app_user['Spotlight']['branches'];
										$locationList = explode(",",$locations);
										foreach($locationList as $locList)
										{ 	
											echo $locList."<br>";
										}
										?> 
									</h5>
								</h3>
								<h3> <?php 	echo __("Meet The Team"); ?></h3>

								<?php if(!empty($teamss))
								{
				  					// pr($teamss);
				     				foreach($teamss as $spotlightOwner)
				     				{				        
				     					?> 
										<div class="col-md-6"> 
											<?php /*
											if($spotlightOwner['spotlightteams']['team_image'] != ''){
												if(is_file(SPOTLIGHT_SHOW .$spotlightOwner['spotlightteams']['team_image'])){
													echo '<h5>'.$this->Image->resize(SPOTLIGHT_SHOW . $spotlightOwner['spotlightteams']['team_image'], 300, 200, array("alt" => $spotlightOwner['spotlightteams']['team_image'], "class" => "admin_ad")).'</h5>';	
												}
												?>
											<?php } */ ?>
											<?php 
											$file_path		=	SPOTLIGHT_UPLOAD_IMAGE_PATH ;
											$file_name		=	$spotlightOwner['spotlightteams']['team_image'];
											$image_url		=	$this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',500,400,base64_encode($file_path),$file_name),true);
											$big_image_url		=	$this->Html->url(array('plugin'=>'imageresize','controller' => 'imageresize', 'action' => 'get_image',800,600,base64_encode($file_path),$file_name),true);
											if(is_file($file_path . $file_name)) 
											{
												// $images = $this->Html->image($image_url,array('alt' => $spotlightOwner['spotlightteams']['team_image'],'name' => $spotlightOwner['spotlightteams']['team_image'],'height'=>225,'width'=>300));
												$images = $this->Image->resize(SPOTLIGHT_SHOW . $spotlightOwner['spotlightteams']['team_image'], 332, 500, array("alt" => $spotlightOwner['spotlightteams']['team_image'], "class" => "admin_ad"));
												?>
												<a id="single_1" href="<?php echo $big_image_url; ?>" title='<?php echo ucfirst($spotlightOwner['spotlightteams']['team_name']); ?>'>
													<?php echo $images; ?>
												</a>
												<?php	
											}
											else 
											{
												echo $this->Html->image('no_image.jpg',array('width'=>'100px','height'=>'100px'));
											}
											?>
											<blockquote><?php echo $spotlightOwner['spotlightteams']['team_name'];?></blockquote>
											<h4><?php echo $spotlightOwner['spotlightteams']['team_designation'];?></h4>
				                         	<a class="javascript:void(0);">Bio</a>
										   	<p><?php echo substr($spotlightOwner['spotlightteams']['team_description'],0,500);?></p>
									   	</div>
			       						<?php 
		       						}
	       						}
	       						?>
				    			<div class="clearfix"></div>  
								<h3><?php echo __('Club Hours');?>:</h3>	

								<table class="table table-bordered gy_table">
									<tr>
										<td>Sun</td>
										<td><?php if(!empty($app_user['Spotlight']['ophours'])) echo $operationhour[$app_user['Spotlight']['ophours']]; else echo "N/A";?></td>
										<td><?php if(!empty($app_user['Spotlight']['ophoursend'])) echo $operationhour[$app_user['Spotlight']['ophoursend']]; else echo "N/A";?></td>
									</tr>
									<tr>
										<td>Mon</td>
										<td><?php if(!empty($app_user['Spotlight']['ophours2'])) echo $operationhour[$app_user['Spotlight']['ophours2']]; else echo "N/A";?></td>
										<td><?php if(!empty($app_user['Spotlight']['ophoursend2'])) echo $operationhour[$app_user['Spotlight']['ophoursend2']]; else echo "N/A";?></td>
									</tr>
									<tr>
										<td>Tues</td>
										<td><?php if(!empty($app_user['Spotlight']['ophours3'])) echo $operationhour[$app_user['Spotlight']['ophours3']]; else echo "N/A";?></td>
										<td><?php if(!empty($app_user['Spotlight']['ophoursend3'])) echo $operationhour[$app_user['Spotlight']['ophoursend3']]; else echo "N/A";?></td>
									</tr>
									<tr>
										<td>Wed</td>
										<td><?php if(!empty($app_user['Spotlight']['ophours4'])) echo $operationhour[$app_user['Spotlight']['ophours4']]; else echo "N/A";?></td>
										<td><?php if(!empty($app_user['Spotlight']['ophoursend4'])) echo $operationhour[$app_user['Spotlight']['ophoursend4']]; else echo "N/A";?></td>
									</tr>
									<tr>
										<td>Thus</td>
										<td><?php if(!empty($app_user['Spotlight']['ophours5'])) echo $operationhour[$app_user['Spotlight']['ophours5']]; else echo "N/A";?></td>
										<td><?php if(!empty($app_user['Spotlight']['ophoursend5'])) echo $operationhour[$app_user['Spotlight']['ophoursend5']]; else echo "N/A";?></td>
									</tr>
									<tr>
										<td>Fri</td>
										<td><?php if(!empty($app_user['Spotlight']['ophours6'])) echo $operationhour[$app_user['Spotlight']['ophours6']]; else echo "N/A";?></td>
										<td><?php if(!empty($app_user['Spotlight']['ophoursend6'])) echo $operationhour[$app_user['Spotlight']['ophoursend6']]; else echo "N/A";?></td>
									</tr>
									<tr>
										<td>Sat</td>
										<td><?php if(!empty($app_user['Spotlight']['ophours7'])) echo $operationhour[$app_user['Spotlight']['ophours7']]; else echo "N/A";?></td>
										<td><?php if(!empty($app_user['Spotlight']['ophoursend7'])) echo $operationhour[$app_user['Spotlight']['ophoursend7']]; else echo "N/A";?></td>
									</tr>									
								</table>
								<div class="clearfix"></div>
								
								<h3><?php echo __('Gym Benefits');?>:
								<h5><?php  
									// pr($SpotlightGymBenifitsFeature);
									// $SpotlightGymBenifitsFeature = $SpotlightGymBenifitsFeature['SpotlightGymBenifitsFeature']['gym_benifits_name'];
									// $SpotlightbenifitList = explode(",",$SpotlightGymBenifitsFeature);
									foreach($SpotlightGymBenifitsFeature as $SpotlightbenifitList){?>
									<?php echo $SpotlightbenifitList."<br>";?>
				             		<?php }?></h5>
								</h3>
								<div class="clearfix"></div>
					 			<h3><?php 	echo __("Membership & Discounts"); ?></h3>
								<div class="row">
								<?php  
								$discounts = $app_user['Spotlight']['discounts'];
					            $discountsList = explode(",",$discounts);
								// pr($discountsList);
							    foreach($discountsList as $locList)
							    {
									if($locList != '')
									{
										if(is_file(SPOTLIGHT_SHOW .$locList))
										{
											echo '<div class="col-md-6">'.$this->Image->resize(SPOTLIGHT_SHOW . $locList, 300, 200, array("alt" => $locList, "class" => "admin_ad")).'</div>';	
										}
									} 
								}
								
								
								
								?>

					<span class="pjoin_btn" >
											<?php  echo $this->Html->link(__('Join Gym <i class="fa fa-angle-right"></i>'),array('plugin'=>'','controller'=>'users','action'=>'gym_details',base64_encode($app_user['Spotlight']['id'])),array('class'=>'btn-link btn-join','escape'=>false)); ?>
										</span>
								
								
								
								</div>
								<?php
							} 
							?>	
							
							<div class="individuel_profile">
							<h3>Get in Touch</h3>
								<div class="profile_icons">
								<?php 
									// pr($app_user);
									if(isset($app_user['Spotlight']['fblink']) && $app_user['Spotlight']['fblink'] != ''){
										echo $this->Html->link($this->Html->image('fb.png'),$app_user['Spotlight']['fblink'],array('escape' => false,'target'=>'_blank','class'=>'profile_icons'));
									}else{
										echo $this->Html->link($this->Html->image('fb.png'),'javascript:void(0);',array('escape' => false,'class'=>'profile_icons'));
									}
									
									if(isset($app_user['Spotlight']['twitter']) && $app_user['Spotlight']['twitter'] != ''){
										echo $this->Html->link($this->Html->image('twitter.png'),$app_user['Spotlight']['twitter'],array('escape' => false,'target'=>'_blank','class'=>'profile_icons')); 
									}else{
										echo $this->Html->link($this->Html->image('twitter.png'),'javascript:void(0);',array('escape' => false,'class'=>'profile_icons'));
									} 
									
									if(isset($app_user['Spotlight']['instagram']) && $app_user['Spotlight']['instagram'] != ''){
									 echo $this->Html->link($this->Html->image('instagram.png'),$app_user['Spotlight']['instagram'],array('escape' => false,'target'=>'_blank','class'=>'profile_icons')); 
									}else{
										echo $this->Html->link($this->Html->image('instagram.png'),'javascript:void(0);',array('escape' => false,'class'=>'profile_icons'));
									} 
									
									if(isset($app_user['Spotlight']['websitelink']) && $app_user['Spotlight']['websitelink'] != ''){
										echo $this->Html->link($this->Html->image('square.png'),$app_user['Spotlight']['websitelink'],array('escape' => false,'target'=>'_blank','class'=>'profile_icons'));
									}else{
										echo $this->Html->link($this->Html->image('square.png'),'javascript:void(0);',array('escape' => false,'class'=>'profile_icons'));
									}
								?>									
								</div>
								<div class="pull-right">
								<?php echo $this->Html->link($this->Html->image('email.png',array('alt'=>0)),'mailto:'.$app_user['Spotlight']['email'],array('class'=>' ','escape'=>false)); ?>
								<a href="mailto:<?php echo$app_user['Spotlight']['email']; ?>" class="emailme">Email me</a>
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
						<br>
					</div>						
				</div>
					
				<div class="tab-pane" id="trainer">
				</div>
				
				<div class="tab-pane" id="gym">
				</div>
				
				<div class="tab-pane" id="bussiness">
				</div>
			</div>	
		</div>	
	</div>			
</div>	
	

<div id="get_spotlightss" style="display:none;">
	 <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Already a Member ?</p>
</div>
<script>
$(document).ready(function(){	
	$('.spotlights_less').click(function(){
		$('.spotlight_more').toggle();
		$('.spotlights_less').hide();
	});
	
	var Message1	=	'Confirmation';
	var variablesss = <?php echo json_encode($is_login); ?>;
		// alert(variablesss);
	$('.get_connectss').on('click', function(){
		var cat	=	$(this).attr('alt');
		var cname = $(this).attr('cname');
		// alert(cat);
		if( variablesss == "no" ){	
			$( "#get_spotlightss").dialog({
				title: Message1,
				resizable: false,
				modal: true,
				draggable: false,
				show: {
					effect: "fade",
					duration: 1000
				},
				hide: {
					effect: "fade",
					duration: 1000
				},
				width: 500,
				height: 180,
				buttons: {
					"Yes": function() {
						var url1 = "<?php echo $this->Html->url(array('plugin' => '','controller' => 'users','action' => 'login')); ?>";    
						$(location).attr('href',url1);
					},
					"No": function() {
					var url1 = "<?php echo $this->Html->url(array('plugin' => '','controller' => 'users','action' => 'signup')); ?>";    
						$(location).attr('href',url1);
					}
				}
			});
		}
		if(variablesss == "yes"){
			$.ajax({
				url:"<?php echo $this->Html->url(array('plugin'=>'spotlight','controller'=>'spotlights','action'=>'check_login_for_connect_appuser'));?>",
				data:{'id':cat},
				type:'post',
				success:function(subcat_data){
					// alert(subcat_data);
										
					if(subcat_data == 'blocked'){
						alert('Sorry you are blocked by '+cname);
					}

					if(subcat_data == 'yes'){
						alert('Your friend request has been sent successfully.');
					}
					if(subcat_data == 'already'){
						alert('Sorry you have already sent request for '+ cname);
					}
					if(subcat_data == 'no'){
						alert('Some error occured.Please try again later.');
					}
				}
			});
		}			
	});
	
	$("#single_1").fancybox({
          helpers: {
              title : {
                  type : 'float'
              }
          }
      });
	
});
</script>
