<div class="col-md-12">
  <div class="form-group margin-b-5 margin-t-5{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name">Name *</label>
    <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name', $record->name) }}" required>    @if ($errors->has('name'))
    <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span> @endif
  </div>
  <!-- /.form-group -->
</div>
<!-- /.col-md-12 -->

<div class="col-md-12">
  <div class="form-group margin-b-5 margin-t-5{{ $errors->has('detail') ? ' has-error' : '' }}">
    <label>Category</label>
    <select name="categorys[]" id="category" class="form-control select2" multiple="multiple" data-placeholder="Select a State"
      style="width: 100%;">
        @foreach(\App\Category::All() as $category)
          <option value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
    </select>
  </div>
  <!-- /.form-group -->
</div>
<!-- /.col-md-12 -->

<!--Category-->
<div id="category_php" style="display: none;">
  @foreach($record->Categories as $category)
  <p>{{$category->id}}</p>
  @endforeach
</div>
{{-- Footer Extras to be Included --}} 
@section('footer-extras')
<script>
  $(document).ready(function() {
    $('#category').select2(); 
    var data = [];

    $('#category_php p').each(function(){
      data.push($(this).text());
    });
    console.log(data);
      $('#category').val(data); 
      $('#category').trigger('change'); // Notify any JS components that the value changed
    
  });

</script>
@parent
@endsection