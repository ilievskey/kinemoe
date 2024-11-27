<div class="container p-5">
    <h1>System settings</h1>
    <hr>
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="site_name">Site name</label>
            <input type="text" name="site_name" id="site_name" class="form-control" value="{{ $settings->site_name }}" required>
        </div>
        <div class="form-group">
            <label for="image_path">Site Logo (images will be saved on server)</label>
            <input type="file" class="form-control-file" id="image_path"
                name="image_path">
            @if ($settings->image_path)
                <img src="{{ Storage::url($settings->image_path) }}" class="img-thumbnail mt-2" width="150">
            @endif
        </div>
        <div class="form-group">
            <label for="site_contact">Contact info</label>
            <input type="text" name="site_contact" id="site_contact" class="form-control" value="{{ $settings->site_contact }}" required>
        </div>
        <div class="form-group">
            <label for="site_tos">Site TOS</label>
            <textarea name="site_tos" class="form-control">{{ $settings->site_tos }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


