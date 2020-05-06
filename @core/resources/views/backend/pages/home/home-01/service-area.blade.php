@extends('backend.admin-master')
@section('site-title')
    {{__('Service Area')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                @include('backend/partials/message')
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Service Area Settings')}}</h4>
                        <form action="{{route('admin.homeone.service.area')}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <ul class="nav nav-tabs " id="myTab" role="tablist">
                                @foreach(get_all_language() as $key => $lang)
                                <li class="nav-item">
                                    <a class="nav-link @if($key == 0) active @endif" data-toggle="tab" href="#home_{{$key}}" role="tab" aria-selected="true">{{$lang->name}}</a>
                                </li>
                                @endforeach
                            </ul>
                            <div class="tab-content margin-top-30" id="myTabContent">
                                @foreach(get_all_language() as $key => $lang)
                                <div class="tab-pane fade @if($key == 0) show active @endif" id="home_{{$key}}" role="tabpanel" >
                                    <div class="form-group">
                                        <label for="home_page_01_{{$lang->slug}}_service_area_title">{{__('Title')}}</label>
                                        <input type="text" name="home_page_01_{{$lang->slug}}_service_area_title" class="form-control" value="{{get_static_option('home_page_01_'.$lang->slug.'_service_area_title')}}" id="home_page_01_{{$lang->slug}}_service_area_title">
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_01_{{$lang->slug}}_service_area_description">{{__('Description')}}</label>
                                        <textarea name="home_page_01_{{$lang->slug}}_service_area_description" class="form-control max-height-150" id="home_page_01_{{$lang->slug}}_service_area_description" cols="30" rows="10">{{get_static_option('home_page_01_'.$lang->slug.'_service_area_description')}}</textarea>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @if(get_static_option('home_page_variant' == '03'))
                            <div class="form-group">
                                <label for="home_page_01_service_area_items">{{__('Service Items')}}</label>
                                <input type="text" name="home_page_01_service_area_items" class="form-control"
                                       value="{{get_static_option('home_page_01_service_area_items')}}"
                                       id="home_page_01_service_area_items">
                                <small class="info-text">{{__('enter how many service show in frontend')}}</small>
                            </div>
                            <div class="img-wrapper">
                                @if(file_exists('assets/uploads/'.get_static_option('home_page_01_service_area_background_image')))
                                    <img  style="max-width: 200px; margin-top:20px;" src="{{asset('assets/uploads/'.get_static_option('home_page_01_service_area_background_image'))}}" alt="">
                                @endif
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="home_page_01_service_area_background_image">{{__('Service Background Image')}}</label>
                                <input type="file" class="form-control"  id="home_page_01_service_area_background_image" name="home_page_01_service_area_background_image">
                                <small>{{__('recommended image size is 1920x800 pixel')}}</small>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Settings')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

