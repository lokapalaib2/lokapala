@extends('layout.dashboard')

@section('content')
  @if (session('status'))
      <script type="text/javascript">
          $.toast({
                  heading: 'Success',
                  text: 'success',
                  showHideTransition: 'slide',
                  icon: 'success'
              });
      </script>      
  @endif
<?php if (isset($configuration->status)){ ?>
      <script type="text/javascript">
          $.toast({
                  heading: 'Success',
                  text: 'success',
                  showHideTransition: 'slide',
                  icon: 'success'
              });
      </script>      
<?php } ?>
  <?php if($configuration == NULL){ ?>
           <div class="col-xs-12">
              <div class="box">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <form action="{{ env('APP_URL') }}configuration" method="post"  enctype="multipart/form-data">
                      {{csrf_field()}}
                      <div class="form-group{{ $errors->has('meta_title') ? ' has-error' : '' }}">
                        <input type="text" name="meta_title" class="form-control" placeholder="meta_title" >
                        {!! $errors->first('meta_title', '<p class="help-block">:message</p>') !!}
                      </div>
                    
                      <div class="form-group{{ $errors->has('meta_description') ? ' has-error' : '' }}">
                        <textarea class="form-control" rows="5" name="meta_description"></textarea>
                        {!! $errors->first('meta_description', '<p class="help-block">:message</p>') !!}
                      </div>
                      <div class="form-group{{ $errors->has('meta_keyword') ? ' has-error' : '' }}">
                        <input type="text" name="meta_keyword" class="form-control" placeholder="meta_keyword" >
                        {!! $errors->first('meta_keyword', '<p class="help-block">:message</p>') !!}
                      </div>
                       <div class="form-group{{ $errors->has('site_title') ? ' has-error' : '' }}">
                        <input type="text" name="site_title" class="form-control" placeholder="site_title" >
                        {!! $errors->first('site_title', '<p class="help-block">:message</p>') !!}
                      </div>
                      <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Simpan">
                      </div>

                    </form>
                  </div>
                </div>
          </div>
      </div>
  <?php }else{ ?>
      <div class="col-xs-12">
              <div class="box">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <form action="{{ env('APP_URL') }}configuration" method="post"  enctype="multipart/form-data">
                      {{csrf_field()}}
                      <input type="hidden" name="id" value="{{$configuration->id}}">
                      <div class="form-group{{ $errors->has('meta_title') ? ' has-error' : '' }}">
                        <input type="text" name="meta_title" class="form-control" placeholder="meta_title" value="{{$configuration->meta_title}}">
                        {!! $errors->first('meta_title', '<p class="help-block">:message</p>') !!}
                      </div>
                    
                      <div class="form-group{{ $errors->has('meta_description') ? ' has-error' : '' }}">
                        <textarea class="form-control" rows="5" name="meta_description">{{$configuration->meta_description}}</textarea>
                        {!! $errors->first('meta_description', '<p class="help-block">:message</p>') !!}
                      </div>
                      <div class="form-group{{ $errors->has('meta_keyword') ? ' has-error' : '' }}">
                        <input type="text" name="meta_keyword" class="form-control" placeholder="meta_keyword" value="{{$configuration->meta_keyword}}">
                        {!! $errors->first('meta_keyword', '<p class="help-block">:message</p>') !!}
                      </div>
                       <div class="form-group{{ $errors->has('site_title') ? ' has-error' : '' }}">
                        <input type="text" name="site_title" class="form-control" placeholder="site_title" value="{{$configuration->site_title}}">
                        {!! $errors->first('site_title', '<p class="help-block">:message</p>') !!}
                      </div>
                      <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Simpan">
                      </div>

                    </form>
                  </div>
                </div>
          </div>
      </div>
<?php } ?>
@endsection  