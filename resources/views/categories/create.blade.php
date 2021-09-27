@include('includes.header')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Category</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            @if ($errors->any())
              <ul class="alert alert-danger">
              @foreach ($errors->all() as $error)
                <li style="margin-left:10px !important;">{{$error}}</li>
              @endforeach
              </ul>
            @endif

            @foreach (['danger', 'warning', 'success', 'info'] as $key)
              @if(Session::has($key))
                <p class="flashMsg alert alert-{{ $key }}">{{ Session::get($key) }}</p>
              @endif
            @endforeach
            
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Category</h3>
              </div>

              <form method="POST" action="{{ route('categories.store') }}" id="addCategoriesForm" role="form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="addform">
                <div class="card-body">
                  <div class="form-group">
                    <label>Category Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Category Name" required>
                  </div>

                  <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control" accept="image/png, image/jpg, image/jpeg" />
                  </div>

                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Category Email" required>
                  </div>

                  <label>Sub Categories</label>

                  <div class="form-group">
                    <div id="sub_category_section">
                      <div id="subcat">
                        <input type="text" name="sub_category[]" class="form-control addSubCategoryFirstTextBox" placeholder="Sub Category Name" required>
                        <span class="btn btn-primary addSubCategoryBtn" title="Add Sub Category"><i class="fas fa-plus"></i></span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
          <div class="col-md-2"></div>
        </div>
      </div>
    </section>
</div>
@include('includes.footer')

<script type="text/javascript">
  $(".addSubCategoryBtn").click(function(){
    var html = "";
    html += "<div id='subcat'><input type='text' name='sub_category[]' class='form-control addSubCategoryOtherTextBox' placeholder='Sub Category Name'><span class='btn btn-danger removeSubCategoryBtn' title='Remove Sub Category' onclick='removeSubCategory(this)'><i class='fas fa-times'></i></span></div>";
    $('#sub_category_section div#subcat:last').after(html);
  });

  function removeSubCategory(ele){
    $(ele).parent('div').remove();
  }
</script>