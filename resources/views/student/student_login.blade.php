
@extends('layouts.student_app')
@section('content')
    <div class="container">
    <br><br><br><br><br>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Student Login') }}</div>
                    @if(session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>  
                    @endif     
                    @if (session('message'))
                    <div class="alert alert-success">
                    {{ session('message') }}
                    </div>
                    @endif
                    <div class="card-body">
                        <form method="POST" action="{{ url('student/stud_login') }}" class="database_operation">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                    <a class="btn btn-link" href="forget-password">
                                    Forgot Your Password ?
                                </a>
                                </div>
                            </div>
                            <div>
                                <br><br>
						        <p class="text-center"> Don't have an account ? <a href="{{ url('student/signup') }}">Sign-up</a></p>
					        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script> 
 $(document).on('submit','.database_operation',function(){
    var student_PRNo=$(this).attr('action');
    $.get(BASE_URL='/student/stud_login/'+studentPRNo,function(fb){
        
    })
});
</script>
</html>
