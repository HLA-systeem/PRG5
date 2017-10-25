@if(session('succes'))
  <div class="alert alert-success">{{session('succes')}}</div>
@endif

@if(session('error'))
  <div class="alert alert-danger">{{session('error')}}</div>
@endif