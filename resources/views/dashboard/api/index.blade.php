@extends('dashboard.layouts.main')
@section('container')

    <h1 id="home" class="mt-3">API Docs</h1>
    <br>
    
    <form id="token-form" action="/api/login" method="post" class="mb-5 col-lg-6 mx-auto">
        @csrf
        <div class="form-floating">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" autofocus required value="{{ old('email') }}">
            <label for="email">Email address</label>
            @error('email')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <div class="form-floating" id="pass">
              <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
              <label for="password">Password</label>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm col-md-6">
                    <div class="input-group mb-3">
                        <input type="submit" class="btn btn-dark form-control mt-2" value="Generate Token">
                    </div>
                </div>
            </div>
        </form>

        <div id="token-result" style="display: none;">
            <h2>Generated Token:</h2>
            <p id="token-text" style="word-wrap: break-word;"></p>
        </div>
        

        <div class="col-sm col-md-8 mx-auto fs-5">

            <section id="introduction"> 
            <h3>Introduction</h3>
            <p>&emsp;&emsp;The API generated token has Authorization only for admin role. Generate token 
            first add in Header key Authorization with value adding word Bearer in front of generated token 
            with 1 space. for example Bearer GeneratedToken
            </p>
        </section>
        <section id="article">
            <h3>Article</h3>
        </section>
        <section id="articleget">
            <h4>/api/posts/</h4>
            
            <h5>&emsp;GET</h5>
            
            <p>&emsp;&emsp; Getting Article with GET Method. 
            </p>
            <h5>&emsp;Parameters : </h5>
            <P>&emsp;&emsp;You can Add Parameter category, author (with value your username), search (to find contains word in title or body) , all of parameters or without parameter to get all post</P>
            </section>
            <section id="articlepost">
            <h5>&emsp;POST</h5>
            <p>&emsp;&emsp; Add new Article with POST Method using Body form-data with key title, body
                with value string type and category_id with int id type 
            </p>
        </section>
        <h4>/api/posts/{slug}</h4>
        <section id="articleputpatch">
            <h5>&emsp;PUT|PATCH</h5>
            <p>&emsp;&emsp; Update Article with PUT or PATCH Method using Body x-www-form-urlencoded
                 with key title, body with value string type and category_id with int id type 
            </p>
        </section>
        <section id="articledelete">
            <h5>&emsp;DELETE</h5>
            <p>&emsp;&emsp; Delete 1 Article with DELETE Method 
            </p>
        </section>
        <section id="category">
            <h3>Category</h3>
        </section>
        <section id="categoryget">
            <h4>/api/category/</h4>
            <h5>&emsp;GET</h5>
            <p>&emsp;&emsp; Getting All Category with GET Method. </p>
        </section>
        <section id="categorypost">
            <h5>&emsp;POST</h5>
            <p>&emsp;&emsp; Add new Category with POST Method using Body form-data with key name and value string type 
            </p>
        </section>
        <h4>/api/categories/{slug}</h4>
        <section id="categoryputpatch">
            <h5>&emsp;PUT|PATCH</h5>
            <p>&emsp;&emsp; Update Category with PUT or PATCH Method using Body x-www-form-urlencoded
                 with key name with value string type
        </section>
        <section id="categorydelete">
            <h5>&emsp;DELETE</h5>
            <p>&emsp;&emsp; Delete 1 Category with DELETE Method 
            </p>
        </section>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#token-form').submit(function(event) {
                event.preventDefault();

                var form = $(this);

                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: form.serialize(),
                    success: function(response) {
                        $('#token-text').text(response.authorization.token);
                        $('#token-result').show();
                    },
                    error: function() {
                        alert('Error occurred during token generation.');
                    }
                });
            });
        });
    </script>
@endsection