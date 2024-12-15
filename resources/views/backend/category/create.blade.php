@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>Categories</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Categories</li>
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
                    <div class="card-header">
                        <h3 class="card-title">Create Categories</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form method="post" action="{{ url('/admin/category/') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                            <div class="row">
                            
                                <div class="form-group col-6">
                                    <label for="exampleInputEmail1">Title</label>
                                    <input class="form-control title-input" name="name" placeholder="Title">
                                </div>
                               
                            </div>
                            <div class="form-group">
                                <input type="hidden" class="form-control slug-input" name="slug" placeholder="Slug">
                            </div>

                            
                            <div class="float-right">
                                <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Save</button>
                            </div>
                            
                        </form>
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
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/summernote/summernote-bs4.min.css" />

@endpush

@push('js')   
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    

    <!-- slug -->
    <script>
    const titleInput = document.querySelector('.title-input');
    const slugInput = document.querySelector('.slug-input');

    titleInput.addEventListener('input', () => {
        const title = titleInput.value;
        const slug = slugify(title);
        slugInput.value = slug;
    });

    function slugify(text) {
        return text.toString().toLowerCase()
        .replace(/\s+/g, '-') // Replace spaces with -
        .replace(/[^\w\-]+/g, '') // Remove all non-word chars
        .replace(/\-\-+/g, '-') // Replace multiple - with single -
        .replace(/^-+/, '') // Remove leading -
        .replace(/-+$/, ''); // Remove trailing -
    }
    </script>

@endpush
