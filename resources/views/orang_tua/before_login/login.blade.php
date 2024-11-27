<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page</title>
    @vite('resources/css/app.css')
    <!-- FontAwesome for the eye icon (optional) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  </head>
  <body>
    <div
      class="flex w-full h-screen bg-gradient-to-b from-[rgb(137,201,196)] via-[rgb(238,255,248)] to-[rgb(217,238,229)]"
    >
      <!-- Form Section -->
      <div class="w-full flex items-center justify-center lg:w-1/2">
        <div>
          <div class="flex items-center justify-center">
            <img
              src="{{ asset('img/logo2.png') }}"
              alt="Logo"
              class="w-[30%] h-auto object-cover"
            />
          </div>
          <div class="justify-center items-center">
            <h1 class="text-4xl font-extrabold font-poppins text-[#353535]">
              Selamat Datang!
            </h1>
          </div>
          <div class="mt-8">
            <div>
              <label
                for="nik"
                class="text-lg font-poppins font-semibold text-[#353535]"
              >
                NIK
              </label>
              <input
                id="nik"
                class="w-full border-[#35353525] border-2 rounded-full p-3 mt-1 bg-[#DEf0e9]"
                placeholder="Masukkan 16 Digit NIK"
                style="mix-blend-mode: darken"
              />
            </div>
            <div class="mt-4 relative">
              <label
                for="password"
                class="text-lg font-poppins font-semibold text-[#353535]"
              >
                Password
              </label>
              <input
                id="password"
                type="password"
                class="w-full border-[#35353525] border-2 rounded-full p-3 mt-1 bg-[#DEf0e9]"
                placeholder="Masukkan Password"
                style="mix-blend-mode: darken"
              />
            </div>
            <div class="mt-4 flex justify-between items-center">
              <div>
                <input type="checkbox" id="remember" />
                <label class="ml-2 font-medium text-base" for="remember">
                  Remember me
                </label>
              </div>
            </div>
            <div class="mt-4 flex flex-col gap-y-4">
              <button
                class="active:scale-[.98] active:duration-75 hover:sclae-[1.01] ease-in-out transition-all py-2 rounded-3xl w-full bg-[#62BCB1] text-white text-lg font-bold"
              >
                Login
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Image Section -->
      <div
        class="hidden relative lg:flex h-full w-1/2 items-center justify-center bg-gradient-to-b from-[rgb(137,201,196)] via-[rgb(238,255,248)] to-[rgb(217,238,229)]"
      >
        <img
          src="{{ asset('img/login-pict.png') }}"
          alt="Gambar Login"
          class="w-[80%] h-auto object-cover"
        />
      </div>
    </div>

    <!-- Add the JavaScript to toggle the password visibility -->
    <script>
      // Get the password input and eye icon
      const passwordField = document.getElementById('password');
      const togglePassword = document.getElementById('togglePassword');

      // Add an event listener to toggle the password visibility
      togglePassword.addEventListener('click', function () {
        // Check the current type of the input
        const type = passwordField.type === 'password' ? 'text' : 'password';
        passwordField.type = type;

        // Toggle the eye icon between open and closed
        this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
      });
    </script>
  </body>
</html>
