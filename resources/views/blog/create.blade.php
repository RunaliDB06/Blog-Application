@extends('layouts.master')
@section('content')
<script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Form</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blog</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Add Some Article</h3>
            </div>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ Route('store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card-body">
                    <div class="form-group">
                        <label for="titlle">Title</label>
                        <input type="text" class="form-control" id="tittle" name="tittle"
                            value={{ old('tittle') }}>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Description</label>
                        <textarea id="body" name="dis" rows="4" cols="50" class="form-control">{{ old('dis') }}</textarea>


                    </div>
                    <div class="form-group">
                        <label>Select Category</label>
                        <select name="category_id"class="form-control">
                            <option value="" class="option_colour">Select Category</option>
                            @foreach ($categories as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach


                        </select>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label class="profile_image">Image</label>
                            <input type="file" name="profile_image" id="profile_image">
                        </div>
                        <label>Status</label>
                        <select name="status"class="form-control">
                            <option value="" class="option_colour">Select Satus</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>


                        </select>
                    </div>
                    
                        <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('blog.index') }}"><button type="button" class="btn btn-info">Back </button></a>

                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        ClassicEditor
                .create( document.querySelector( '#body' ) )
                .then( editor => {
                        console.log( editor );
                } )
                .catch( error => {
                        console.error( error );
                } );
</script>
@endsection
