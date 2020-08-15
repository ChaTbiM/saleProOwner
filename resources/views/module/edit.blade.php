@extends('layout.main') @section('content')
@if(session()->has('message1'))
<div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
                aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('message1') !!}
</div>
@endif
@if(session()->has('message2'))
<div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
                aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('message2') }}
</div>
@endif
@if(session()->has('message3'))
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
                aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('message3') }}
</div>
@endif
@if(session()->has('not_permitted'))
<div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
                aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}
</div>
@endif

<section>
        <div class="container">
                <div class="row justify-content-center">
                        <div class="col-md-10">
                                <div class="card">
                                        <h3 class="card-header"><?= $company_name ?> modules</h3>
                                        <div class="card-body">
                                                {!! Form::open(['route' => ['module.update', $company->id], 'method' =>
                                                'put', 'files' => true]) !!}

                                                <h6>Activated Modules</h6>
                                                @foreach ($company_modules as $module)
                                                <div class="form-check form-group form-check-inline ">
                                                        <input type="checkbox" class="form-check-input"
                                                                name="<?=$module?>" id="<?=$module?>"
                                                                value="<?=$module?>" checked>

                                                        <label class="form-check-label "
                                                                for="<?=$module?>"><?=$module?></label>
                                                </div>
                                                @endforeach

                                                <h6>Desactivated Modules</h6>
                                                @if (count($desactivated_modules) > 1)
                                                <div class="form-check form-group ">
                                                        <input type="checkbox" class="form-check-input"
                                                                name="all" id="all"
                                                                >

                                                        <label class="form-check-label "
                                                                for="all"> {{ trans('file.all') }} </label>
                                                </div>    
                                                @endif
                                                
                                                @foreach ($desactivated_modules as $module)

                                                <div class="form-check form-group form-check-inline ">
                                                        <input type="checkbox" class="form-check-input modules"
                                                                name="<?=$module?>" id="<?=$module?>"
                                                                value="<?=$module?>">

                                                        <label class="form-check-label "
                                                                for="<?=$module?>"><?=$module?></label>
                                                </div>
                                                @endforeach
                                                <div class="form-group">
                                                        <input type="submit" value="{{trans('file.submit')}}"
                                                                class="btn btn-primary mt-3">
                                                </div>
                                        </div>

                                        {!! Form::close() !!}
                                </div>
                        </div>
                </div>
        </div>
</section>

<script type="text/javascript">

$(document).ready(()=>{
                let isAllChecked = $('#all').prop('checked');
              handleAllChange(isAllChecked);

        $("#all").on('change', function(){
                let isAllChecked = $(this).prop('checked');
              handleAllChange(isAllChecked);

        })
})

function handleAllChange(isAllChecked){
        if(isAllChecked){
                      $('.modules').prop('checked',true);
              }else {
                $('.modules').prop('checked',false);
              }
}

</script>
@endsection