@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                  {{-- {!!Form::open([])!!} --}}
                  {{ Form::open(['url' => $formAction, 'class' => 'form-horizontal', 'id' => 'my-form']) }}
                  {{-- {{ Form::hidden('_token', csrf_token(), []) }} --}}
                    {!!Form::text('status', !empty($data->personal->first_name) ? $data->personal->first_name : NULL, ['placeholder' => 'Update Status','class'=>'form-control'])!!}
                    <br/>
                    {{ Form::button('Update',
                                            [
                                                'type'         => 'submit',
                                                'class'        => 'btn btn-primary',
                                            ])
                            }}
                  {!!Form::close()!!}
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Status</div>
                <ul class="list-group">
                @foreach ($status->get() as $stat)
                  @if($stat->user_id==Auth::user()->id)
                    <li class="list-group-item list-group-item-success" style="text-align:right;">
                      <b><h4 class="list-group-item-heading">{{$stat->status}}</h4></b>
                      <small>{{$stat->created_at->format('d M Y H:i:s')}}</small>
                      <p class="list-group-item-text">Me</p>
                    </li>
                  @else
                    <li class="list-group-item list-group-item-info">
                    <b><h4 class="list-group-item-heading">{{$stat->status}}</h4></b>
                    <small>{{$stat->created_at->format('d M Y H:i:s')}}</small>
                      <p class="list-group-item-text">{{$stat->user->name}}</p>
                    </li>
                  @endif

                @endforeach
              </ul>

            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
    $('form#my-form').submit(function(event) {
                event.preventDefault();
                var url = $('#'+this.id).attr('action');
                $.ajax({
                  type: 'POST',
                  url: url,
                  headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
                  data: $('#'+this.id).serialize(), // or JSON.stringify ({name: 'jonas'}),
                  success: function(data) { console.log(data);location.reload(); },
                  // contentType: "application/json",
                  // dataType: 'json'
              });
            });
    });
</script>

@endsection
