@extends('layout.main') 
@section('content')


@if(session()->has('message1'))
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{!! session()->get('message1') !!}</div> 
@endif
@if(session()->has('message2'))
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('message2') }}</div> 
@endif
@if(session()->has('message3'))
        <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('message3') }}</div> 
@endif
@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div> 
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-2">
            <div class="card">
                <div class="card-header">{{ trans('file.dashboard') }}</div>
                <div class="card-body pt-0">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @php
                     $user_role_id = Auth::user()->role_id;
                     $number_of_companies = count($companies);
                     if($number_of_companies == 1){
                         $redirectTo = $companies[0]->name;
                     }
                    @endphp
                    @if ($number_of_companies == 1)
                        
                    <input type="hidden" name="redirect" id="redirect" value={{$redirectTo}}>
                    @endif
                    <div class="container">
                        @for ($i = 0 ; $i< count($companies) ; $i += 2 )
                            <div class="row">
                                <div class="card col-12 col-md-5 m-3"  >
                                    <a href={{url($companies[$i]->name)}}>
                                        <div class="card-body">
                                        <p class="card-text text-center"> {{$companies[$i]->name}} </p>
                                        </div>
                                        <img class="card-img-top pb-3" src=<?= "images/".$companies[$i]->name.".png"?> alt="Card image cap">
                                    </a>
                                </div>
                                @if( count($companies) > $i +1 )
                                    <div class="card col-12 col-md-5 m-3"  >
                                        <a href={{$companies[$i+1]->name}}>
                                            <div class="card-body">
                                            <p class="card-text text-center"> {{$companies[$i+1]->name}} </p>
                                            </div>
                                            <img class="card-img-top pb-3" src=<?= "images/".$companies[$i+1]->name.".png"?> alt="Card image cap">
                                        </a>
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
@endsection

<script>
    document.addEventListener('DOMContentLoaded',()=>{
        let redirectTo = document.querySelector('#redirect').value;
        let url = "https://www.akeedgroups.com/"+redirectTo;
        window.location.assign(url);
    })
</script>