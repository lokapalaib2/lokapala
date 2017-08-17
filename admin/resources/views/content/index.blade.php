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
  <div class="col-xs-12">
          <div class="box">
            <div class="box-header"> 
            <div class="row">
                <div class="col-xs-6">
                    <a href="{{route('content.create')}}" class="btn btn-success pull-left" >Create New</a>
                </div>
                <div class="col-xs-6">
                    
                </div>
            </div>                             
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                     <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Kategori</th>
                        <th width="220px">Action</th>
                    </tr>
                   
                    	<?php $no=1; ?>
						@foreach($content as $conten)
                         <tr>
                        <td>{{$no++}}</td>
						<td>{{$conten->title}}</td>
						<td>{{$conten->id_category}}</td>
                        <td>
                  			<form method="POST" action="{{ route('content.destroy', $conten->id) }}" accept-charset="UTF-8">
	                            <input name="_method" type="hidden" value="DELETE">
	                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
	                            <a href="{{route('content.edit', $conten->id)}}" class="btn btn-primary">Edit</a>
	                        	<input type="submit" class="btn btn-danger" onclick="return confirm('Anda yakin akan menghapus data ?');" value="Delete">
	                        </form>
                        </td>
                        </tr>
                        @endforeach
                    
              </table>
            </div>
             <div class="box-footer clearfix">
                <div class="pagination pull-right"> {{ $content->links() }} </div>
            </div>
            
           
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    </div>
@endsection  