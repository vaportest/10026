@extends('backend.admin-master')
@section('site-title')
    {{__('All Pages')}}
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
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('All Pages')}}</h4>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @php $a=0; @endphp
                            @foreach($all_page as $key => $page)
                                <li class="nav-item">
                                    <a class="nav-link @if($a == 0) active @endif"  data-toggle="tab" href="#slider_tab_{{$key}}" role="tab" aria-controls="home" aria-selected="true">{{get_language_by_slug($key)}}</a>
                                </li>
                                @php $a++; @endphp
                            @endforeach
                        </ul>
                        <div class="tab-content margin-top-40" id="myTabContent">
                            @php $b=0; @endphp
                            @foreach($all_page as $key => $pages)
                                <div class="tab-pane fade @if($b == 0) show active @endif" id="slider_tab_{{$key}}" role="tabpanel" >
                                    <table class="table table-default">
                                        <thead>
                                        <th>{{__('ID')}}</th>
                                        <th>{{__('Title')}}</th>
                                        <th>{{__('Date')}}</th>
                                        <th>{{__('Status')}}</th>
                                        <th>{{__('Action')}}</th>
                                        </thead>
                                        <tbody>
                                        @foreach($pages as $data)
                                            <tr>
                                                <td>{{$data->id}}</td>
                                                <td>{{$data->title}}</td>
                                                <td>{{$data->created_at->diffForHumans()}}</td>
                                                <td>
                                                    @if($data->status == 'publish')
                                                        <span class="alert alert-success">{{__('Publish')}}</span>
                                                    @else
                                                        <span class="alert alert-warning">{{__('Draft')}}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a tabindex="0" class="btn btn-lg btn-danger btn-sm mb-3 mr-1"
                                                       role="button"
                                                       data-toggle="popover"
                                                       data-trigger="focus"
                                                       data-html="true"
                                                       title=""
                                                       data-content="
                                               <h6>Are you sure to delete this page?</h6>
                                               <form method='post' action='{{route('admin.page.delete',$data->id)}}'>
                                               <input type='hidden' name='_token' value='{{csrf_token()}}'>
                                               <br>
                                                <input type='submit' class='btn btn-danger btn-sm' value='Yes,Delete'>
                                                </form>
                                                ">
                                                        <i class="ti-trash"></i>
                                                    </a>
                                                    <a class="btn btn-lg btn-primary btn-sm mb-3 mr-1" href="{{route('admin.page.edit',$data->id)}}">
                                                        <i class="ti-pencil"></i>
                                                    </a>
                                                    <a class="btn btn-lg btn-info btn-sm mb-3 mr-1" target="_blank" href="{{route('frontend.dynamic.page',['id' => $data->id, 'any' => Str::slug($data->title)])}}">
                                                        <i class="ti-eye"></i>
                                                    </a>

                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @php $b++; @endphp
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
