
@extends('login/login-layouts') 
@section('title','MIS') 
@section('content')​
   
                <div class="limiter">
                    <div class="container-login100">
                        <div class="wrap-login100">
                            <form  action="{{url('checklogin') }}"  method="post">
                                <span class="login100-form-title p-b-26">
                                    MIS
                                </span>
                           {{ csrf_field() }} 
                                <div class="wrap-input100 validate-input" data-validate = "Enter username">
                                    <input class="input100" type="text" name="username">
                                    <span class="focus-input100" data-placeholder="username"></span>
                                </div>

                                <div class="wrap-input100 validate-input" data-validate="Enter password">
                                    <span class="btn-show-pass">
                                        <i class="zmdi zmdi-eye"></i>
                                    </span>
                                    <input class="input100" type="password" name="password">
                                    <span class="focus-input100" data-placeholder="Password"></span>
                                </div>
                            
                                <div class="container-login100-form-btn">
                                    <div class="wrap-login100-form-btn">
                                        <div class="login100-form-bgbtn"></div>
                                        <button class="login100-form-btn" type="submit">
                                            Login
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="dropDownSelect1"></div>
                <!-- refer : https://colorlib.com/wp/template/login-form-v2/ -->
@stop