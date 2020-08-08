@extends('layout.main') @section('content')
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

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if($role_id == 3)
                        ceo
                    @endif
                    <div class="container">
                        @for ($i = 0 ; $i< count($companies) ; $i += 2 )
                            <div class="row">
                                
                                <div class="card col-5 m-3"  >
                                    <a href="#">
                                        <div class="card-body">
                                        <p class="card-text text-center"> {{$companies[$i]->name}} </p>
                                        </div>
                                        <img class="card-img-top pb-3" src='images/picture.jpg' alt="Card image cap">
                                    </a>
                                </div>
                                @if( count($companies) > $i +1 )
                                    <div class="card col-5 m-3"  >
                                        <a href="#">
                                            <div class="card-body">
                                            <p class="card-text text-center"> {{$companies[$i+1]->name}} </p>
                                            </div>
                                            <img class="card-img-top pb-3" src='images/picture.jpg' alt="Card image cap">
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
