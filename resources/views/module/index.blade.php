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
                                        <div class="card-header"> {{ trans('file.Companies Modules') }} </div>
                                        <div class="card-body">
                                                @if (session('status'))
                                                <div class="alert alert-success" role="alert">
                                                        {{ session('status') }}
                                                </div>
                                                @endif
                                                <?php
                             function printCompanyName($company){
                                    if($company == "hygiene"){
                                        return "akeed hygiene";
                                    }else if($company == "sweet"){
                                        return "akeed sweet";
                                    }else if ($company == "goods"){
                                        return "akeed food";
                                    }else if($company == "hafko"){
                                        return "akeed factory";
                                    }else if($company == "sanfora"){
                                        return "bruxelle salon";
                                    }else if($company == "service"){
                                        return "akeed trading";
                                    }
                                }
                        ?>
                                                <div class="container">
                                                        @for ($i = 0 ; $i< count($companies) ; $i +=2 ) <div
                                                                class="row">
                                                                <div class="card col-12 col-md-5 m-3">
                                                                        <div class="card-header">
                                                                                <?= printCompanyName($companies[$i]->name)?>
                                                                        </div>
                                                                        <div class="card-body">
                                                                                <?php $modules = $companies[$i]->modules; ?>
                                                                                <ul class="list-group">
                                                                                        @foreach ($modules as $module)

                                                                                        <li class="list-group-item">
                                                                                                {{ trans("file.$module->name") }}
                                                                                        </li>
                                                                                        @endforeach
                                                                                </ul>
                                                                        </div>
                                                                        <a href="{{ route('module.edit', ['id' => $companies[$i]->id]) }}"
                                                                                class="btn btn-primary  active mx-auto w-50 mb-3"
                                                                                role="button" aria-pressed="true">
                                                                                {{ trans('file.edit') }} </a>
                                                                </div>
                                                                @if( count($companies) > $i +1 )
                                                                <div class="card col-12 col-md-5 m-3">
                                                                        <div class="card-header">
                                                                                <?= printCompanyName($companies[$i+1]->name)?>
                                                                        </div>
                                                                        <div class="card-body">
                                                                                <?php $modules = $companies[$i+1]->modules; ?>
                                                                                <ul class="list-group ">
                                                                                        @foreach ($modules as $module)

                                                                                        <li class="list-group-item">
                                                                                                <?= $module->name?></li>
                                                                                        @endforeach
                                                                                </ul>
                                                                        </div>
                                                                        <a href="{{ route('module.edit', ['id' => $companies[$i+1]->id]) }}"
                                                                                class="btn btn-primary  active mx-auto w-50 mb-3"
                                                                                role="button"
                                                                                aria-pressed="true">edit</a>

                                                                        {{-- <button type="button"
                                                                                class="btn btn-primary w-50 mx-auto mb-3">edit</button> --}}

                                                                </div>
                                                                @endif
                                                </div>
                                                @endfor
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
        </div>
</section>

<script type="text/javascript">

</script>
@endsection