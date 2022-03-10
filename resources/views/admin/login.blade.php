<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Log In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            background: #e5e5e5;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: sans-serif;
        }
        .custom-container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-container {
            width: 400px;
            min-height: 100px;
            background: white;
            border-radius: 10px;
            box-shadow: 1px 1px 6px rgba(0,0,0,0.2), -1px -1px 6px rgba(0,0,0,0.2);
            padding: 30px 20px;
        }
        .login-container h2 {
            text-align: center;
            margin: 30px 0;
        }
        .custom-login-btn {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="custom-container">
        <div class="login-container">
            <h2>ADMIN LOG IN</h2>
            <form>
                <div class="mb-3">
                  <label for="email" class="form-label">Email address</label>
                  <input type="email" class="form-control" id="email" required>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" required>
                </div>
                <div class="mb-3 form-check">
                  <input type="checkbox" class="form-check-input" name="remember_me" id="remember">
                  <label class="form-check-label" for="remember">Remember me</label>
                </div>
                <button type="submit" class="btn btn-primary custom-login-btn">Login</button>
            </form>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.0/axios.min.js" integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.4/dist/sweetalert2.all.min.js"></script>
    <script>
        const loginForm = document.forms[0];
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const credential = {
                email: loginForm.email.value,
                password: loginForm.password.value,
                remember_me: loginForm.remember_me.checked
            }
            let formdata = formData(credential);
            axios.post('/admin/login', formdata).then(res => {
                const {data: response} = res;
                if (response.success) {
                    window.location.assign('/');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: `${response.message}`,
                    })
                }
            });
        });
        // convert object to form data
        function formData(dataObject) {
            let formdata = new FormData();
            for (const key in dataObject) {
                formdata.append(key, dataObject[key]);
            }
            return formdata;
        }
    </script>
</body>
</html>