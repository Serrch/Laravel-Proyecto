<h1>{{$modo}} Monster</h1>

@if (count($errors)>0)
<div
class="alert alert-danger" role="alert">
<ul>
@foreach ( $errors->all() as $error)
<li>  {{ $error }} </li>
@endforeach
</ul >
</div>
@endif

<div class="form-group">
<label for="name"> name</label>    
<input type="text" class="form-control" name="name" value="{{ isset($Monster->name)?$Monster->name:old('name') }}" id="name">
<br>
</div>

<div class="form-group">
<label for="description"> description</label> 
<input type="text"  class="form-control" name="description" value="{{ isset($Monster->description)?$Monster->description:old('description') }}" id="description">

</div>

<div class="form-group">
<label for="category"> category</label> 
<input type="text"  class="form-control" name="category" value="{{isset ($Monster->category) ?$Monster->category:old('category') }}" id="category">

</div>

<div class="form-group">
<label for="ubication"> ubication</label> 
<input type="text"  class="form-control" name= "ubication" value="{{isset ($Monster->ubication) ?$Monster->ubication:old('ubication') }}" id="ubication">

</div>

<div class="form-group">
<label for="wk_elemental"> wk_elemental</label> 
<input type="text"  class="form-control" name= "wk_elemental" value="{{isset ($Monster->wk_elemental) ?$Monster->wk_elemental:old('wk_elemental') }}" id="wk_elemental">

</div>

<div class="form-group">
<label for="wk_estate"> wk_estate</label> 
<input type="text"  class="form-control" name= "wk_estate" value="{{isset ($Monster->wk_estate) ?$Monster->wk_estate:old('wk_estate') }}" id="wk_estate">

</div>


<div class="form-group">
<label for="img_monster"> </label> 
@if(isset($Monster->img_monster))
<img  class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$Monster->img_monster}}" width="100" alt="">
@endif
<input type="file" class="form-control" name="img_monster" value="" id="img_monster">


</div>



<input class="btn btn-success" type="submit" value="{{$modo}} datos">

<a class="btn btn-primary" href="{{url('Monster/')}}"> Regresar</a>
