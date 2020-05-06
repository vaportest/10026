@extends('backend.admin-master')
@section('site-title')
    {{__('Team Member Item')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <!-- basic form start -->
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

            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Team Member Items')}}</h4>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @php $a=0; @endphp
                            @foreach($all_team_member as $key => $team)
                                <li class="nav-$all_price_plan">
                                    <a class="nav-link @if($a == 0) active @endif"  data-toggle="tab" href="#slider_tab_{{$key}}" role="tab" aria-controls="home" aria-selected="true">{{get_language_by_slug($key)}}</a>
                                </li>
                                @php $a++; @endphp
                            @endforeach
                        </ul>
                        <div class="tab-content margin-top-40" id="myTabContent">
                            @php $b=0; @endphp
                            @foreach($all_team_member as $key => $team)
                                <div class="tab-pane fade @if($b == 0) show active @endif" id="slider_tab_{{$key}}" role="tabpanel" >
                                    <table class="table table-default">
                                        <thead>
                                        <th>{{__('ID')}}</th>
                                        <th>{{__('Image')}}</th>
                                        <th>{{__('Name')}}</th>
                                        <th>{{__('Designation')}}</th>
                                        <th>{{__('Action')}}</th>
                                        </thead>
                                        <tbody>
                                        @foreach($team as $data)
                                            @php $img_url =''; @endphp
                                            <tr>
                                                <td>{{$data->id}}</td>
                                                <td>
                                                    @if(file_exists('assets/uploads/team-member/team-member-grid-'.$data->id.'.'.$data->image))
                                                        <img style="max-width: 80px" src="{{asset('assets/uploads/team-member/team-member-grid-'.$data->id.'.'.$data->image)}}" alt="{{__($data->name)}}">
                                                        @php $img_url = asset('assets/uploads/team-member/team-member-grid-'.$data->id.'.'.$data->image) @endphp
                                                    @else
                                                        <img style="max-width: 80px" src="{{asset('assets/uploads/no-image.png')}}" alt="no image available">
                                                    @endif
                                                </td>
                                                <td>{{$data->name}}</td>
                                                <td>{{$data->designation}}</td>
                                                <td>
                                                    <a tabindex="0" class="btn btn-lg btn-danger btn-sm mb-3 mr-1"
                                                       role="button"
                                                       data-toggle="popover"
                                                       data-trigger="focus"
                                                       data-html="true"
                                                       title=""
                                                       data-content="
                                               <h6>Are you sure to delete this team member item?</h6>
                                               <form method='post' action='{{route('admin.team.member.delete',$data->id)}}'>
                                               <input type='hidden' name='_token' value='{{csrf_token()}}'>
                                               <br>
                                                <input type='submit' class='btn btn-danger btn-sm' value='Yes,Delete'>
                                                </form>
                                                ">
                                                        <i class="ti-trash"></i>
                                                    </a>
                                                    <a href="#"
                                                       data-toggle="modal"
                                                       data-target="#team_member_item_edit_modal"
                                                       class="btn btn-lg btn-primary btn-sm mb-3 mr-1 team_member_edit_btn"
                                                       data-id="{{$data->id}}"
                                                       data-action="{{route('admin.team.member.update')}}"
                                                       data-name="{{$data->name}}"
                                                       data-image="{{$img_url}}"
                                                       data-designation="{{$data->designation}}"
                                                       data-lang="{{$data->lang}}"
                                                       data-iconOne="{{$data->icon_one}}"
                                                       data-iconTwo="{{$data->icon_two}}"
                                                       data-iconThree="{{$data->icon_three}}"
                                                       data-iconOneUrl="{{$data->icon_one_url}}"
                                                       data-iconTwoUrl="{{$data->icon_two_url}}"
                                                       data-iconThreeUrl="{{$data->icon_three_url}}"
                                                    >
                                                        <i class="ti-pencil"></i>
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
            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('New Team Member')}}</h4>
                        <form action="{{route('admin.team.member')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="languages">{{__('Languages')}}</label>
                                <select name="lang" class="form-control" id="languages">
                                    @foreach($all_languages as $lang)
                                        <option value="{{$lang->slug}}">{{$lang->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">{{__('Name')}}</label>
                                <input type="text" class="form-control"  id="name"  name="name" placeholder="{{__('Name')}}">
                            </div>
                            <div class="form-group">
                                <label for="designation">{{__('Designation')}}</label>
                                <input type="text" class="form-control"  id="designation"  name="designation" placeholder="{{__('Designation')}}">
                            </div>
                            <div class="form-group">
                                <label for="icon_one" class="d-block">{{__('Social Profile One')}}</label>
                                <div class="btn-group ">
                                    <button type="button" class="btn btn-primary iconpicker-component">
                                        <i class="fab fa-instagram"></i>
                                    </button>
                                    <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                            data-selected="fab fa-instagram" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu"></div>
                                </div>
                                <input type="hidden" class="form-control"  id="icon_one" value="fab fa-instagram" name="icon_one">
                            </div>
                            <div class="form-group">
                                <label for="icon_one_url">{{__('Social Profile One URL')}}</label>
                                <input type="text" class="form-control"  id="icon_one_url"  name="icon_one_url" placeholder="{{__('Social Profile One URL')}}">
                            </div>
                            <div class="form-group">
                                <label for="icon_two" class="d-block">{{__('Social Profile Two')}}</label>
                                <div class="btn-group ">
                                    <button type="button" class="btn btn-primary iconpicker-component">
                                        <i class="fab fa-twitter"></i>
                                    </button>
                                    <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                            data-selected="fab fa-twitter" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu"></div>
                                </div>
                                <input type="hidden" class="form-control"  id="icon_two" value="fab fa-twitter" name="icon_two">
                            </div>
                            <div class="form-group">
                                <label for="icon_two_url">{{__('Social Profile Two URL')}}</label>
                                <input type="text" class="form-control"  id="icon_two_url"  name="icon_two_url" placeholder="{{__('Social Profile Two URL')}}">
                            </div>
                            <div class="form-group">
                                <label for="icon_three" class="d-block">{{__('Social Profile Three')}}</label>
                                <div class="btn-group ">
                                    <button type="button" class="btn btn-primary iconpicker-component">
                                        <i class="fab fa-facebook-f"></i>
                                    </button>
                                    <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                            data-selected="fab fa-facebook-f" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu"></div>
                                </div>
                                <input type="hidden" class="form-control"  id="icon_three" value="fab fa-facebook-f" name="icon_three">
                            </div>
                            <div class="form-group">
                                <label for="icon_three_url">{{__('Social Profile Three URL')}}</label>
                                <input type="text" class="form-control"  id="icon_three_url"  name="icon_three_url" placeholder="{{__('Social Profile Three URL')}}">
                            </div>
                            <div class="form-group">
                                <label for="image">{{__('Image')}}</label>
                                <input type="file" class="form-control"  id="image"  name="image">
                                <small>{{__('Recommended image size 270x280')}}</small>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Add  New Team Member')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="team_member_item_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Edit Team Member Item')}}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="#" id="team_member_edit_modal_form"  method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" id="team_member_id" value="">
                        <div class="form-group">
                            <label for="edit_languages">{{__('Languages')}}</label>
                            <select name="lang" class="form-control" id="edit_languages">
                                @foreach($all_languages as $lang)
                                    <option value="{{$lang->slug}}">{{$lang->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_name">{{__('Name')}}</label>
                            <input type="text" class="form-control"  id="edit_name"  name="name" placeholder="{{__('Name')}}">
                        </div>
                        <div class="form-group">
                            <label for="edit_designation">{{__('Designation')}}</label>
                            <input type="text" class="form-control"  id="edit_designation"  name="designation" placeholder="{{__('Designation')}}">
                        </div>
                        <div class="form-group">
                            <label for="edit_icon_one" class="d-block">{{__('Social Profile One')}}</label>
                            <div class="btn-group edit_icon_one">
                                <button type="button" class="btn btn-primary iconpicker-component">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </button>
                                <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                        data-selected="fas fa-exclamation-triangle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu"></div>
                            </div>
                            <input type="hidden" class="form-control"  id="edit_icon_one" value="fas fa-exclamation-triangle" name="icon_one">
                        </div>
                        <div class="form-group">
                            <label for="edit_icon_one_url">{{__('Social Profile One URL')}}</label>
                            <input type="text" class="form-control"  id="edit_icon_one_url"  name="icon_one_url" placeholder="{{__('Social Profile One URL')}}">
                        </div>
                        <div class="form-group">
                            <label for="edit_icon_two" class="d-block">{{__('Social Profile Two')}}</label>
                            <div class="btn-group edit_icon_two">
                                <button type="button" class="btn btn-primary iconpicker-component">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </button>
                                <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                        data-selected="fas fa-exclamation-triangle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu"></div>
                            </div>
                            <input type="hidden" class="form-control"  id="edit_icon_two" value="fas fa-exclamation-triangle" name="icon_two">
                        </div>
                        <div class="form-group">
                            <label for="edit_icon_two_url">{{__('Social Profile Two URL')}}</label>
                            <input type="text" class="form-control"  id="edit_icon_two_url"  name="icon_two_url" placeholder="{{__('Social Profile Two URL')}}">
                        </div>
                        <div class="form-group">
                            <label for="edit_icon_three" class="d-block">{{__('Social Profile Three')}}</label>
                            <div class="btn-group edit_icon_three">
                                <button type="button" class="btn btn-primary iconpicker-component">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </button>
                                <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                        data-selected="fas fa-exclamation-triangle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu"></div>
                            </div>
                            <input type="hidden" class="form-control"  id="edit_icon_three" value="fas fa-exclamation-triangle" name="icon_three">
                        </div>
                        <div class="form-group">
                            <label for="edit_icon_three_url">{{__('Social Profile Three URL')}}</label>
                            <input type="text" class="form-control"  id="edit_icon_three_url"  name="icon_three_url" placeholder="{{__('Social Profile Three URL')}}">
                        </div>
                        <div class="img-wrapper">
                            <img src="" style="max-width: 100px" id="preview_image" alt="">
                        </div>
                        <div class="form-group">
                            <label for="image">{{__('Image')}}</label>
                            <input type="file" class="form-control"  id="edit_image"  name="image">
                            <small>{{__('Recommended image size 270x280')}}</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Save Changes')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')

    <script>
        $(document).ready(function () {
            $(document).on('click','.team_member_edit_btn',function(){
                var el = $(this);
                var id = el.data('id');
                var name = el.data('name');
                var designation = el.data('designation');
                var action = el.data('action');
                var image = el.data('image');
                var form = $('#team_member_edit_modal_form');
                form.attr('action',action);
                form.find('#team_member_id').val(id);
                form.find('#edit_name').val(name);
                form.find('#edit_designation').val(designation);
                form.find('#edit_description').val(el.data('description'));
                form.find('#edit_icon_one').val(el.data('iconone'));
                form.find('#edit_icon_two').val(el.data('icontwo'));
                form.find('#edit_icon_three').val(el.data('iconthree'));
                form.find('#edit_icon_one_url').val(el.data('icononeurl'));
                form.find('#edit_icon_two_url').val(el.data('icontwourl'));
                form.find('#edit_icon_three_url').val(el.data('iconthreeurl'));
                form.find('#preview_image').attr('src',image);
                form.find('#edit_languages option[value="'+el.data('lang')+'"]').attr('selected',true);

                form.find('.edit_icon_three .icp-dd').attr('data-selected',el.data('iconthree'));
                form.find('.edit_icon_three .iconpicker-component i').attr('class',el.data('iconthree'));
                form.find('.edit_icon_two .icp-dd').attr('data-selected',el.data('icontwo'));
                form.find('.edit_icon_two .iconpicker-component i').attr('class',el.data('icontwo'));
                form.find('.edit_icon_one .icp-dd').attr('data-selected',el.data('iconone'));
                form.find('.edit_icon_one .iconpicker-component i').attr('class',el.data('iconone'));
            });

            $('.icp-dd').iconpicker();
            $('.icp-dd').on('iconpickerSelected', function (e) {
                var selectedIcon = e.iconpickerValue;
                $(this).parent().parent().children('input').val(selectedIcon);
            });

        });
    </script>
@endsection
