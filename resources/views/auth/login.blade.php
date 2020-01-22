@extends('layouts.login') @section('content')

       
        <form  class="login-form" action="{{ route('login') }}" method="post">
             {{ csrf_field() }}
               <img style="  transform: translate(100px, 10px);padding-bottom: 20px;" src="{{ asset('images/logo.gif')}}" alt="">
               <div class="row">
                    <div class="col-md-12">
                        <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" id="email" type="text" class="form-control"
                            name="email" value="{{ old('idUsuario') }}" required placeholder="Ingrese Email"> @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label visible-ie8 visible-ie9">Password</label>
                            <input id="password" type="password" class="form-control form-control-solid placeholder-no-fix form-group" name="password"
                            required placeholder="Ingrese Contraseña"> @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                      <button class="btn green" type="submit">Ingresar</button>

                </div>
      
                <div class="create-account">
                    <p>
                        <a href="javascript:;" id="register-btn" class="uppercase">WWW.agence.COM</a>
                    </p>
                </div>


            </form>
           

@endsection

