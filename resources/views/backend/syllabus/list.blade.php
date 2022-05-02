<x-template>
	@php
        $authuser = Auth::user();
        $hashids = new Hashids\Hashids('', 10);
        $authRole = Auth::user()->getRoleNames()[0];
    @endphp

	<div class="pagetitle">
	    <h1> {{ __("Syllabus")}}</h1>
	    <nav>
	        <ol class="breadcrumb">
	            <li class="breadcrumb-item"><a href="">{{ __("Dashboard")}}</a></li>
	            <li class="breadcrumb-item active">{{ __("All Syllabi")}}</li>
	        </ol>
	    </nav>
	</div>

	@if(session('successupdatemsg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
				    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
				</symbol>
            </svg>
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            {{ session('successupdatemsg') }}
            
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

	@if(count($grades) > 0)
		<section class="section" id="fullState">
		    <div class="row">
		        <div class="col-lg-12">
		            <div class="card">
		            	<div class="card-header row align-items-center">
		            		<div class=" col-12">
		                    	{{ __("All Lists")}}
		            		</div>
		            	</div>

		                <div class="card-body pt-4">
		                	<div class="row">
			                    <div class="col-12">
			                        <div class="accordion" id="accordionExample">

			                            @foreach($grades as $key => $grade)
			                            <div class="accordion-item">
			                                <p class="accordion-header" id="heading{{ $key }}">
			                                    <button class="accordion-button @if($key != 0) collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $key }}" aria-expanded="true" aria-controls="collapse{{ $key }}">
			                                        {{ $grade->name }}
			                                    </button>
			                                </p>
			                                <div id="collapse{{ $key }}" class="accordion-collapse collapse @if($key == 0) show @endif" aria-labelledby="heading{{ $key }}" data-bs-parent="#accordionExample">
			                                    <div class="accordion-body row g-5 p-5">

			                                        @if($grade->curricula[0]->subjecttype_id)
			                                            @if(isset($subjecttypes))
			                                                @foreach($subjecttypes as $subjecttype)
			                                                    <h3 class="d-inline-block"> 
			                                                        {{ $subjecttype->name }}
			                                                        <span class="fs-4">( {{ $subjecttype->otherlanguage }} ) </span>
			                                                    </h3>
			                                                    <hr class="p-0">

			                                                    @foreach($grade->syllabi as $syllabus)
			                                                        @if($syllabus->curriculum->type == 'Main' && $syllabus->curriculum->subjecttype_id == $subjecttype->id)
			                                                        @php
			                                                            $cover = $syllabus->photo;
			                                                            $file = $syllabus->file;
			                                                            $subject = $syllabus->curriculum->subject->name;
			                                                            $type = $syllabus->curriculum->type;

			                                                            $syllabi_id = $hashids->encode($syllabus->id);
			                                                        @endphp
			                                                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12" >
			                                                            <div class="card syllabusCard ">
			                                                                <div class="image">
			                                                                    <img src="{{ asset($cover) }}"/>
			                                                                </div>
			                                                                <div class="details">
			                                                                    <div class="center">
			                                                                        <h1> {{ $subject }} <br><span class="text-success fw-bold"> {{ $type }}</span></h1>
			                                                                        <ul>
			                                                                        	@if(!in_array($authRole,["Guardian","Student"]))
			                                                                            <li>
			                                                                                <a href="javascript:void(0)" class="editBtn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ __('Edit') }}" data-id="{{ $syllabus->id }}" >
			                                                                                	<i class="bi bi-gear-fill text-white"></i> 
			                                                                                </a>
			                                                                            </li>
			                                                                            @endif

			                                                                            <li>
			                                                                                <a href="{{ route('master.syllabus.show', $syllabi_id) }}" target="_blank" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ __('Display PDF') }}" >
			                                                                                	<i class='bx bxs-file-pdf text-white'></i>
			                                                                                </a>
			                                                                            </li>
			                                                                            @if(!in_array($authRole,["Guardian","Student"]))
			                                                                            <li>
			                                                                                <a href="javascript:void(0)" class="deleteBtn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ __('Remove') }}"  data-id="{{ $syllabus->id }}">
			                                                                                	<i class="bi bi-x-lg text-white"></i> 
			                                                                                </a>
			                                                                            </li>

			                                                                            @endif
			                                                                            
			                                                                        </ul>
			                                                                    </div>
			                                                                </div>
			                                                            </div>
			                                                        </div>
			                                                        @endif
			                                                    @endforeach
			                                                @endforeach
			                                            @endif
			                                        @else
			                                        
			                                        @foreach($grade->syllabi as $syllabus)
			                                            @php
			                                                $cover = $syllabus->photo;
			                                                $file = $syllabus->file;
			                                                $subject = $syllabus->curriculum->subject->name;
			                                                $type = $syllabus->curriculum->type;

			                                                $syllabi_id = $hashids->encode($syllabus->id);
			                                            @endphp
			                                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12" >
			                                                <div class="card syllabusCard ">
			                                                    <div class="image">
			                                                        <img src="{{ asset($cover) }}"/>
			                                                    </div>
			                                                    <div class="details">
			                                                        <div class="center">
			                                                            <h1> {{ $subject }} <br><span class="text-success fw-bold"> {{ $type }}</span></h1>
			                                                            <ul>
			                                                            	@if(!in_array($authRole,["Guardian","Student"]))
			                                                                <li>
			                                                                    <a href="{{ route('master.syllabus.edit', $syllabi_id) }}" class="editBtn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ __('Edit') }}"  data-id="{{ $syllabus->id }}">
			                                                                    	<i class="bi bi-gear-fill text-white"></i> 
			                                                                    </a>
			                                                                </li>
			                                                                @endif
			                                                                <li>
			                                                                    <a href="{{ route('master.syllabus.show', $syllabi_id) }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ __('Display PDF') }}"  target="_blank">
			                                                                    	<i class='bx bxs-file-pdf text-white'></i>

			                                                                    </a>
			                                                                </li>

			                                                                @if(!in_array($authRole,["Guardian","Student"]))
			                                                                <li>
			                                                                    <a href="javascript:void(0)" class="deleteBtn" data-id="{{ $syllabus->id }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ __('Remove') }}" >
			                                                                    	<i class="bi bi-x-lg text-white"></i> 
			                                                                    </a>
			                                                                </li>
			                                                                @endif

			                                                            </ul>
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                            </div>
			                                        @endforeach

			                                        @endif
			                                        
			                                    </div>
			                                </div>
			                            </div>
			                            @endforeach

			                        </div>
			                    </div>
			                </div>

		                    
		                </div>
		            </div>
		        </div>
		    </div>
		</section>
	@else

	<!-- End Page Title -->
	<section class="section" id="emptyState">
	    <div class="row">
	        <div class="col-lg-12">
	            <div class="card">
	                <div class="card-body pt-4 d-flex flex-column align-items-center">
	                	<div class="container ">
		                	<div class="row align-items-center justify-content-center">
		                		<div class="col-6  text-center">
		                    		<img src="{{ asset('assets/img/empty_subject.svg') }}" class="img-fluid text-center">
		                		</div>
		                	</div>
		                </div>
	                    <h2> {{ __("No Syllabus Data Found") }} </h2>
	                    <p> {{ __("There have been no syllabus in this section yet. Please add some syllabus first.") }} </p>

	                    <div class="d-grid gap-2 col-6 mx-auto my-5">
						  	<a href="{{ route('master.syllabus.create') }}" class="btn btn-primary"> <i class="bi bi-plus-lg"></i> {{ __("Add Syllabus")}} </a>
						</div>

	                    
	                </div>
	            </div>
	        </div>
	    </div>
	</section>

	@endif

@section('script_content')
    
    <script type="text/javascript">
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

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
            	var cancel_btn_text = "မလုပ်တော့ပါ။";
            	var sorting_modal_title="အစဥ်လိုက်စီစဥ်ခြင်း။";


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
            	var cancel_btn_text = "キャンセル";
            	var sorting_modal_title="部門の並べ替え";

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
            	var cancel_btn_text = "取消";
            	var sorting_modal_title="部门排序";

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
            	var cancel_btn_text = "Abbrechen";
            	var sorting_modal_title="Abteilungssortierung";

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
            	var cancel_btn_text = "Annuler";
            	var sorting_modal_title="Tri par département";

            	
            }else{
            	var n_modal_title ="Add New";
            	var e_modal_title ="Edit Existing";
            	var s_success_text = "Your data was saved!";
            	var e_success_text = "Your data was updated!";
            	var d_confirm_text = "Deleting that data will permanently remove it from your network.";
            	var d_success_text = "Your data was deleted!";
            	var d_cancel_text = "Your data was safed in our database!";
            	var confirm_btn_text = "Yes, delete it!";
            	var cancel_btn_text = "Cancel";
            	var sorting_modal_title = "Sorting";

            }

            // DELETE
            $('.accordion-item').on('click', '.deleteBtn', function () {
     
                var id = $(this).data("id");
                
                var url="{{route('master.syllabus.destroy',':id')}}";
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
                                        window.location.reload();

                                    },
                                    error: function (data) {
                                        console.log('Error:', data);
                                    }
                                }).always(function(){
                                window.location.reload();
                                

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

        });
    </script>

@stop

</x-template>