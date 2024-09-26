@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Left Column: Login Form -->
        <div class="col-md-6 loginLeft">
            <img src="https://sampark.iimcip.com/public/front_end/images/logo.png" class="img-fluid" />
            <div class="loginForm">
                <h1>Login</h1>
                <p>Welcome back, please login to your account.</p>
                <form id="loginForm" name="loginFrm" action="https://sampark.iimcip.com/signin" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Email-id:</label>
                        <input type="email" name="email_id" class="form-control" required="required" />
                    </div>
                    <div class="form-group">
                        <label>Password:</label>
                        <input type="password" name="password" class="form-control" required="required" />
                    </div>
                    <div class="loginbtm">
                        <div class="remember">
                            <label class="checkboxCont">
                                <input type="checkbox" name="rm_me" class="form-control" value="1"> Remember Password
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-default" value="Login" />
                    </div>
                    <div class="form-group">
                        <p>Don't have an account? <a href="#" class="toggle-form">Sign Up</a></p>
                        <p><a href="https://sampark.iimcip.com/forget-password">Forgot Password?</a></p>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Column: Signup Form -->
        <div class="col-md-6 signupRight d-none" id="signupFormContainer">
            <h1>Signup</h1>
            <p>Please fill the details below and create an account.</p>
            <div class="signupForm">
                <form id="signupForm" name="signupFrm" action="https://sampark.iimcip.com/signup" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="stepform" id="signup_step1">
                        <div class="form-group">
                            <label>Startup Name:</label>
                            <input type="text" class="form-control" name="member_company" required="required" />
                        </div>
                        <div class="form-group">
                            <label>Code:</label>
                            <input type="text" class="form-control" name="code" id="code" required="required" />
                        </div>
                        <div class="form-group">
                            <label>Industry Verticals:</label>
                            <select class="form-control indusCatIds" name="industry_category_id[]" id="indusCatIds" multiple="multiple" required="required" style="width: 100%;">
                                <option value="">Select Industry Verticals</option>
                                <!-- Add options here -->
                            </select>
                        </div>
                        <div class="btn-wrap">
                            <button type="button" class="nextBtn">Next</button>
                        </div>
                    </div>

                    <div class="stepform" id="signup_step2">
                        <div class="form-group">
                            <label>Startup Stage:</label>
                            <select class="form-control" name="stage_id" required="required">
                                <option value="">Select Startup Stage</option>
                                <!-- Add options here -->
                            </select>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Email:</label>
                                <input type="email" class="form-control" name="email_id" required="required" />
                            </div>
                            <div class="form-group col-md-6">
                                <label>Contact Name:</label>
                                <input type="text" class="form-control" name="contact_name" required="required" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Password:</label>
                                <input type="password" class="form-control" name="password" id="password" required="required" />
                            </div>
                            <div class="form-group col-md-6">
                                <label>Confirm Password:</label>
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" required="required" />
                            </div>
                        </div>
                        <div class="btn-wrap">
                            <button type="button" class="prevBtn">Previous</button>
                            <button type="button" class="nextBtn">Next</button>
                        </div>
                    </div>

                    <div class="stepform" id="signup_step3">
                        <div class="form-group">
                            <label>Mobile:</label>
                            <input type="text" class="form-control onlyNumber" name="contact_no" required="required" />
                        </div>
                        <div class="form-group">
                            <label>Country:</label>
                            <input type="text" class="form-control" name="country" required="required" />
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>City:</label>
                                <input type="text" class="form-control" name="city" required="required" />
                            </div>
                        </div>
                        <div class="btn-wrap">
                            <button type="button" class="prevBtn">Previous</button>
                            <button type="button" class="nextBtn">Next</button>
                        </div>
                    </div>

                    <div class="stepform" id="signup_step4">
                        <div class="form-group">
                            <label>Website:</label>
                            <input type="text" class="form-control" name="website" />
                        </div>
                        <div class="form-group">
                            <label>Legal Status:</label>
                            <select class="form-control" name="legal_status">
                                <option>Status 1</option>
                                <option>Status 2</option>
                                <option>Status 3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Image:</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="btn-wrap">
                            <button type="button" class="prevBtn">Previous</button>
                            <button type="submit" class="finishBtn">Finish</button>
                        </div>
                    </div>

                    <div class="step-count">
                        <span class="step active" id="signup_step1_indicator"></span>
                        <span class="step" id="signup_step2_indicator"></span>
                        <span class="step" id="signup_step3_indicator"></span>
                        <span class="step" id="signup_step4_indicator"></span>
                    </div>
                    <div class="form-group">
                        <p>Already have an account? <a href="#" class="toggle-form">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleLink = document.querySelectorAll('.toggle-form');
        const loginLeft = document.querySelector('.loginLeft');
        const signupRight = document.querySelector('.signupRight');
        const signupFormContainer = document.getElementById('signupFormContainer');

        toggleLink.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                if (signupRight.classList.contains('d-none')) {
                    signupRight.classList.remove('d-none');
                    loginLeft.classList.add('d-none');
                } else {
                    signupRight.classList.add('d-none');
                    loginLeft.classList.remove('d-none');
                }
            });
        });
    });
</script>
@endsection
