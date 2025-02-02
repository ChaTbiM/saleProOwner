@extends('layout.main') @section('content')
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>{{trans('file.Add Biller')}}</h4>
                    </div>
                    <div class="card-body">
                        <p class="italic">
                            <small>{{trans('file.The field labels marked with * are required input fields')}}.</small>
                        </p>
                        {!! Form::open(['route' => 'biller.store', 'method' => 'post', 'files' => true]) !!}
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('file.name')}} *</strong> </label>
                                    <input type="text" name="name" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('file.Image')}}</label>
                                    <input type="file" name="image" class="form-control">
                                    @if($errors->has('image'))
                                    <span>
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class=" form-group companies_list" >
                                    <label><strong>{{trans('file.Company Name')}} *</strong></label>
                                    <select  required name="company_name"
                                        class="selectpicker form-control " data-live-search="true"
                                        data-live-search-style="begins" title="Select Company...">
                                        @foreach($companies as $company)
                                        <option value="{{$company->name}}"  >
                                            {{$company->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{trans('file.From Company')}} *</label>
                            <input type="text" name="from_company" required class="form-control">
                            @if($errors->has('from_companys'))
                            <span>
                                <strong>{{ $errors->first('from_company') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{trans('file.VAT Number')}}</label>
                            <input type="text" name="vat_number" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{trans('file.Email')}} *</label>
                            <input type="email" name="email" placeholder="example@example.com" required
                                class="form-control">
                            @if($errors->has('email'))
                            <span>
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{trans('file.Phone Number')}} *</label>
                            <input type="text" name="phone_number" required class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{trans('file.Address')}} *</label>
                            <input type="text" name="address" required class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{trans('file.City')}} *</label>
                            <input type="text" name="city" required class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{trans('file.State')}}</label>
                            <input type="text" name="state" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{trans('file.Postal Code')}}</label>
                            <input type="text" name="postal_code" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{trans('file.Country')}}</label>
                            <input type="text" name="country" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mt-4">
                            <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    </div>
    </div>
</section>

<script type="text/javascript">
    $("ul#people").siblings('a').attr('aria-expanded','true');
    $("ul#people").addClass("show");
    $("ul#people #biller-create-menu").addClass("active");
</script>
@endsection