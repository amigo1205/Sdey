@extends('master')
@section('pagelevel_plugin')
<link href="{{ cdn('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('pagelevel_style')
<link href="{{ cdn('assets/pages/css/profile-2.min.css') }}" rel="stylesheet" type="text/css" />
<style>
.changepassword-form .form-control.has-error {
  border: 2px solid #ed6b75 !important;
}
.changepassword-form .form-control.valid {
    border: 1px solid #a0a9b4 !important;
}
</style>
@endsection
@section('content')
  <!-- BEGIN PAGE TITLE-->
  <h3 class="page-title"> User Profile
  </h3>
  <!-- END PAGE TITLE-->
  <!-- END PAGE HEADER-->
  <div class="profile">
      <div class="tabbable-line tabbable-full-width">
          <ul class="nav nav-tabs">
              <li class="active">
                  <a href="#tab_1_1" data-toggle="tab"> Edit Profile </a>
              </li>
              @if(Auth::user()->user_role==2)
              <li>
                  <a href="#tab_1_6" data-toggle="tab"> Help </a>
              </li>
              @endif
          </ul>
          <div class="tab-content">
              <div class="tab-pane active" id="tab_1_1">
                  <div class="row">
                      <div class="col-md-3">
                          <ul class="list-unstyled profile-nav">
                              <li>
                                  @if(file_exists('assets/images/avatar'.'/'.Auth::User()->id.'.jpg'))
                                    <img class="img-responsive pic-bordered" alt="" src="{{ cdn('assets/images/avatar').'/'.Auth::User()->id.'.jpg'}}" />
                                  @else
                                    <img class="img-responsive pic-bordered" alt="" src="{{ cdn('assets/images/avatar/nophoto.jpg') }}" />
                                  @endif
                              </li>
                          </ul>
                      </div>
                      <div class="col-md-9">
                          <div class="row">
                              <div class="col-md-8 profile-info">
                                  <h1 class="font-green sbold uppercase">{{ Auth::user()->first_name }}&nbsp;{{ Auth::user()->last_name }}</h1>
                                  <p>Country &nbsp;: unknown</p>
                                  <p>Company Name&nbsp;: {{ Auth::user()->company_name }}</p>
                                  <p>Email &nbsp;: {{ Auth::user()->email }}</p>
                                  <p>Phone Number &nbsp;: {{ Auth::user()->phone_number }}</p>
                              </div>
                              <!--end col-md-8-->
                          </div>
                          <!--end row-->
                      </div>
                  </div>
                  @if (session('status'))
                      <div class="alert alert-success">
                          {{ session('status') }}
                      </div>
                  @endif
                  @if (session('error'))
                      <div class="alert alert-danger">
                          {{ session('error') }}
                      </div>
                  @endif
                  <div class="row profile-account">
                      <div class="col-md-3">
                          <ul class="ver-inline-menu tabbable margin-bottom-10">
                              <li class="active">
                                  <a data-toggle="tab" href="#tab_1-1">
                                      <i class="fa fa-cog"></i> Personal info </a>
                                  <span class="after"> </span>
                              </li>
                              <li>
                                  <a data-toggle="tab" href="#tab_2-2">
                                      <i class="fa fa-picture-o"></i> Change Avatar </a>
                              </li>
                              <li>
                                  <a data-toggle="tab" href="#tab_3-3">
                                      <i class="fa fa-lock"></i> Change Password </a>
                              </li>
                          </ul>
                      </div>
                      <div class="col-md-9">
                          <div class="tab-content">
                              <div id="tab_1-1" class="tab-pane active">
                                  <form role="form" action="{{url('changeUserinfo')}}" style="margin-bottom:20px;"  method="post" enctype="multipart/form-data">
                                      {{ csrf_field() }}
                                      <div class="form-group">
                                          <label class="control-label">First Name</label>
                                          <input type="text" placeholder="John" class="form-control" name="fname" value="{{Auth::user()->first_name}}" />
                                      </div>
                                      <div class="form-group">
                                          <label class="control-label">Last Name</label>
                                          <input type="text" placeholder="Doe" class="form-control" name="lname" value="{{Auth::user()->last_name}}" /> </div>
                                      <div class="margiv-top-10">
                                          <button type="submit" href="javascript:;" class="btn green"> Save Changes </a>
                                      </div>
                                  </form>
                                  <form role="form" action="{{url('changePhoneNumber')}}" style="margin-bottom:20px;"  method="post" enctype="multipart/form-data">
                                      {{ csrf_field() }}
                                      <div class="form-group">
                                          <label class="control-label">Mobile Number</label>
                                          <input type="text" placeholder="+1 646 580 DEMO (6284)" name="phone_number" value="{{Auth::user()->phone_number}}" class="form-control" /> </div>
                                      <div class="margiv-top-10">
                                          <button type="submit" href="javascript:;" class="btn green"> Save Changes </button>
                                      </div>
                                  </form>
                                  <form role="form" action="{{ url('changeEmailAddress')}}"  method="post" enctype="multipart/form-data">
                                      {{ csrf_field() }}
                                      <div class="form-group">
                                          <label class="control-label">Your Email</label>
                                          <input type="text" placeholder="example@mail.com" name="email" value="{{Auth::user()->email}}" class="form-control" /> </div>
                                      <div class="margiv-top-10">
                                          <button type="submit" href="javascript:;" class="btn green"> Save Changes </button>
                                      </div>
                                  </form>
                              </div>
                              <div id="tab_2-2" class="tab-pane">
                                  <form action="{{url('changeAvatar')}}" role="form" method="post" enctype="multipart/form-data">
                                      {{ csrf_field() }}
                                      <div class="form-group">
                                          <div class="fileinput fileinput-new" data-provides="fileinput">
                                              <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                  <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
                                              <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                              <div>
                                                  <span class="btn default btn-file">
                                                      <span class="fileinput-new"> Select image </span>
                                                      <span class="fileinput-exists"> Change </span>
                                                      <input type="file" name="user_image"> </span>
                                                  <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="margin-top-10">
                                          <button class="btn green" type="submit"> Submit </button>
                                      </div>
                                  </form>
                              </div>
                              <div id="tab_3-3" class="tab-pane">
                                  <form action="{{url('changePassword')}}" class="changepassword-form" method="post" enctype="multipart/form-data" >
                                      <div class="alert alert-danger display-hide">
                                          <button class="close" data-close="alert"></button>
                                          <span>Enter any username and password. </span>
                                      </div>
                                      {{ csrf_field() }}
                                      <div class="form-group">
                                          <label class="control-label">Current Password</label>
                                          <input type="password" class="form-control" name="current-password" required /> </div>
                                      <div class="form-group">
                                          <label class="control-label">New Password</label>
                                          <input type="password" autocomplete="off" class="form-control form-group" id="change_password" name="password" required /> </div>
                                      <div class="form-group">
                                          <label class="control-label">Re-type New Password</label>
                                          <input type="password" autocomplete="off" class="form-control" name="password_confirmation" required /> </div>
                                      <div class="margin-top-10">
                                          <button type="submit" class="btn green"> Change Password </button>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                      <!--end col-md-9-->
                  </div>
              </div>
              <div class="tab-pane" id="tab_1_6">
                  <div class="row">
                      <div class="col-md-3">
                          <ul class="ver-inline-menu tabbable margin-bottom-10">
                              <li class="active">
                                  <a data-toggle="tab" href="#tab_1">
                                      <i class="fa fa-briefcase"></i> General Questions </a>
                                  <span class="after"> </span>
                              </li>
                              <li>
                                  <a data-toggle="tab" href="#tab_2">
                                      <i class="fa fa-group"></i> Membership </a>
                              </li>
                              <li>
                                  <a data-toggle="tab" href="#tab_3">
                                      <i class="fa fa-leaf"></i> Terms Of Service </a>
                              </li>
                              <li>
                                  <a data-toggle="tab" href="#tab_1">
                                      <i class="fa fa-info-circle"></i> License Terms </a>
                              </li>
                              <li>
                                  <a data-toggle="tab" href="#tab_2">
                                      <i class="fa fa-tint"></i> Payment Rules </a>
                              </li>
                              <li>
                                  <a data-toggle="tab" href="#tab_3">
                                      <i class="fa fa-plus"></i> Other Questions </a>
                              </li>
                          </ul>
                      </div>
                      <div class="col-md-9">
                          <div class="tab-content">
                              <div id="tab_1" class="tab-pane active">
                                  <div id="accordion1" class="panel-group">
                                      <div class="panel panel-default">
                                          <div class="panel-heading">
                                              <h4 class="panel-title">
                                                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_1"> 1. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
                                              </h4>
                                          </div>
                                          <div id="accordion1_1" class="panel-collapse collapse in">
                                              <div class="panel-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                                  laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes
                                                  anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't
                                                  heard of them accusamus labore sustainable VHS. </div>
                                          </div>
                                      </div>
                                      <div class="panel panel-default">
                                          <div class="panel-heading">
                                              <h4 class="panel-title">
                                                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_2"> 2. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
                                              </h4>
                                          </div>
                                          <div id="accordion1_2" class="panel-collapse collapse">
                                              <div class="panel-body"> Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit,
                                                  enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf
                                                  moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente
                                                  ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable
                                                  VHS. </div>
                                          </div>
                                      </div>
                                      <div class="panel panel-success">
                                          <div class="panel-heading">
                                              <h4 class="panel-title">
                                                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_3"> 3. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor ? </a>
                                              </h4>
                                          </div>
                                          <div id="accordion1_3" class="panel-collapse collapse">
                                              <div class="panel-body"> Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit,
                                                  enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf
                                                  moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente
                                                  ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable
                                                  VHS. </div>
                                          </div>
                                      </div>
                                      <div class="panel panel-warning">
                                          <div class="panel-heading">
                                              <h4 class="panel-title">
                                                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_4"> 4. Wolf moon officia aute, non cupidatat skateboard dolor brunch ? </a>
                                              </h4>
                                          </div>
                                          <div id="accordion1_4" class="panel-collapse collapse">
                                              <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                  nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                  craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                                          </div>
                                      </div>
                                      <div class="panel panel-danger">
                                          <div class="panel-heading">
                                              <h4 class="panel-title">
                                                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_5"> 5. Leggings occaecat craft beer farm-to-table, raw denim aesthetic ? </a>
                                              </h4>
                                          </div>
                                          <div id="accordion1_5" class="panel-collapse collapse">
                                              <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                  nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                  craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3
                                                  wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et </div>
                                          </div>
                                      </div>
                                      <div class="panel panel-default">
                                          <div class="panel-heading">
                                              <h4 class="panel-title">
                                                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_6"> 6. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth ? </a>
                                              </h4>
                                          </div>
                                          <div id="accordion1_6" class="panel-collapse collapse">
                                              <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                  nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                  craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3
                                                  wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et </div>
                                          </div>
                                      </div>
                                      <div class="panel panel-default">
                                          <div class="panel-heading">
                                              <h4 class="panel-title">
                                                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_7"> 7. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft ? </a>
                                              </h4>
                                          </div>
                                          <div id="accordion1_7" class="panel-collapse collapse">
                                              <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                  nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                  craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3
                                                  wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div id="tab_2" class="tab-pane">
                                  <div id="accordion2" class="panel-group">
                                      <div class="panel panel-warning">
                                          <div class="panel-heading">
                                              <h4 class="panel-title">
                                                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_1"> 1. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
                                              </h4>
                                          </div>
                                          <div id="accordion2_1" class="panel-collapse collapse in">
                                              <div class="panel-body">
                                                  <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                                      laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore
                                                      wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably
                                                      haven't heard of them accusamus labore sustainable VHS. </p>
                                                  <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                                      laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore
                                                      wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably
                                                      haven't heard of them accusamus labore sustainable VHS. </p>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="panel panel-danger">
                                          <div class="panel-heading">
                                              <h4 class="panel-title">
                                                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_2"> 2. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
                                              </h4>
                                          </div>
                                          <div id="accordion2_2" class="panel-collapse collapse">
                                              <div class="panel-body"> Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit,
                                                  enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf
                                                  moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente
                                                  ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable
                                                  VHS. </div>
                                          </div>
                                      </div>
                                      <div class="panel panel-success">
                                          <div class="panel-heading">
                                              <h4 class="panel-title">
                                                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_3"> 3. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor ? </a>
                                              </h4>
                                          </div>
                                          <div id="accordion2_3" class="panel-collapse collapse">
                                              <div class="panel-body"> Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit,
                                                  enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf
                                                  moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente
                                                  ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable
                                                  VHS. </div>
                                          </div>
                                      </div>
                                      <div class="panel panel-default">
                                          <div class="panel-heading">
                                              <h4 class="panel-title">
                                                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_4"> 4. Wolf moon officia aute, non cupidatat skateboard dolor brunch ? </a>
                                              </h4>
                                          </div>
                                          <div id="accordion2_4" class="panel-collapse collapse">
                                              <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                  nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                  craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                                          </div>
                                      </div>
                                      <div class="panel panel-default">
                                          <div class="panel-heading">
                                              <h4 class="panel-title">
                                                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_5"> 5. Leggings occaecat craft beer farm-to-table, raw denim aesthetic ? </a>
                                              </h4>
                                          </div>
                                          <div id="accordion2_5" class="panel-collapse collapse">
                                              <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                  nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                  craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3
                                                  wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et </div>
                                          </div>
                                      </div>
                                      <div class="panel panel-default">
                                          <div class="panel-heading">
                                              <h4 class="panel-title">
                                                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_6"> 6. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth ? </a>
                                              </h4>
                                          </div>
                                          <div id="accordion2_6" class="panel-collapse collapse">
                                              <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                  nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                  craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3
                                                  wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et </div>
                                          </div>
                                      </div>
                                      <div class="panel panel-default">
                                          <div class="panel-heading">
                                              <h4 class="panel-title">
                                                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_7"> 7. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft ? </a>
                                              </h4>
                                          </div>
                                          <div id="accordion2_7" class="panel-collapse collapse">
                                              <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                  nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                  craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3
                                                  wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div id="tab_3" class="tab-pane">
                                  <div id="accordion3" class="panel-group">
                                      <div class="panel panel-danger">
                                          <div class="panel-heading">
                                              <h4 class="panel-title">
                                                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_1"> 1. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
                                              </h4>
                                          </div>
                                          <div id="accordion3_1" class="panel-collapse collapse in">
                                              <div class="panel-body">
                                                  <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                                      laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. </p>
                                                  <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                                      laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. </p>
                                                  <p> Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica,
                                                      craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt
                                                      you probably haven't heard of them accusamus labore sustainable VHS. </p>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="panel panel-success">
                                          <div class="panel-heading">
                                              <h4 class="panel-title">
                                                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_2"> 2. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
                                              </h4>
                                          </div>
                                          <div id="accordion3_2" class="panel-collapse collapse">
                                              <div class="panel-body"> Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit,
                                                  enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf
                                                  moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente
                                                  ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable
                                                  VHS. </div>
                                          </div>
                                      </div>
                                      <div class="panel panel-default">
                                          <div class="panel-heading">
                                              <h4 class="panel-title">
                                                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_3"> 3. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor ? </a>
                                              </h4>
                                          </div>
                                          <div id="accordion3_3" class="panel-collapse collapse">
                                              <div class="panel-body"> Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit,
                                                  enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf
                                                  moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente
                                                  ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable
                                                  VHS. </div>
                                          </div>
                                      </div>
                                      <div class="panel panel-default">
                                          <div class="panel-heading">
                                              <h4 class="panel-title">
                                                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_4"> 4. Wolf moon officia aute, non cupidatat skateboard dolor brunch ? </a>
                                              </h4>
                                          </div>
                                          <div id="accordion3_4" class="panel-collapse collapse">
                                              <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                  nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                  craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                                          </div>
                                      </div>
                                      <div class="panel panel-default">
                                          <div class="panel-heading">
                                              <h4 class="panel-title">
                                                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_5"> 5. Leggings occaecat craft beer farm-to-table, raw denim aesthetic ? </a>
                                              </h4>
                                          </div>
                                          <div id="accordion3_5" class="panel-collapse collapse">
                                              <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                  nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                  craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3
                                                  wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et </div>
                                          </div>
                                      </div>
                                      <div class="panel panel-default">
                                          <div class="panel-heading">
                                              <h4 class="panel-title">
                                                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_6"> 6. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth ? </a>
                                              </h4>
                                          </div>
                                          <div id="accordion3_6" class="panel-collapse collapse">
                                              <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                  nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                  craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3
                                                  wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et </div>
                                          </div>
                                      </div>
                                      <div class="panel panel-default">
                                          <div class="panel-heading">
                                              <h4 class="panel-title">
                                                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_7"> 7. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft ? </a>
                                              </h4>
                                          </div>
                                          <div id="accordion3_7" class="panel-collapse collapse">
                                              <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                  nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                  craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3
                                                  wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <!--end tab-pane-->
          </div>
      </div>
  </div>
@endsection
@section('pagelevel_script')
<script src="{{ cdn('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/backstretch/jquery.backstretch.min.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
<script src="{{ cdn('assets/pages/scripts/login-5.js') }}" type="text/javascript"></script>
@endsection
