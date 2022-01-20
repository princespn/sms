
<?php $__env->startSection('css'); ?>
	<!-- Data Table CSS -->
	<link href="<?php echo e(URL::asset('plugins/datatable/datatables.min.css')); ?>" rel="stylesheet" />
	<!-- Awselect CSS -->
	<link href="<?php echo e(URL::asset('plugins/awselect/awselect.min.css')); ?>" rel="stylesheet" />
	<!-- Green Audio Players CSS -->
	<link href="<?php echo e(URL::asset('plugins/audio-player/green-audio-player.css')); ?>" rel="stylesheet" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-header'); ?>
<!-- PAGE HEADER -->
<div class="page-header mt-5-7">
	<div class="page-leftheader">
		<h4 class="page-title mb-0"><?php echo e(__('Synthesize Text')); ?></h4>
		<ol class="breadcrumb mb-2">
			<li class="breadcrumb-item"><a href="<?php echo e(route('user.tts')); ?>"><i class="fa fa-magic mr-2 fs-12"></i><?php echo e(__('User')); ?></a></li>
			<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(url('#')); ?>"> Text-to-Speech</a></li>
		</ol>
	</div>
</div>
<!-- END PAGE HEADER -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-xm-12">
			<div class="card border-0">
				<div class="card-body pt-7 pl-7 pr-7 pb-4" id="tts-body-minify">
				
						<form id="synthesize-text-form" action="<?php echo e(route('user.tts.synthesize')); ?>" listen="<?php echo e(route('user.tts.listen')); ?>" method="POST" enctype="multipart/form-data">
							<?php echo csrf_field(); ?>

							<div class="row">
								<div class="col-md-3 col-sm-12 mb-1">
									<div class="form-group">									
										<select id="languages" name="language" data-placeholder="<?php echo e(__('Pick Your Language')); ?>:" data-callback="language_select">	
											<?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<option value="<?php echo e($language->language_code); ?>" data-img="<?php echo e(URL::asset($language->language_flag)); ?>" <?php if(auth()->user()->language == $language->language_code): ?> selected <?php endif; ?>> <?php echo e($language->language); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>											
										</select>
									</div>
								</div>

								<div class="col-md-3 col-sm-12 mb-1">
									<div class="form-group">									
										<select id="voices" name="voice" data-placeholder="<?php echo e(__('Choose Your Voice')); ?>:" data-callback="voice_select">
											<?php $__currentLoopData = $voices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $voice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<option value="<?php echo e($voice->voice_id); ?>" 
													id="<?php echo e($voice->voice_id); ?>"
													<?php if(config('tts.vendor_logos') == 'show'): ?> data-img="<?php echo e(URL::asset($voice->vendor_img)); ?>" <?php endif; ?>
													data-id="<?php echo e($voice->voice_id); ?>" 
													data-lang="<?php echo e($voice->language_code); ?>" 
													data-type="<?php echo e($voice->voice_type); ?>"
													data-gender="<?php echo e($voice->gender); ?>"	
													data-voice="<?php echo e($voice->voice); ?>"	
													data-url="<?php echo e(URL::asset($voice->sample_url)); ?>"
													<?php if(config('tts.user_neural') == 'disable'): ?>
														data-usage= "<?php if((auth()->user()->group == 'user') && ($voice->voice_type == 'neural')): ?> avoid-clicks <?php endif; ?>"	
													<?php endif; ?>																							
													<?php if(auth()->user()->voice == $voice->voice_id): ?> selected <?php endif; ?>
													data-class="<?php if(auth()->user()->language !== $voice->language_code): ?> remove-voice <?php endif; ?>"> 
													<?php echo e($voice->voice); ?> 														
												</option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>									
										</select>
									</div>
								</div>
							</div>


							<div class="row mb-5">
								<div class="col-md-3 col-sm-12">
									<div id="audio-format" role="radiogroup">
										<div class="radio-control">
											<input type="radio" name="format" class="input-control" id="mp3" value="mp3" checked>
											<label for="mp3" class="label-control">MP3</label>
										</div>	
										<span  id="wav">
											<div class="radio-control">
												<input type="radio" name="format" class="input-control" id="wav" value="wav">
												<label for="wav" class="label-control">WAV</label>
											</div>
										</span>
										<span  id="aws-ogg">							
											<div class="radio-control">
												<input type="radio" name="format" class="input-control" id="ogg_vorbis" value="ogg_vorbis">
												<label for="ogg_vorbis" class="label-control">OGG</label>
											</div>	
										</span>
										<span  id="azure-ogg">							
											<div class="radio-control">
												<input type="radio" name="format" class="input-control" id="ogg" value="ogg">
												<label for="ogg" class="label-control">OGG</label>
											</div>	
										</span>	
										<span  id="azure-webm">							
											<div class="radio-control">
												<input type="radio" name="format" class="input-control" id="webm" value="webm">
												<label for="webm" class="label-control">WEBM</label>
											</div>	
										</span>										
									</div>
								</div>

								<div class="col-md-3 col-sm-12" id="preview-box">
									<button type="button" class="result-play result-play-sm mr-2" onclick="resultPlay(this)" src="" type="audio/mpeg" id="preview"><i class="fa fa-play"></i></button><span class="fs-12 font-weight-bold">Preview <span id="preview-name"></span></span>
								</div>
							</div>


							<div class="row">
								<div class="col-md-3 col-sm-12 mb-2">
									<div class="input-box mb-0" id="textarea-box">
										<input type="text" class="form-control" name="title" id="title">
										<label class="input-label">
											<span class="input-label-content input-label-main"><?php echo e(__('Text Title (Optional)')); ?></span>
										</label>
									</div>
								</div>
								<div class="col-md-3 col-sm-12 mb-2">
									<div class="row">
										<div class="col-md-10 col-sm-10 pr-0" id="project-box">
											<div class="form-group">
												<select id="project" name="project" data-placeholder="<?php echo e(__('Select Project Name')); ?>">	
													<option value="all"> All Projects</option>
													<?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<option value="<?php echo e($project->name); ?>" <?php if(strtolower(auth()->user()->project) == strtolower($project->name)): ?> selected <?php endif; ?>> <?php echo e(ucfirst($project->name)); ?></option>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>											
												</select>
											</div>
										</div>
										<div class="col-md-2 col-sm-2" id="add-project-box">
											<div class="dropdown">
												<button class="btn btn-special create-project" type="button" id="add-project" data-toggle="tooltip" title="Create New Project"><i class="mdi mdi-animation"></i></button>											
											</div>
										</div>
									</div>
								</div>
							</div>


							<?php if(config('tts.ssml_effect') == 'enable'): ?>
								<div class="row mb-6">
									<div class="col-md-12 col-sm-12 d-flex" id="special-buttons">
										<div class="dropdown">
											<button class="btn btn-special dropdown-toggle" style="display: none" type="button" id="speakingStyle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<?php echo e(__('Speaking Style')); ?>

											</button>
											<div class="dropdown-menu" aria-labelledby="speakingStyle">
												<button style="display: none" class="dropdown-item" type="button" id="newscast-formal">Newscaster Formal</button>
												<button style="display: none" class="dropdown-item" type="button" id="newscast-casual">Newscast Casual</button>
												<button style="display: none" class="dropdown-item" type="button" id="narration-professional">Narration Professional</button>
												<button style="display: none" class="dropdown-item" type="button" id="customerservice">Customer Service</button>
												<button style="display: none" class="dropdown-item" type="button" id="chat">Chat</button>
												<button style="display: none" class="dropdown-item" type="button" id="cheerful">Cheerful</button>
												<button style="display: none" class="dropdown-item" type="button" id="empathetic">Empathetic</button>
												<button style="display: none" class="dropdown-item" type="button" id="assistant">Assistant</button>
												<button style="display: none" class="dropdown-item" type="button" id="newscast">Newscast</button>
												<button style="display: none" class="dropdown-item" type="button" id="calm">Calm</button>
												<button style="display: none" class="dropdown-item" type="button" id="sad">Sad</button>
												<button style="display: none" class="dropdown-item" type="button" id="angry">Angry</button>
												<button style="display: none" class="dropdown-item" type="button" id="fearful">Fearful</button>
												<button style="display: none" class="dropdown-item" type="button" id="disgruntled">Disgruntled</button>
												<button style="display: none" class="dropdown-item" type="button" id="serious">Serious</button>
												<button style="display: none" class="dropdown-item" type="button" id="depressed">Depressed</button>
												<button style="display: none" class="dropdown-item" type="button" id="embarrassed">Embarrassed</button>
												<button style="display: none" class="dropdown-item" type="button" id="affectionate">Affectionate</button>
												<button style="display: none" class="dropdown-item" type="button" id="gentle">Gentle</button>
												<button style="display: none" class="dropdown-item" type="button" id="lyrical">Lyrical</button>
											</div>
										</div>

										<div class="dropdown">
											<button class="btn btn-special dropdown-toggle" type="button" id="voiceEffects" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<?php echo e(__('Voice Effects')); ?>

											</button>
											<div class="dropdown-menu" aria-labelledby="voiceEffects">
												<button class="dropdown-item" type="button" id="soft_effect">Speak Softly</button>
												<button class="dropdown-item" type="button" id="breathing_effect">Sound of Breathing</button>
												<button class="dropdown-item" type="button" id="whispered_effect">Whispered</button>
												<button class="dropdown-item" type="button" id="drc_effect">DRC Effect</button>
												<button style="display: none" class="dropdown-item" type="button" id="conversational_effect">Conversational</button>
												<button style="display: none" class="dropdown-item" type="button" id="newscaster_effect">Newscaster</button>
											</div>
										</div>

										<div class="dropdown">
											<button class="btn btn-special dropdown-toggle" type="button" id="sayAs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<?php echo e(__('Say as')); ?>

											</button>
											<div class="dropdown-menu" aria-labelledby="sayAs">
												<button class="dropdown-item" type="button" id="characters_sayas">Characters</button>
												<button style="display: none" class="dropdown-item" type="button" id="verbatim_sayas">Verbatim</button>
												<button style="display: none" class="dropdown-item" type="button" id="bleep_sayas">Bleep</button>
												<button class="dropdown-item" type="button" id="cardinal_sayas">Cardinal</button>
												<button class="dropdown-item" type="button" id="ordinal_sayas">Ordinal</button>
												<button class="dropdown-item" type="button" id="digits_sayas">Digits</button>
												<button class="dropdown-item" type="button" id="fraction_sayas">Fraction</button>
												<button class="dropdown-item" type="button" id="unit_sayas">Unit</button>
												<button class="dropdown-item" type="button" id="time_sayas">Time</button>
												<button style="display: none" class="dropdown-item" type="button" id="gcp_time_sayas">Time</button>
												<button class="dropdown-item" type="button" id="address_sayas">Address</button>
												<button class="dropdown-item" type="button" id="expletive_sayas">Beep Out</button>
												<button style="display: none" class="dropdown-item" type="button" id="telephone_sayas">Telephone</button>
											</div>
										</div>

										<div class="dropdown">
											<button class="btn btn-special dropdown-toggle" type="button" id="emphasis" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<?php echo e(__('Emphasis')); ?>

											</button>
											<div class="dropdown-menu" aria-labelledby="emphasis">
												<button class="dropdown-item" type="button" id="reduced_emphasis">Reduced</button>
												<button class="dropdown-item" type="button" id="moderate_emphasis">Moderate</button>
												<button class="dropdown-item" type="button" id="strong_emphasis">Strong</button>
											</div>
										</div>

										<div class="dropdown">
											<button class="btn btn-special dropdown-toggle" type="button" id="volume" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<?php echo e(__('Volume')); ?>

											</button>
											<div class="dropdown-menu" aria-labelledby="volume">
												<button class="dropdown-item" type="button" id="silent_volume">Silent</button>
												<button class="dropdown-item" type="button" id="x_soft_volume">x-Soft</button>
												<button class="dropdown-item" type="button" id="soft_volume">Soft</button>
												<button class="dropdown-item" type="button" id="medium_volume">Medium</button>
												<button class="dropdown-item" type="button" id="loud_volume">Loud</button>
												<button class="dropdown-item" type="button" id="x_loud_volume">x-Loud</button>
											</div>
										</div>

										<div class="dropdown">
											<button class="btn btn-special dropdown-toggle" type="button" id="speed" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<?php echo e(__('Speed')); ?>

											</button>
												<div class="dropdown-menu" aria-labelledby="speed">
												<button class="dropdown-item" type="button" id="x_slow_speed">x-Slow</button>
												<button class="dropdown-item" type="button" id="slow_speed">Slow</button>
												<button class="dropdown-item" type="button" id="medium_speed">Medium</button>
												<button class="dropdown-item" type="button" id="fast_speed">Fast</button>
												<button class="dropdown-item" type="button" id="x_fast_speed">x-Fast</button>
											</div>
										</div>

										<div class="dropdown">
											<button class="btn btn-special dropdown-toggle" type="button" id="pitch" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<?php echo e(__('Pitch')); ?>

											</button>
												<div class="dropdown-menu" aria-labelledby="pitch">
												<button class="dropdown-item" type="button" id="x_low_pitch">x-Low</button>
												<button class="dropdown-item" type="button" id="low_pitch">Low</button>
												<button class="dropdown-item" type="button" id="medium_pitch">Medium</button>
												<button class="dropdown-item" type="button" id="high_pitch">High</button>
												<button class="dropdown-item" type="button" id="x_high_pitch">x-High</button>
											</div>
										</div>

										<div class="dropdown">
											<button class="btn btn-special dropdown-toggle" type="button" id="pause" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<?php echo e(__('Pauses')); ?>

											</button>
											<div class="dropdown-menu" aria-labelledby="pause">
												<button class="dropdown-item" type="button" id="zero_pause">0 second</button>
												<button class="dropdown-item" type="button" id="one_pause">1 second</button>
												<button class="dropdown-item" type="button" id="two_pause">2 seconds</button>
												<button class="dropdown-item" type="button" id="three_pause">3 seconds</button>
												<button class="dropdown-item" type="button" id="four_pause">4 seconds</button>
												<button class="dropdown-item" type="button" id="five_pause">5 seconds</button>
												<button class="dropdown-item" type="button" id="six_pause">6 seconds</button>
												<button class="dropdown-item" type="button" id="seven_pause">7 seconds</button>
												<button class="dropdown-item" type="button" id="eight_pause">8 seconds</button>
												<button class="dropdown-item" type="button" id="nine_pause">9 seconds</button>
												<button class="dropdown-item" type="button" id="ten_pause">10 seconds</button>
												<button class="dropdown-item" type="button" id="paragraph_pause">Paragraph</button>
												<button class="dropdown-item" type="button" id="sentence_pause">Sentence</button>
											</div>
										</div>

										<div class="dropdown">
											<button class="btn btn-special dropdown-toggle" style="display: none" type="button" id="azurePause" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<?php echo e(__('Pauses')); ?>

											</button>
											<div class="dropdown-menu" aria-labelledby="azurePause">
												<button class="dropdown-item" type="button" id="azure_zero_pause">0 second</button>
												<button class="dropdown-item" type="button" id="azure_one_pause">1 second</button>
												<button class="dropdown-item" type="button" id="azure_two_pause">2 seconds</button>
												<button class="dropdown-item" type="button" id="azure_three_pause">3 seconds</button>
												<button class="dropdown-item" type="button" id="azure_four_pause">4 seconds</button>
												<button class="dropdown-item" type="button" id="azure_five_pause">5 seconds</button>
												<button class="dropdown-item" type="button" id="azure_paragraph_pause">Paragraph</button>
												<button class="dropdown-item" type="button" id="azure_sentence_pause">Sentence</button>
											</div>
										</div>

										<div class="dropdown">
											<button class="btn btn-special" style="display: none" type="button" id="sub"><?php echo e(__('Replace')); ?></button>											
										</div>
									</div>
								</div>
							<?php endif; ?>							


							<div class="row">
								<div class="col-md-12">
									<div class="input-box mb-0" id="textarea-box">
										<textarea class="form-control" name="textarea" id="textarea" rows="15" placeholder="<?php echo e(__('Select your Language and Voice')); ?>... <?php echo e(__('Enter your text here to synthesize')); ?>... <?php echo e(__('to add effects, select part of your text and click on desired effect')); ?>..." required></textarea>
										<label class="input-label">
											<span class="input-label-content input-label-main">Text to Speech</span>
										</label>
									</div>								
										
									<p class="jQTAreaExt"></p>

									<div id="textarea-settings">								
										<div class="character-counter">
											<span><em class="jQTAreaCount"></em>/<em class="jQTAreaValue"></em> <?php echo e(__('characters used')); ?></span>
										</div>

										<div class="clear-button">
											<button type="button" id="clear-text"><?php echo e(__('Clear Text')); ?></button>
										</div>
									</div>
								</div>
							</div>						

							<div class="card-footer border-0 text-center mb-2">
								<span id="processing"><img src="<?php echo e(URL::asset('/img/svgs/processing.svg')); ?>" alt=""></span>
								<button type="button" class="btn btn-primary main-action-button mr-2" id="listen-text"><?php echo e(__('Listen')); ?></button>
								<button type="submit" class="btn btn-primary main-action-button" id="synthesize-text"><?php echo e(__('Synthesize')); ?></button>								
							</div>							

						</form>
					
				</div>
			</div>
		</div>
	</div>

	<div class="row mt-4" id="results-header">
		<div class="col-lg-12 col-md-12 col-xm-12">
			<div class="card border-0">
				<div class="card-header">
					<h3 class="card-title"><?php echo e(__('Synthesized Text Results')); ?> <span class="text-muted">(<?php echo e(__('Current Day')); ?>)</span></h3>
				</div>
				<div class="card-body pt-2">
					<!-- SET DATATABLE -->
					<table id='resultTable' class='table' width='100%'>
							<thead>
								<tr>
									<th width="3%"></th>
									<th width="10%"><?php echo e(__('Created On')); ?></th> 
									<?php if(config('tts.vendor_logos') == 'show'): ?> <th width="5%"><?php echo e(__('Vendor')); ?></th> <?php endif; ?>
									<th width="8%"><?php echo e(__('Language')); ?></th>
									<th width="7%"><?php echo e(__('Voice')); ?></th>
									<th width="7%"><?php echo e(__('Gender')); ?></th>
									<th width="9%"><?php echo e(__('Voice Engine')); ?></th>		
									<th width="4%"><i class="fa fa-music fs-14"></i></th>							
									<th width="4%"><i class="fa fa-cloud-download fs-14"></i></th>								
									<th width="5%"><?php echo e(__('Format')); ?></th>																	           	
									<th width="5%"><?php echo e(__('Chars')); ?></th>																	           	
									<th width="9%"><?php echo e(__('Project Name')); ?></th>     						           	
									<th width="5%"><?php echo e(__('Actions')); ?></th>
								</tr>
							</thead>
					</table> <!-- END SET DATATABLE -->
				</div>
			</div>
		</div>
	</div>

	<!-- MODAL -->
	<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-circle-outline color-red"></i> <?php echo e(__('Confirm Result Deletion')); ?></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" id="deleteModalBody">
					<div>
						<!-- DELETE CONFIRMATION -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END MODAL -->

	<!-- LISTEN MODAL -->
	<div class="modal fade" id="listenModal" tabindex="-1" role="dialog" aria-labelledby="listenModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog modal-dialog-centered modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-music"></i> <?php echo e(__('Listen Synthesized Text')); ?></h4>
					<button type="button" class="close" data-dismiss="modal" id="modal-close" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" id="listen-result-player">        
					<div class="text-center listen-result-player">
						<audio class="voice-audio" id="listen-result" autoplay>
							<source id="listen-source">
						</audio>	
					</div>    
				</div>
				<div class="modal-footer pr-0">
					<button type="button" class="btn btn-primary mb-4" data-dismiss="modal" id="listen-close"><?php echo e(__('Close')); ?></button>
				</div>				
			</div>
		</div>
	</div>
	<!-- END LISTEN MODAL -->

	<!-- NOTIFICATION MODAL -->
	<div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true" data-keyboard="false">
		<div class="modal-dialog modal-dialog-centered modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-circle color-red"></i> <?php echo e(__('Text-to-Speech Notification')); ?></h4>
					<button type="button" class="close" data-dismiss="modal" id="modal-close" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body pb-4 pl-6">        
					<span id="notificationMessage" class="fs-13"></span>
				</div>
				<div class="modal-footer pr-6">
					<button type="button" class="btn btn-cancel mb-5" data-dismiss="modal" id="listen-close"><?php echo e(__('Close')); ?></button>
				</div>				
			</div>
		</div>
	</div>
	<!-- END NOTIFICATION MODAL -->

	<!-- CREATE PROJECT MODAL -->
	<div class="modal fade" id="projectModal" tabindex="-1" role="dialog" aria-labelledby="projectModalLabel" aria-hidden="true" data-keyboard="false">
		<div class="modal-dialog modal-dialog-centered modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header mb-1">
					<h4 class="modal-title" id="myModalLabel"><i class="mdi mdi-animation"></i> <?php echo e(__('Create New Project')); ?></h4>
					<button type="button" class="close" data-dismiss="modal" id="modal-close" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="create-new-project" action="<?php echo e(route('user.project.store')); ?>" method="POST" enctype="multipart/form-data">
					<?php echo csrf_field(); ?>
					<div class="modal-body pb-0 pl-6 pr-6">        
						<div class="input-box" id="textarea-box">
							<input type="text" class="form-control" name="new-project" id="new-project" required>
							<label class="input-label">
								<span class="input-label-content custom-content"><?php echo e(__('Project Name (Required)')); ?></span>
							</label>
						</div>
					</div>
					<div class="modal-footer pr-6 pb-3">
						<button type="button" class="btn btn-cancel mb-4" data-dismiss="modal" id="listen-close"><?php echo e(__('Cancel')); ?></button>
						<button type="submit" class="btn btn-primary mb-4" id="new-project-button"><?php echo e(__('Create')); ?></button>
					</div>
				</form>				
			</div>
		</div>
	</div>
	<!-- END CREATE PROJECT MODAL -->

</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
	<!-- Green Audio Players JS -->
	<script src="<?php echo e(URL::asset('plugins/audio-player/green-audio-player.js')); ?>"></script>
	<script src="<?php echo e(URL::asset('js/audio-player.js')); ?>"></script>
	<!-- Data Tables JS -->
	<script src="<?php echo e(URL::asset('plugins/datatable/datatables.min.js')); ?>"></script>
	<!-- Awselect JS -->
	<script src="<?php echo e(URL::asset('plugins/jqtarea/plugin-jqtarea.min.js')); ?>"></script>
	<script src="<?php echo e(URL::asset('plugins/awselect/awselect-custom.js')); ?>"></script>
	<script src="<?php echo e(URL::asset('js/dashboard.js')); ?>"></script>
	<script src="<?php echo e(URL::asset('js/awselect.js')); ?>"></script>
	<script type="text/javascript">
		$(function () {

			"use strict";

			$('#add-project').on('click', function() {
				$('#projectModal').modal('show');
			});
			
			function format(d) {
				// `d` is the original data object for the row
				return '<div class="slider">'+
							'<table class="details-table">'+
								'<tr>'+
									'<td class="details-title" width="10%">Title:</td>'+
									'<td>'+ ((d.title == null) ? '' : d.title) +'</td>'+
								'</tr>'+
								'<tr>'+
									'<td class="details-title" width="10%">Text Clean:</td>'+
									'<td>'+ d.text +'</td>'+
								'</tr>'+
								'<tr>'+
									'<td class="details-title" width="10%">Text Raw:</td>'+
									'<td>'+ d.text_raw +'</td>'+
								'</tr>'+
								'<tr>'+
									'<td class="details-result" width="10%">Synthesized Result:</td>'+
									'<td><audio controls preload="none">' +
										'<source src="'+ d.result +'" type="'+ d.audio_type +'">' +
									'</audio></td>'+
								'</tr>'+
							'</table>'+
						'</div>';
			}

			// INITILIZE DATATABLE
			var vendor_logo = JSON.parse(`<?php echo $vendor_logo['status']; ?>`);

			if ( vendor_logo == 'show') {
				var table = $('#resultTable').DataTable({
					"lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
					responsive: {
						details: {type: 'column'}
					},
					colReorder: true,
					language: {
						"emptyTable": "<div><img id='no-results-img' src='<?php echo e(URL::asset('img/files/no-result.png')); ?>'><br>No synthesized text results yet</div>",
						search: "<i class='fa fa-search search-icon'></i>",
						lengthMenu: '_MENU_ ',
						paginate : {
							first    : '<i class="fa fa-angle-double-left"></i>',
							last     : '<i class="fa fa-angle-double-right"></i>',
							previous : '<i class="fa fa-angle-left"></i>',
							next     : '<i class="fa fa-angle-right"></i>'
						}
					},
					pagingType : 'full_numbers',
					processing: true,
					serverSide: true,
					ajax: "<?php echo e(route('user.tts')); ?>",
					columns: [{
							"className":      'details-control',
							"orderable":      false,
							"searchable":     false,
							"data":           null,
							"defaultContent": ''
						},
						{
							data: 'created-on',
							name: 'created-on',
							orderable: true,
							searchable: true
						},						
						{
							data: 'vendor',
							name: 'vendor',
							orderable: true,
							searchable: true
						},												
						{
							data: 'language',
							name: 'language',
							orderable: true,
							searchable: true
						},
						{
							data: 'voice',
							name: 'voice',
							orderable: true,
							searchable: true
						},
						{
							data: 'gender',
							name: 'gender',
							orderable: true,
							searchable: true
						},
						{
							data: 'custom-voice-type',
							name: 'custom-voice-type',
							orderable: true,
							searchable: true
						},	
						{
							data: 'single',
							name: 'single',
							orderable: true,
							searchable: true
						},				
						{
							data: 'download',
							name: 'download',
							orderable: true,
							searchable: true
						},
						{
							data: 'result_ext',
							name: 'result_ext',
							orderable: true,
							searchable: true
						},
						{
							data: 'characters',
							name: 'characters',
							orderable: true,
							searchable: true
						},	
						{
							data: 'project',
							name: 'project',
							orderable: true,
							searchable: true
						},				
						{
							data: 'actions',
							name: 'actions',
							orderable: false,
							searchable: false
						},
					]
				});
							
			} else {
				var table = $('#resultTable').DataTable({
					"lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
					responsive: {
						details: {type: 'column'}
					},
					colReorder: true,
					language: {
						"emptyTable": "<div><img id='no-results-img' src='<?php echo e(URL::asset('img/files/no-result.png')); ?>'><br>No synthesized text results yet</div>",
						search: "<i class='fa fa-search search-icon'></i>",
						lengthMenu: '_MENU_ ',
						paginate : {
							first    : '<i class="fa fa-angle-double-left"></i>',
							last     : '<i class="fa fa-angle-double-right"></i>',
							previous : '<i class="fa fa-angle-left"></i>',
							next     : '<i class="fa fa-angle-right"></i>'
						}
					},
					pagingType : 'full_numbers',
					processing: true,
					serverSide: true,
					ajax: "<?php echo e(route('user.tts')); ?>",
					columns: [{
							"className":      'details-control',
							"orderable":      false,
							"searchable":     false,
							"data":           null,
							"defaultContent": ''
						},
						{
							data: 'created-on',
							name: 'created-on',
							orderable: true,
							searchable: true
						},																		
						{
							data: 'language',
							name: 'language',
							orderable: true,
							searchable: true
						},
						{
							data: 'voice',
							name: 'voice',
							orderable: true,
							searchable: true
						},
						{
							data: 'gender',
							name: 'gender',
							orderable: true,
							searchable: true
						},
						{
							data: 'custom-voice-type',
							name: 'custom-voice-type',
							orderable: true,
							searchable: true
						},		
						{
							data: 'single',
							name: 'single',
							orderable: true,
							searchable: true
						},				
						{
							data: 'download',
							name: 'download',
							orderable: true,
							searchable: true
						},	
						{
							data: 'result_ext',
							name: 'result_ext',
							orderable: true,
							searchable: true
						},		
						{
							data: 'characters',
							name: 'characters',
							orderable: true,
							searchable: true
						},	
						{
							data: 'project',
							name: 'project',
							orderable: true,
							searchable: true
						},				
						{
							data: 'actions',
							name: 'actions',
							orderable: false,
							searchable: false
						},
					]
				});
			}


			$('#resultTable tbody').on('click', 'td.details-control', function () {
				var tr = $(this).closest('tr');
				var row = table.row( tr );
		
				if ( row.child.isShown() ) {
					// This row is already open - close it
					$('div.slider', row.child()).slideUp( function () {
						row.child.hide();
						tr.removeClass('shown');
					} );
				}
				else {
					// Open this row
					row.child( format(row.data()), 'no-padding' ).show();
					tr.addClass('shown');
		
					$('div.slider', row.child()).slideDown();
				}
			});

			
			// DELETE CONFIRMATION MODAL
			$(document).on('click', '#deleteResultButton', function(event) {
				event.preventDefault();
				let href = $(this).attr('href');
				$.ajax({
					url: href
					, beforeSend: function() {
						$('#loader').show();
					},
					// return the result
					success: function(result) {
						$('#deleteModal').modal("show");
						$('#deleteModalBody').html(result).show();
					}
					, error: function(jqXHR, testStatus, error) {
						console.log(error);
						alert("Page " + href + " cannot open. Error:" + error);
						$('#loader').hide();
					}
					, timeout: 8000
				})
			});

			$(document).ready(function(){
				$("#textarea").jQTArea({
					setLimit: <?php echo e($max_chars); ?>,
					setExt: "W",
					setExtR: true 
				});

			});			

		});		
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/661037.cloudwaysapps.com/fuxkpjgyyd/public_html/resources/views/user/tts/index.blade.php ENDPATH**/ ?>