@extends('layouts.app')

@section('content')
  {{-- {{dd($errors)}} --}}

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Profile Settings</div>
                <div class="panel-body">
                  @if (session('status'))
                      <div class="alert alert-success">
                          {{ session('status') }}
                      </div>
                  @endif
                    <form class="form-horizontal" role="form" method="POST" id="my-form" action="{{ url('/profile/process') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                {{-- <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"> --}}
                                {!!Form::text('name', !empty($data->name) ? $data->name : NULL, ['class'=>'form-control'])!!}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                {!!Form::text('email', !empty($data->email) ? $data->email : NULL, ['class'=>'form-control'])!!}

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    // $(function() {
    // $('form#my-form').submit(function(event) {
    //             event.preventDefault();
    //             var url = $('#'+this.id).attr('action');
    //             $.ajax({
    //               type: 'POST',
    //               url: url,
    //               headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
    //               data: $('#'+this.id).serialize(), // or JSON.stringify ({name: 'jonas'}),
    //               success: function(data) {
    //                 // alert(data.msg);
    //                 // location.reload();
    //               },
    //               // contentType: "application/json",
    //               // dataType: 'json'
    //           });
    //         });
    // });
</script>
@endsection