  <footer>
      <div class="container">
          <div class="row ">
              <div class="col-lg-4">
                  <div class="first-item">
                      <div class="logo">
                          <img width="100px" height="100px" class="img-fluid"
                              src="{{ asset('assets/img/book1.png') }}" alt="hexashop ecommerce templatemo">
                      </div>
                      <ul>
                          <li><a href="#">16501 Collins Ave, Sunny Isles Beach, FL 33160, United States</a></li>
                          <li><a href="#">bookStore@hotmail.com</a></li>
                          <li><a href="#">010-020-0340</a></li>
                      </ul>
                  </div>
              </div>
              <div class="col-lg-4 text-center">
                  <h4>Best Categories</h4>
                  <ul>
                      <li><a href=" {{ route('products.product-category', ['category' => 1]) }} ">Fantasy</a></li>
                      <li><a href=" {{ route('products.product-category', ['category' => 2]) }}">Adventure</a></li>
                      <li><a href=" {{ route('products.product-category', ['category' => 4]) }}">Contemporary</a></li>
                      <li><a href=" {{ route('products.product-category', ['category' => 3]) }}">Romance</a></li>
                      <li><a href=" {{ route('products.product-category', ['category' => 5]) }}">Art</a></li>
                      <li><a href=" {{ route('products.product-category', ['category' => 6]) }}">Mystery</a></li>
                  </ul>
              </div>
              <div class="col-lg-4 text-center">
                  <h4>Useful Links</h4>
                  <ul>
                      <li><a href="{{ route('home') }}">Homepage</a></li>
                      <li><a href="{{ route('users.profile-settings') }}">Profile</a></li>
                  </ul>
              </div>

              <div class="col-lg-12">
                  <div class="under-footer">
                      <p>Copyright © 2022 BookStore., Ltd. All Rights Reserved.

                          <br>Distributed By: <a href="https://themewagon.com" target="_blank"
                              title="free & premium responsive templates">Rolan Piñeres</a>
                      </p>
                      <ul>
                          <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                          <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                          <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                          <li><a href="#"><i class="fa fa-behance"></i></a></li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
  </footer>
