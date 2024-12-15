@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>Posts</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ url('admin/posts') }}">Posts</a></li>
            </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->                   
                    <div class="card-body p-0">                        
                        <div class="mailbox-read-info">
                            <h5>{{ $post->title }}</h5>
                            <span class="mailbox-read-time float-right">{{ $post->created_at }}</span></h6>
                            <br>
                        </div>
                        <!-- /.mailbox-read-info -->

                        <div class="mailbox-read-message text-center">
                            <img src="{{ asset($post->image) }}" class="img-fluid rounded w-75 p-3">                   
                        </div>
                       
                        <!-- /.mailbox-controls -->
                        <div class="mailbox-read-message">
                            <p>{!! $post->content !!}</p>                      
                        </div>
                        <!-- /.mailbox-read-message -->
                                             
                    </div>
                    <!-- /.card-body -->

                    
                </div>
                <!-- /.card -->

            
            <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
@endsection

{{-- Add common CSS customizations --}}

@push('css')
    

@endpush

@push('js')   
    

@endpush

