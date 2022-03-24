<x-template>
	@section('style_content')
    	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/pdfViewer/style.css') }}">
    @endsection
	<div class="pagetitle">
	    <h1> {{ __("Staff")}}</h1>
	    <nav>
	        <ol class="breadcrumb">
	            <li class="breadcrumb-item"><a href="">{{ __("Dashboard")}}</a></li>
	            <li class="breadcrumb-item"><a href="{{ route('master.staff.index') }}">{{ __("All Staff")}}</a></li>
	            <li class="breadcrumb-item active">{{ __("Detail")}}</li>
	        </ol>
	    </nav>
	</div>
    
	<section class="section profile">
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body profile-card  pt-4 d-flex flex-column align-items-center">
                        <img src="{{ asset($staff->user->profile_photo_path) }}" alt="Profile" class="">
                        <h2 class="card-title">{{ $staff->user->name }}</h2>
                        <p> 
                        	{{ $staff->position->name }}
                            <small> ({{ $staff->position->department->name }}) </small> 
                        </p>

                        @if ($staff->status =='Active')
                            <span class="badge bg-success"> {{ $staff->status }} </span>
                        @else
                            <span class="badge bg-danger"> {{ $staff->status }} </span>
                        @endif
                    </div>
                </div>

                <div id="pdf-main-container">
                    <div id="pdf-contents">
                        <div id="pdf-meta">
                            <div id="pdf-buttons">
                                <button id="pdf-prev" class="btn btn-sm btn-outline-dark">Previous</button>
                                <button id="pdf-next" class="btn btn-sm btn-outline-dark">Next</button>
                            </div>
                            <div id="page-count-container" class="">Page <div id="pdf-current-page"></div> of <div id="pdf-total-pages"></div></div>
                        </div>
                        <canvas id="pdf-canvas" width="400"></canvas>
                        <div id="page-loader">Loading page ...</div>
                    </div>
                </div>

            </div>

            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#overview">
                                	{{ __("Overview") }}
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#payroll"> 
                                	{{ __("Payroll") }} 
                                </button>
                            </li>
                            @php $role = $staff->user->getRoleNames(); @endphp
                            @if($role[0] == 'Teacher')
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#specificsubject">
                                	{{ __("Specific subject") }}
                                </button>
                            </li>

                            @endif

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#permissions">
                                	{{ __("Permission Access") }}
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#settings">
                                	{{ __("Settings") }}
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show active profile-overview" id="overview">
                                <h5 class="card-title">{{ __("Profile Details") }}</h5>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label "> {{ __("Joining Date") }} </div>
                                    <div class="col-lg-9 col-md-8">{{ date('d. m. Y',strtotime($staff->joindate)) }}</div>
                                </div>

                                @if($staff->status != 'Active')
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label "> {{ __("Leave Date") }} </div>
                                    <div class="col-lg-9 col-md-8">{{ date('d. m. Y',strtotime($staff->leavedate)) }}</div>
                                </div>
                                @endif

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label "> {{ __("Email") }} </div>
                                    <div class="col-lg-9 col-md-8">{{ $staff->workemail }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label "> {{ __("NRC / Passport") }} </div>
                                    <div class="col-lg-9 col-md-8">{{ $staff->nrc }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __("Degree") }}</div>
                                    <div class="col-lg-9 col-md-8">
                                    	@php 
                                    		$degrees = json_decode($staff->degree,true); 
                                    	@endphp
                  			            @foreach($degrees as $degree)
                                    		{{ $loop->first ? '' : ', ' }}
                                            {{$degree}}
                                    	@endforeach
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __("Gender") }}</div>
                                    <div class="col-lg-9 col-md-8">{{ $staff->gender }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __("Country") }}</div>
                                    <div class="col-lg-9 col-md-8">{{ $staff->country->name }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __("Address") }}</div>
                                    <div class="col-lg-9 col-md-8">{{ $staff->address }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __("Phone") }}</div>
                                    <div class="col-lg-9 col-md-8">
                                    	@php 
                                    		$phones = json_decode($staff->phone,true); 
                                    	@endphp
                  			            @foreach($phones as $phone)
                                    		{{ $loop->first ? '' : ', ' }}
                                            {{$phone}}
                                    	@endforeach
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __("Date of Birth") }}</div>
                                    <div class="col-lg-9 col-md-8">{{ date('d M, Y',strtotime($staff->dob)) }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __("Religion") }}</div>
                                    <div class="col-lg-9 col-md-8">{{ $staff->religion->name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __("Blood") }}</div>
                                    <div class="col-lg-9 col-md-8">{{ $staff->blood->name }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __("Login Email") }}</div>
                                    <div class="col-lg-9 col-md-8">{{ $staff->user->email }}</div>
                                </div>
                            </div>
                            <div class="tab-pane fade payroll pt-3" id="payroll">
                                
                            </div>
                            <div class="tab-pane fade pt-3" id="specificsubject">
                                <form name="contactUsForm" id="specificsubjectForm" method="post" action="javascript:void(0)">
                                @csrf
                                    <input type="hidden" name="userid" value="{{ $staff->user->id }}">

                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <div id="specificsubjectAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                    </symbol>
                                                </svg>
                                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                                <div class="d-inline-block" id="specificsubjectErrmsg"></div>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>

                                        	<ul class="list-group scroll-container ">
                                        		@foreach($subjects as $key => $subject)
        	                                    <li class="list-group-item">
        	                                        <input class="form-check-input me-1" type="checkbox" id="subject{{ $key }}" value="{{ $subject->id }}" name="subjects[]" @if($staff->status !='Active') disabled @endif @if(in_array($subject->id, $specificsubjectids)) checked @endif >
        	                                        <label class="form-check-label" for="subject{{ $key }}"> 
        	                                        	<?= $subject->name ?> ( {{ $subject->otherlanguage }} )
        	                                        </label>
        	                                    </li>
        	                                    @endforeach
        	                                </ul>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary @if($staff->status =='Active')  specificsubjectsaveBtn @endif" @if($staff->status !='Active') disabled @endif>{{ __("Update Changes") }}</button>
                                    </div>
                                </form>

                            </div>
                            <div class="tab-pane fade pt-3" id="permissions">
                                <form name="contactUsForm" id="permissionsForm" method="post" action="javascript:void(0)">
                                @csrf
                                    <input type="hidden" name="userid" value="{{ $staff->user->id }}">

                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <div id="permissionsAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                    </symbol>
                                                </svg>
                                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                                <div class="d-inline-block" id="permissionsErrmsg"></div>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>

                                        	<ul class="list-group scroll-container ">
                                        		@foreach($permissions as $key => $permission)
        	                                    <li class="list-group-item">
        	                                        <input class="form-check-input me-1" type="checkbox" id="permission{{ $key }}" value="{{ $permission->id }}" name="permissions[]" @if(in_array($permission->id, $accesspermissionids)) checked @endif @if($staff->status !='Active') disabled @endif>
        	                                        <label class="form-check-label" for="permission{{ $key }}"> 
        	                                        	<?= $permission->name ?>
        	                                        </label>
        	                                    </li>
        	                                    @endforeach
        	                                </ul>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary permissionssaveBtn" @if($staff->status !='Active') disabled @endif>{{ __("Update Changes") }}</button>
                                    </div>
                                </form>

                            </div>

                            <div class="tab-pane fade pt-3" id="settings">
                            	<div class="row">
                                    @if($staff->status =='Active')
                                		<div class="col-6">
                                			<div class="d-grid">
        										<button class="btn btn-outline-danger resignBtn" type="button" data-id="{{ $staff->id }}"> {{ __("Resignation") }} </button>
        									</div>
                                		</div>
                                		<div class="col-6">
                                			<div class="d-grid">
        										<button class="btn btn-outline-danger removeBtn" type="button" data-id="{{ $staff->id }}">
        										{{ __("Remove") }} 
        										</button>
        									</div>
                                		</div>
                                    @else
                                        <div class="d-grid gap-2 col-6 mx-auto">
                                            <button class="btn btn-outline-success restoreBtn" type="button" data-id="{{ $staff->id }}"> {{ __("Restore") }} </button>
                                        </div>
                                    @endif
                            	</div>
                            </div>
                        </div>
                        <!-- End Bordered Tabs -->
                    </div>
                </div>
            </div>
        </div>
    </section>

<div class="modal fade" id="showModal" tabindex="-1" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="container">
                <form class="row g-3" id="Form">
                    <input type="hidden" name="id" id="inputId" value="{{ $staff->id }}">

                    <div class="modal-body">
                        <div class="col-12 mb-3">
                            <label for="inputLeavedate" class="form-label">{{ __("Resignation Date")}}</label>
                            <input type="text" class="form-control" id="inputLeavedate" name="leavedate">

                            <span class="err_leavedate error d-block text-danger"></span>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __("Close")}}</button>
                        <button type="submit" class="btn btn-primary">{{ __("Save Changes")}}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@section('script_content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.2.228/pdf.min.js"></script>
	<script type="text/javascript">
        var currentLanguage = "{{  Config::get('app.locale') }}";

        var url = "{{ asset($staff->file) }}";
    </script>
    <script src="{{ asset('assets/vendor/pdfViewer/viewer.js') }}"></script>

    <script type="text/javascript">

        const leavedate = document.querySelector('input[name="leavedate"]');
        const leavedate_datepicker = new Datepicker(leavedate, {
            autohide: true,
            'format': 'yyyy/mm/dd',
            minDate: new Date(),

        }); 

        $('#specificsubjectAlert').hide();
        $('#permissionsAlert').hide();

        $(document).ready(function() {
            var currentLanguage = "{{  Config::get('app.locale') }}";
            if (currentLanguage == "mm") {
                var n_modal_title = "အသစ်ထည့်ရန်";
                var e_modal_title = "ရှိပြီးသားကို ပြင်ဆင်ရန်";
                var s_success_text = "အချက်အလက်များ အောင်မြင်စွာ သိမ်းဆည်း ပြီးပါပြီ";
                var e_success_text ="အချက်အလက်များကိုအောင်မြင်စွာ ပြင်ဆင် ပြီးပါပြီ";
                var d_confirm_text ="အချက်အလက်များကို စာရင်းမှပယ်ဖျက်မည်!";
                var d_success_text = "အချက်အလက်များကိုအောင်မြင်စွာဖျက်ပစ်လိုက်ပြီ";
                var d_cancel_text = "အချက်အလက်များသည်လုံခြုံစွာရှိနေပါသေးသည်။";
                var confirm_btn_text = "ဟုတ်ကဲ့၊ ဖျက်လိုက်ပါ။";
                var confirm_r_btn_text = "ဟုတ်ကဲ့၊ ပြန်ဖွင့်ပါ။";
                var cancel_btn_text = "မလုပ်တော့ပါ။";
                var r_confirm_text = "ဤအကောင့်ကို ပြန်လည်အသက်သွင်းလိုပါသလား။";
                var r_success_text = "ဤအကောင့်ကို ပြန်လည်အသက်သွင်းထားပြီးပါပြီ။ အကောင့်ဝင်ရန် ယခင်စကားဝှက်ကို အသုံးပြုနိုင်ပါသည်။";
                var r_cancel_text = "ဤအကောင့်ကို ကျွန်ုပ်တို့၏ဒေတာဘေ့စ်တွင် ယခင်အတိုင်း ပိတ်ထားသည်။";

            }
            else if(currentLanguage == "jp"){
                var n_modal_title = "新しく追加する";
                var e_modal_title = "既存の編集";
                var s_success_text = "データが保存されました！";
                var e_success_text = "データが更新されました！";
                var d_confirm_text ="そのデータを削除すると、ネットワークから完全に削除されます。";
                var d_success_text = "データが削除されました！";
                var d_cancel_text = "あなたのデータは私たちのデータベースに保存されました！";
                var confirm_btn_text = "はい、削除してください！";
                var confirm_r_btn_text = "はい、再アクティブ化してください！";
                var cancel_btn_text = "キャンセル";
                var r_confirm_text = "このアカウントを再開しますか？";
                var r_success_text = "このアカウントは再度アクティブ化され、以前のパスワードを使用してログインする準備ができています";
                var r_cancel_text = "このアカウントはまだデータベースにロックされています。";
            }
            else if(currentLanguage == "cn"){
                var n_modal_title =  "添新";
                var e_modal_title =  "编辑现有";
                var s_success_text = "您的数据已保存！";
                var e_success_text = "您的数据已更新！";
                var d_confirm_text ="删除该数据会将其从您的网络中永久删除。";
                var d_success_text = "您的数据已被删除！";
                var d_cancel_text = "您的数据已保存在我们的数据库中！";
                var confirm_btn_text = "是的，删除它！";
                var confirm_r_btn_text = "是的，重新激活！";
                var cancel_btn_text = "取消";
                var r_confirm_text = "您要重新激活此帐户吗？";
                var r_success_text = "此帐户已重新激活，可以使用以前的密码登录";
                var r_cancel_text = "该帐户仍被锁定在我们的数据库中。";
            }
            else if(currentLanguage == "de"){
                var n_modal_title = "Neue hinzufügen";
                var e_modal_title = "Bestehende bearbeiten";
                var s_success_text = "Ihre Daten wurden gespeichert!";
                var e_success_text = "Ihre Daten wurden aktualisiert!";
                var d_confirm_text ="Durch das Löschen dieser Daten werden sie dauerhaft aus Ihrem Netzwerk entfernt.";
                var d_success_text = "Ihre Daten wurden gelöscht!";
                var d_cancel_text = "Ihre Daten wurden in unserer Datenbank gespeichert!";
                var confirm_btn_text = "Ja, löschen!";
                var confirm_r_btn_text = "Ja, reaktivieren!";
                var cancel_btn_text = "Abbrechen";
                var r_confirm_text = "Möchten Sie dieses Konto reaktivieren?";
                var r_success_text = "Dieses Konto wurde reaktiviert und kann das vorherige Passwort zum Anmelden verwenden";
                var r_cancel_text = "Dieses Konto ist noch immer in unserer Datenbank gesperrt.";
            }
            else if(currentLanguage == "fr"){
                var n_modal_title ="Ajouter nouveau";
                var e_modal_title ="Modifier existant";
                var s_success_text = "Vos données ont été enregistrées!";
                var e_success_text = "Vos données ont été mises à jour !";
                var d_confirm_text ="La suppression de ces données les supprimera définitivement de votre réseau.";
                var d_success_text = "Vos données ont été supprimées !";
                var d_cancel_text = "Vos données ont été sauvegardées dans notre base de données !";
                var confirm_btn_text = "Oui, supprimez-le !";
                var confirm_r_btn_text = "Oui, réactivez !";
                var cancel_btn_text = "Annuler";
                var r_confirm_text = "Voulez-vous réactiver ce compte ?";
                var r_success_text = "Ce compte a été réactivé et est prêt à utiliser le mot de passe précédent pour se connecter";
                var r_cancel_text = "Ce compte est toujours verrouillé dans notre base de données.";
                
            }else{
                var n_modal_title ="Add New";
                var e_modal_title ="Edit Existing";
                var s_success_text = "Your data was saved!";
                var e_success_text = "Your data was updated!";
                var d_confirm_text = "Deleting that data will permanently remove it from your network.";
                var d_success_text = "Your data was deleted!";
                var d_cancel_text = "Your data was safed in our database!";
                var confirm_btn_text = "Yes, delete it!";
                var confirm_r_btn_text = "Yes, Reactivate!";
                var cancel_btn_text = "Cancel";
                var r_confirm_text = "Do you want to reactivate this account?";
                var r_success_text = "This account has been reactivated and is ready to use previous password to login";
                var r_cancel_text = "This account is still disabled in our database.";
                
            }
            
            $("#specificsubject").on('submit','#specificsubjectForm',function(e){
                e.preventDefault();
                
                var formData = new FormData(this);

                $.ajax({
                    type:'POST',
                    url: "{{ route('master.storeSubject_byuserid')}}",
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: (data) => {  
                        // jQuery.noConflict();

                        $('#specificsubjectAlert').hide();
                        
                        window.location.reload();

                    },
                    error: function(error){
                        $('#specificsubjectAlert').show();

                        var message=error.responseJSON.message;
                        var err=error.responseJSON.errors;

                        $.each(err, function( key, value ) {
                            console.log(key);

                            if (key == "subjects") 
                            {
                                $('#specificsubjectErrmsg').html(err[key]);
                            }

                        });
                    }
                });
            });

            $("#permissions").on('submit','#permissionsForm',function(e){
                e.preventDefault();
                
                var formData = new FormData(this);

                $.ajax({
                    type:'POST',
                    url: "{{ route('master.storePermission_byuserid')}}",
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: (data) => {  
                        // jQuery.noConflict();

                        $('#permissionsAlert').hide();
                        
                        window.location.reload();

                    },
                    error: function(error){
                        $('#permissionsAlert').show();

                        var message=error.responseJSON.message;
                        var err=error.responseJSON.errors;

                        $.each(err, function( key, value ) {
                            console.log(key);

                            if (key == "permissions") 
                            {
                                $('#permissionsErrmsg').html(err[key]);
                            }

                        });
                    }
                });
            });

            // Confirm ~ Resign
            $('#settings').on('click', '.resignBtn', function () {
              
                Swal.fire({
                text: d_confirm_text,
                icon: "warning",
                showCancelButton:true,
                confirmButtonText: confirm_btn_text,
                cancelButtonText: cancel_btn_text,  
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                dangerMode: true}).then((willDelete)=>{
                    console.log(willDelete);
                    console.log(willDelete.isConfirmed);

                    if (willDelete.isConfirmed != false) 
                    {
                        $("#showModal").modal("show");   
                    }
                    else
                    {
                        Swal.fire({
                            icon: "info",
                            text: d_cancel_text,
                            showConfirmButton: false,
                            timer : 1500
                        });
                        
                    }
                })
            });

            // Remove
            $('#settings').on('click', '.removeBtn', function () {
     
                var id = $(this).data("id");
                
                var url="{{route('master.staff.destroy',':id')}}";
                url=url.replace(':id',id);
              
                Swal.fire({
                text: d_confirm_text,
                icon: "warning",
                showCancelButton:true,
                confirmButtonText: confirm_btn_text,
                cancelButtonText: cancel_btn_text,  
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                dangerMode: true}).then((willDelete)=>{
                    console.log(willDelete);
                    console.log(willDelete.isConfirmed);

                    if (willDelete.isConfirmed != false) 
                    {
                        Swal.fire({
                            icon: "success",
                            text: d_success_text,
                            timer : 1500,
                            showConfirmButton: false
                        }).then(
                            function()
                            {
                                $.ajax({
                                    type: "DELETE",
                                    url: url,
                                    success: function (data) {
                                        window.location = "{{route('master.staff.index')}}";
                                    },
                                    error: function (data) {
                                        console.log('Error:', data);
                                    }
                                });
                            }
                        );
                        
                    }
                    else
                    {
                        Swal.fire({
                            icon: "info",
                            text: d_cancel_text,
                            showConfirmButton: false,
                            timer : 1500
                        });
                        
                    }
                })
            });

            // Resign
            $("#showModal").on('submit','#Form',function(e){
                e.preventDefault();
                
                var formData = new FormData(this);

                var id = $('#inputId').val();
                
                var url="{{route('master.staff.resign',':id')}}";
                url=url.replace(':id',id);

                Swal.fire({
                text: d_confirm_text,
                icon: "warning",
                showCancelButton:true,
                confirmButtonText: confirm_btn_text,
                cancelButtonText: cancel_btn_text,  
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                dangerMode: true}).then((willDelete)=>{
                    console.log(willDelete);
                    console.log(willDelete.isConfirmed);

                    if (willDelete.isConfirmed != false) 
                    {
                        $.ajax({
                            type:'POST',
                            dataType: 'json',
                            url: url,
                            data: formData,
                            cache:false,
                            contentType: false,
                            processData: false,
                            success: (data) => { 
                                Swal.fire({
                                    icon: "success",
                                    text: e_success_text,
                                    showConfirmButton: false,
                                    timer : 1500
                                });

                                $("#showModal").modal("hide");
                                window.location.reload();

                            },
                            error: function(error){
                                $('.err_leavedate').html('');
                                $('#inputLeavedate').removeClass('border border-danger');
                                
                                var message=error.responseJSON.message;
                                var err=error.responseJSON.errors;

                                $.each(err, function( key, value ) {
                                    console.log(key);

                                    if (key == "leavedate") 
                                    {
                                        $('.err_leavedate').html(err[key]);
                                        $('#inputLeavedate').addClass('border border-danger');
                                    }
                                });
                                //console.log(error.responseJSON.errors);
                                
                                
                            }
                        });
                    }
                    else
                    {
                        Swal.fire({
                            icon: "info",
                            text: d_cancel_text,
                            showConfirmButton: false,
                            timer : 1500
                        });
                        
                    }
                })
                

                
            });

            // Restore
            $('#settings').on('click', '.restoreBtn', function () {
     
                var id = $(this).data("id");
                
                var url="{{route('master.staff.restore',':id')}}";
                url=url.replace(':id',id);
              
                Swal.fire({
                text: r_confirm_text,
                icon: "warning",
                showCancelButton:true,
                confirmButtonText: confirm_r_btn_text,
                cancelButtonText: cancel_btn_text,  
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                dangerMode: true}).then((willDelete)=>{
                    console.log(willDelete);
                    console.log(willDelete.isConfirmed);

                    if (willDelete.isConfirmed != false) 
                    {
                        Swal.fire({
                            icon: "success",
                            text: r_success_text,
                            timer : 1500,
                            showConfirmButton: false
                        }).then(
                            function()
                            {
                                $.ajax({
                                    type: "POST",
                                    url: url,
                                    success: function (data) {
                                        window.location.reload();
                                    },
                                    error: function (data) {
                                        console.log('Error:', data);
                                    }
                                });
                            }
                        );
                        
                    }
                    else
                    {
                        Swal.fire({
                            icon: "info",
                            text: r_cancel_text,
                            showConfirmButton: false,
                            timer : 1500
                        });
                        
                    }
                })
            });

        });

        
    </script>

    

@stop

</x-template>

