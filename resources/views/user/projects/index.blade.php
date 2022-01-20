@extends('layouts.app')
@section('css')
	<!-- Data Table CSS -->
	<link href="{{URL::asset('plugins/datatable/datatables.min.css')}}" rel="stylesheet" />
	<link href="{{URL::asset('plugins/datatable/dataTables.checkboxes.css')}}" rel="stylesheet" />
	<link href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css" rel="stylesheet" />
	<!-- Awselect CSS -->
	<link href="{{URL::asset('plugins/awselect/awselect.min.css')}}" rel="stylesheet" />
	<!-- Green Audio Player CSS -->
	<link href="{{ URL::asset('plugins/audio-player/green-audio-player.css') }}" rel="stylesheet" />
	<!-- FilePond CSS -->
	<link href="{{URL::asset('plugins/filepond/filepond.css')}}" rel="stylesheet" />	
@endsection
@section('page-header')
<!-- PAGE HEADER -->
<div class="page-header mt-5-7">
	<div class="page-leftheader">
		<h4 class="page-title mb-0">{{ __('My Sound Studio') }}</h4>
		<ol class="breadcrumb mb-2">
			<li class="breadcrumb-item"><a href="{{url('/' . $page='#')}}"><i class="mdi mdi-archive mr-2 fs-12"></i>{{ __('User') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page"><a href="{{url('/' . $page='#')}}"> {{ __('My Sound Studio') }}</a></li>
		</ol>
	</div>
</div>
<!-- END PAGE HEADER -->
@endsection
@section('content')	
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="card border-0">	
				<div class="card-header">
					<h3 class="card-title">{{ __('TTS Projects') }}</h3>
				</div>			
				<div class="card-body pt-5">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="row">
								<div class="col-md-7 col-sm-12">
									<div class="form-group" id="tts-project">
										<select id="project" name="project" data-placeholder="{{ __('Select Project Name') }}" data-callback="changeProjectName">	
											<option value="all"> All Projects</option>
											@foreach ($projects as $project)
												<option value="{{ $project->name }}" @if (strtolower(auth()->user()->project) == strtolower($project->name)) selected @endif> {{ ucfirst($project->name) }}</option>
											@endforeach											
										</select>
									</div>
								</div>
								<div class="col-md-3 col-sm-12">
									<div class="dropdown">
										<button class="btn btn-special create-project mr-4" type="button" id="add-project" data-toggle="tooltip" title="Create New Project"><i class="mdi mdi-animation"></i></button>
										<button class="btn btn-special create-project mr-4" type="button" id="default-project" data-toggle="tooltip" title="Set Default Project"><i class="mdi mdi-arrange-bring-to-front"></i></button>
										<button class="btn btn-special create-project" type="button" id="delete-project" data-toggle="tooltip" title="Delete Project"><i class="mdi mdi-delete"></i></button>												
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6 col-sm-12">
							<div class="row">
								<div class="col-md-4 col-sm-12 pt-2">
									<span class="fs-12 font-weight-bold">Total Synthesize Results: <span id="total-results">{{ $data['results']}}</span></span>												
								</div>
								<div class="col-md-4 col-sm-12 pt-2">
									<span class="fs-12 font-weight-bold">Total Characters Used: <span id="total-chars">{{ $data['chars']}}</span></span>												
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		{{-- <div class="col-lg-12 col-md-12 col-sm-12">
			<div class="card border-0">	
				<div class="card-header">
					<h3 class="card-title">{{ __('Sound Studio') }}</h3>
				</div>			
				<div class="card-body pt-5">
					<div class="row">
						<div class="col-md-3 col-sm-12">
							<div class="row">
								<div class="col-md-12 col-sm-12">
									<!-- CONTAINER FOR AUDIO FILE UPLOADS-->
									<div id="upload-container">							
										
										<!-- DRAG & DROP MEDIA FILES -->
										<div class="select-file">
											<input type="file" name="filepond" id="filepond" class="filepond"/>	
										</div>
										@error('filepond')
											<p class="text-danger">{{ $errors->first('filepond') }}</p>
										@enderror	

									</div> <!-- END CONTAINER FOR AUDIO FILE UPLOADS-->
								</div>
								<div class="col-md-12 col-sm-12 text-center">
									<div class="dropdown">
										<span id="processing"><img src="{{ URL::asset('/img/svgs/upload.svg') }}" alt=""></span>		
										<button class="btn btn-special create-project file-buttons pl-5 pr-5 mr-4" type="button" id="upload-music" data-toggle="tooltip" title="Upload Background Audio File">Upload Audio</button>
										<a class="btn btn-special create-project file-buttons pl-5 pr-5 pt-2" href="{{ route('user.music.list') }}" id="list-music" data-toggle="tooltip" title="View Your Uploaded Background Audio Files">My Audio Files</a>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-3 col-sm-12 pr-5">
							<div class="row">
								<div class="col-md-12 col-sm-12">
									<div class="row">
										<div class="col-md-10 pr-0">
											<div class="input-box">	
												<h6 class="task-heading">{{ __('Select Backround Music') }}</h6>
												<select id="bg-music" name="background-music" data-placeholder="Background Music">			
													@foreach ($musics as $music)
														<option value="{{ $music->id }}"> {{ ucfirst($music->name) }}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-md-2 pt-align">
											<div class="dropdown">
												<button class="btn btn-special create-project" type="button" data-toggle="tooltip" title="Play Background Music"><i class="fa fa-play"></i></button>
											</div>
										</div>
									</div>											
								</div>
								<div class="col-md-12 col-sm-12">
									<div class="input-box">	
										<h6 class="task-heading">{{ __('Set Background Music Volume') }}</h6>
										<select id="bg-volume" name="background-volume" data-placeholder="Set Background Music Volume:">			
											@foreach ($musics as $music)
												<option value="{{ $music->id }}"> {{ ucfirst($music->name) }}</option>
											@endforeach
										</select>
									</div>												
								</div>
							</div>
						</div>

						<div class="col-md-3 col-sm-12 pl-5">
							<div class="row">
								<div class="col-md-12 col-sm-12">
									<div class="input-box">	
										<h6 class="task-heading">{{ __('Set Pause Between Audio Files') }}</h6>
										<select id="audio-pause" name="audio-pause" data-placeholder="Set Pause Between Audio Files:">			
											@foreach ($projects as $project)
												<option value="{{ $project->name }}" @if (strtolower(auth()->user()->project) == strtolower($project->name)) selected @endif> {{ ucfirst($project->name) }}</option>
											@endforeach
										</select>
									</div>											
								</div>
								<div class="col-md-12 col-sm-12">
									<div class="input-box">	
										<h6 class="task-heading">{{ __('Set Final Result Volume') }}</h6>
										<select id="audio-volume" name="audio-volume" data-placeholder="Set Final Result Volume:">			
											@foreach ($projects as $project)
												<option value="{{ $project->name }}" @if (strtolower(auth()->user()->project) == strtolower($project->name)) selected @endif> {{ ucfirst($project->name) }}</option>
											@endforeach
										</select>
									</div>												
								</div>
							</div>
						</div>

						<div class="col-md-3 col-sm-12 pl-5">
							<div class="row">
								<div class="col-md-12 col-sm-12">
									<div class="input-box">	
										<h6 class="task-heading">{{ __('Set Result Title') }}</h6>
										<div class="form-group">
											<input type="text" class="form-control @error('title') is-danger @enderror" name="title">
											@error('title')
												<p class="text-danger">{{ $errors->first('title') }}</p>
											@enderror
										</div>
									</div>												
								</div>

								<div class="col-md-12 col-sm-12 text-center">
									<div class="input-box">	
										<h6 class="task-heading">{{ __('Audio File Extensions') }}</h6>
										<div id="audio-format" role="radiogroup">
											<div class="radio-control">
												<input type="radio" name="format" class="input-control" id="mp3" value="mp3" checked>
												<label for="mp3" class="label-control">MP3</label>
											</div>	
											<span  id="merge-ogg">							
												<div class="radio-control">
													<input type="radio" name="format" class="input-control" id="ogg" value="ogg">
													<label for="ogg" class="label-control">OGG</label>
												</div>	
											</span>										
										</div>
									</div>											
								</div>								
							</div>
						</div>
					</div>

					<div class="row mt-3">
						<div class="col-md-12 col-sm-12 text-center">
							<div class="input-box">	
								<button class="btn btn-special create-project file-buttons pl-6 pr-6" type="button" id="merge-button">Merge Audio Files</button>
							</div>												
						</div>
					</div>
				</div>
			</div>
		</div> --}}

		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="card border-0">
				
				<div class="card-body pt-2">
					<!-- SET DATATABLE -->
					<table id='resultsTable' class='table' width='100%'>
							<thead>
								<tr>
									<th width="3%"></th>
									<th width="10%">{{ __('Created On') }}</th> 
									<th width="15%">{{ __('Text Title') }}</th> 
									<th width="10%">{{ __('Language') }}</th>
									<th width="7%">{{ __('Voice') }}</th>
									<th width="7%">{{ __('Gender') }}</th>
									<th width="7%">{{ __('Voice Engine') }}</th>
									<th width="4%"><i class="fa fa-music fs-14"></i></th>							
									<th width="4%"><i class="fa fa-cloud-download fs-14"></i></th>								
									<th width="5%">{{ __('Format') }}</th>	
									<th width="5%">{{ __('Chars') }}</th>								           								    						           	
									<th width="5%">{{ __('Actions') }}</th>
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
					<h4 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-circle-outline color-red"></i> {{ __('Confirm Result Deletion') }}</h4>
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

	<!-- CREATE PROJECT MODAL -->
	<div class="modal fade" id="projectModal" tabindex="-1" role="dialog" aria-labelledby="projectModalLabel" aria-hidden="true" data-keyboard="false">
		<div class="modal-dialog modal-dialog-centered modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header mb-1">
					<h4 class="modal-title" id="myModalLabel"><i class="mdi mdi-animation"></i> {{ __('Create New Project') }}</h4>
					<button type="button" class="close" data-dismiss="modal" id="modal-close" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="create-new-project" action="{{ route('user.project.store') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="modal-body pb-0 pl-6 pr-6">        
						<div class="input-box" id="textarea-box">
							<input type="text" class="form-control" name="new-project" id="new-project" required>
							<label class="input-label">
								<span class="input-label-content custom-content">{{ __('Project Name (Required)') }}</span>
							</label>
						</div>
					</div>
					<div class="modal-footer pr-6 pb-3">
						<button type="button" class="btn btn-cancel mb-4" data-dismiss="modal" id="listen-close">{{ __('Cancel') }}</button>
						<button type="submit" class="btn btn-primary mb-4" id="new-project-button">{{ __('Create') }}</button>
					</div>
				</form>				
			</div>
		</div>
	</div>
	<!-- END CREATE PROJECT MODAL -->

	<!-- SET DEFAULT PROJECT MODAL -->
	<div class="modal fade" id="defaultProjectModal" tabindex="-1" role="dialog" aria-labelledby="projectModalLabel" aria-hidden="true" data-keyboard="false">
		<div class="modal-dialog modal-dialog-centered modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header mb-1">
					<h4 class="modal-title" id="myModalLabel"><i class="mdi mdi-arrange-bring-to-front"></i> {{ __('Select Default Project') }}</h4>
					<button type="button" class="close" data-dismiss="modal" id="modal-close" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="{{ route('user.project.update') }}" method="POST" enctype="multipart/form-data">
					@method('PUT')
					@csrf
					<div class="modal-body pb-0 pl-6 pr-6">        
						<div class="input-box">	
							<select id="set-project" name="project" data-placeholder="Select Default Project:">			
								@foreach ($projects as $project)
									<option value="{{ $project->name }}" @if (strtolower(auth()->user()->project) == strtolower($project->name)) selected @endif> {{ ucfirst($project->name) }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="modal-footer pr-6 pb-3 modal-footer-awselect">
						<button type="button" class="btn btn-cancel mb-4" data-dismiss="modal">{{ __('Cancel') }}</button>
						<button type="submit" class="btn btn-primary mb-4" id="new-project-button">{{ __('Save') }}</button>
					</div>
				</form>				
			</div>
		</div>
	</div>
	<!-- END SET DEFAULT PROJECT MODAL -->

	<!-- Delete PROJECT MODAL -->
	<div class="modal fade" id="deleteProjectModal" tabindex="-1" role="dialog" aria-labelledby="projectModalLabel" aria-hidden="true" data-keyboard="false">
		<div class="modal-dialog modal-dialog-centered modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header mb-1">
					<h4 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-circle-outline color-red"></i> {{ __('Delete Project') }}</h4>
					<button type="button" class="close" data-dismiss="modal" id="modal-close" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="{{ route('user.project.delete') }}" method="POST" enctype="multipart/form-data">
					@method('DELETE')
					@csrf
					<div class="modal-body pb-0 pl-6 pr-6">        
						<div class="input-box">	
							<select id="del-project" name="project" data-placeholder="Select Project to Delete:">			
								@foreach ($projects as $project)
									<option value="{{ $project->name }}" @if (strtolower(auth()->user()->project) == strtolower($project->name)) selected @endif> {{ ucfirst($project->name) }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="modal-footer pr-6 pb-3 modal-footer-awselect">
						<button type="button" class="btn btn-cancel mb-4" data-dismiss="modal">{{ __('Cancel') }}</button>
						<button type="submit" class="btn btn-confirm mb-4" id="new-project-button">{{ __('Delete') }}</button>
					</div>
				</form>				
			</div>
		</div>
	</div>
	<!-- END Delete PROJECT MODAL -->

	<!-- NOTIFICATION MODAL -->
	<div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true" data-keyboard="false">
		<div class="modal-dialog modal-dialog-centered modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-circle color-red"></i> {{ __('Text to Speech Notification') }}</h4>
					<button type="button" class="close" data-dismiss="modal" id="modal-close" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body pb-4 pl-6">        
					<span id="notificationMessage" class="fs-13"></span>
				</div>
				<div class="modal-footer pr-6">
					<button type="button" class="btn btn-cancel mb-5" data-dismiss="modal" id="listen-close">{{ __('Close') }}</button>
				</div>				
			</div>
		</div>
	</div>
	<!-- END NOTIFICATION MODAL -->
@endsection

@section('js')
	<!-- Green Audio Player JS -->
	<script src="{{ URL::asset('plugins/audio-player/green-audio-player.js') }}"></script>
	<script src="{{ URL::asset('js/audio-player.js') }}"></script>
	<!-- Data Tables JS -->
	<script src="{{URL::asset('plugins/datatable/datatables.min.js')}}"></script>
	<script src="{{URL::asset('plugins/datatable/dataTables.checkboxes.min.js')}}"></script>
	<script src='https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js'></script>
	<!-- FilePond JS -->
	<script src={{ URL::asset('plugins/filepond/filepond.min.js') }}></script>
	<script src={{ URL::asset('plugins/filepond/filepond-plugin-file-validate-size.min.js') }}></script>
	<script src={{ URL::asset('plugins/filepond/filepond-plugin-file-validate-type.min.js') }}></script>	
	<script src={{ URL::asset('plugins/filepond/filepond.jquery.js') }}></script>
	<script src="{{URL::asset('js/project-manager.js')}}"></script>
	<!-- Awselect JS -->
	<script src="{{URL::asset('plugins/awselect/awselect.min.js')}}"></script>
	<script src="{{URL::asset('js/awselect.js')}}"></script>
	<script type="text/javascript">
	var table;
		$(function () {

			"use strict";

			$('#add-project').on('click', function() {
				$('#projectModal').modal('show');
			});

			$('#default-project').on('click', function() {
				$('#defaultProjectModal').modal('show');
			});

			$('#delete-project').on('click', function() {
				$('#deleteProjectModal').modal('show');
			});

			function format(d) {
			// `d` is the original data object for the row
			return '<div class="slider">'+
						'<table class="details-table">'+
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
									'<source src="'+ d.result +'" type="audio/mpeg">' +
								'</audio></td>'+
							'</tr>'+
						'</table>'+
					'</div>';
			}

			table = $('#resultsTable').DataTable({
				"lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
				responsive: {
					details: {type: 'column'}
				},
				colReorder: true,		
				language: {
					"emptyTable": "<div><img id='no-results-img' src='{{ URL::asset('img/files/no-result.png') }}'><br>Project does not have any results stored yet</div>",
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
				ajax: "{{ route('user.projects') }}",
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
						data: 'title',
						name: 'title',
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
						data: 'actions',
						name: 'actions',
						orderable: false,
						searchable: false
					},
				]
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

			$('#resultsTable tbody').on('click', 'td.details-control', function () {
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
		});


		// CHANGE PROJECT NAME
		function changeProjectName(value) {
			
			$.get("{{ route('user.projects.change') }}", { group: value}, 
				function(data){
					table = $('#resultsTable').DataTable({
						"lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
						responsive: {
							details: {type: 'column'}
						},
						colReorder: true,
						destroy: true,
						language: {
							"emptyTable": "<div><img id='no-results-img' src='{{ URL::asset('img/files/no-result.png') }}'><br>Project does not have any results stored yet</div>",
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
						data: data['data'],
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
								data: 'title',
								name: 'title',
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
								data: 'actions',
								name: 'actions',
								orderable: false,
								searchable: false
							},
						]	
				});

			}).fail(function(){
				console.log("Error getting datatable results");
			});


			$.get("{{ route('user.projects.change.stats') }}", { project: value}, 
				function(data){
					document.getElementById('total-results').innerHTML = data['results']['total'];
					document.getElementById('total-chars').innerHTML = data['chars']['total'];
			});

		}
	</script>
@endsection