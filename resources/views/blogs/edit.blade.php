@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Blog') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <form action="/blogs/{{$blog->id}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Blog Title</label>
                            <input type="text" name="title" class="form-control" value="{{$blog->title}}">
                        </div>

                        <div class="form-group">
                            <label for="">Blog Content</label>
                            <textarea name="content" id="" cols="30" rows="10" class="form-control">{{$blog->content}}</textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
