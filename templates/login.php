<div class="container">
    <div class = "row">
        <div class = "col-12">
            <h1>Login</h1>
            <form action="login/login" method="post">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Email address</label>
                    <input type="email" class="form-control" placeholder="name@example.com" id="email" name="email" required>
                 </div>
                 <div class="form-group">
                    <label for="exampleFormControlInput1">Password</label>
                    <input type="password" class="form-control" placeholder="password" id="password" name="password" required>
                </div>
                <a class="btn btn-secondary" href="/">Back</a>
                <input class="btn btn-primary" type="submit" value="LogIn">
                <a class="btn btn-secondary" href="/signup">SignUp</a>
            </form>
        </div>
    </div>
</div>