@include('includes.header')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Categories</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            @foreach (['danger', 'warning', 'success', 'info'] as $key)
              @if(Session::has($key))
                <p class="flashMsg alert alert-{{ $key }}">{{ Session::get($key) }}</p>
              @endif
            @endforeach

            <div class="card">
                <div class="card-header">
                  <a href="{{ route('categories.create') }}" class="btn btn-primary">Add Category</a>
                </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Sr. No</th>
                      <th>Name</th>
                      <th>Image</th>
                      <th>Sub Categories</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $i=1; @endphp
                    @if(isset($categories) && !empty($categories))
                      @foreach($categories as $categories)
                      <?php
                          $sub_category_names = array();
                          
                          if(isset($categories->sub_categories) && !empty($categories->sub_categories)){
                            $sub_category_names = array_column(json_decode($categories->sub_categories), 'name'); // get sub cat name in array
                          }

                          $path = public_path("/uploads/images/".$categories->image);

                          if(file_exists($path)){
                            $image_name = url("/uploads/images/".$categories->image);
                          }
                          else{
                            $image_name = url("/uploads/images/sample_image.jpg");
                          }
                      ?>
                        <tr>
                          <td>{{ $i++ }}</td>
                          <td>{{ $categories->name }}</td>
                          <td><img src="{{ $image_name }}" alt="Image" height="80px" width="80px" /></td>
                          <td>{{ implode(', ',$sub_category_names) }}</td>
                          <td>
                            <a href="{{ route('categories.edit',$categories->id) }}" class="btn btn-primary tableActionBtn editBtn" title="Edit Project"><i class="right fas fa-edit"></i></a>
                            <form action="{{ route('categories.destroy', $categories->id) }}" method="POST">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-danger tableActionBtn deleteBtn" title="Delete Category"><i class="right fas fa-trash"></i></button>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>
@include('includes.footer')

<script type="text/javascript">
  $('.deleteBtn').click(function(){
    if(confirm('Are you sure you want to delete this category.?')){
      return true;
    }
    else{
      return false;
    }
  });
</script>