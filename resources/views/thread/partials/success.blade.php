@if (session('message'))
<div class="alert alert-dismissible alert-info">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>{{session('message')}}</strong>
</div>    
@endif