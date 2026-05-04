<form method="POST" action="{{ route('spaces.update',$space->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" placeholder="Enter Spaces Title" id="title" name="title"
                class="form-control" value="{{ $space->title }}">
        </div>
        <div class="form-group">
            <label for="title">Description</label>
            <textarea class="form-control" id="new-task" id="summary" name="summary"
                placeholder="Enter Space Description. . ."  value="{{ $space->summary }}">{{ $space->summary }}</textarea>
        </div>
        <div class="form-group row">
            <div class="col-md-12">
                <label for="title">Icon</label>
                <input type="file" id="icon" name="icon" class="form-control" value="{{ $space->icon }}" onchange="iconUpload(this)">
            </div>
            <div class="col-md-12 text-center">
                <img src="{{ asset($space->icon) }}" class="iconUpload image-show">
                <input type="hidden" name="icon_old" value="{{ $space->icon }}">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-12">
                <label for="title">Image</label>
                <input type="file" placeholder="Enter Space Image" value="{{ $space->image }}" id="image" name="image"
                    class="form-control" onchange="imageUpload(this)">
            </div>
            <div class="col-md-12 text-center">
                <img src="{{ asset($space->image) }}" class="imageUpload image-show">
                <input type="hidden" name="image_old" value="{{ $space->image }}">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" title="">Cancel</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
