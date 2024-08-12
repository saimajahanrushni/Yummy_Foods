<?php
  
  include "./inc/AuthLayoutHeader.php";

?>
          <!-- Register Card -->
          <div class="card px-sm-6 px-0">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center mb-6">
                <a href="index.html" class="app-brand-link gap-2">
                <img src="./assets/img/logo.png" alt="">
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-1">Signup Here</h4>
              

              <form id="formAuthentication" class="mb-6" action="./controller/StoreUser.php" method="POST">
                <div class="mb-6">
                  <label for="username" class="form-label">Username</label>
                  <input
                    type="text"
                    class="form-control"
                    id="username"
                    name="username"
                    placeholder="Enter your username"
                    autofocus />
                    <span class="text-danger"><?=$_SESSION['errors']['name_error'] ?? null ?></span>
                </div>
                <div class="mb-6">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" />
                  <span class="text-danger"><?=$_SESSION['errors']['email_error'] ?? null ?></span>
                </div>
                <div class="mb-6 form-password-toggle">
                  <label class="form-label" for="password">Password</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password" />
                      <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                    <span class="text-danger"><?=$_SESSION['errors']['password_error'] ?? null ?></span>
                </div>
                <div class="mb-6 form-password-toggle">
                  <label class="form-label" for="confirm_password">Confirm Password</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="confirm_password"
                      class="form-control"
                      name="confirm_password"
                      placeholder="**********"
                      aria-describedby="password" />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>

                <div class="my-8">
                  <div class="form-check mb-0 ms-2">
                    <input class="form-check-input" type="checkbox" id="terms-conditions" value="<?= true ?>" name="terms" />
                    <label class="form-check-label" for="terms-conditions">
                      I agree to
                      <a href="javascript:void(0);">privacy policy & terms</a>
                    </label>
                  </div>
                  <span class="text-danger"><?=$_SESSION['errors']['terms_error'] ?? null ?></span>
                </div>
              
                <button class="btn btn-primary d-grid w-100">Sign up</button>
              </form>

              <p class="text-center">
                <span>Already have an account?</span>
                <a href="./signin.php">
                  <span>Sign in instead</span>
                </a>
              </p>
            </div>
          </div>
          <!-- Register Card -->

<?php

include "./inc/AuthLayoutFooter.php";
session_unset();

?>