@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Products') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('product:store') }}" enctype="multipart/form-data">
                        @csrf

                        <select class="form-select" name="category" aria-label="Default select example">
                            <option selected>Category</option>
                            @foreach ($categories as $category )
                                <option value="{{ $category->id }}">{{ $category->type }}</option>    
                            @endforeach
                          </select>

                        <div class="md-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                        </div>
                        <div class="md-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="text" name="price" class="form-control" id="price" placeholder="Price">
                        </div>
                        <div class="md-3">
                            <label for="name" class="form-label">Description</label>
                            <input type="text" name="description" class="form-control" id="description" placeholder="Description">
                        </div>
                        <div class ="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <div>
                                <input type="file" name="image" class="" id="image" placeholder="">
                            </div>
                        </div>


                        <input type="submit" class="form-control" placeholder="">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
