<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
</head>
<body>
    <div class="bg-gray-50">
        <div class="min-h-screen flex flex-col items-center justify-center py-6 px-4">
            <div class="max-w-md w-full">
                <a href="">
                    <img src="{{asset('assets/img/indra_hrms_logo.png')}}" class="w-40 mb-4 mx-auto p-2 rounded-lg" alt="logo">
                </a>
                <div class="p-8 rounded-2xl bg-white shadow">
                    <h2 class="text-gray-800 text-center text-2xl font-bold">Login</h2>

                    <form action="" id="loginform" method="POST" class="mt-8 space-y-4">
                        @csrf
                        <div>
                            <label class="text-gray-800 text-sm mb-2 block">Email</label>
                            <input type="text" name="email" required
                                class="w-full text-gray-800 border border-gray-300 px-4 py-3 rounded-md focus:border-cyan-500 focus:ring-cyan-500"
                                placeholder="Enter email">
                        </div>
                        <div>
                            <label class="text-gray-800 text-sm mb-2 block">Password</label>
                            <input type="password" name="password" required
                                class="w-full text-gray-800 border border-gray-300 px-4 py-3 rounded-md focus:border-cyan-500 focus:ring-cyan-500"
                                placeholder="Enter password">
                        </div>
                        <div>
                            <button type="submit"
                                class="w-full py-3 px-4 bg-cyan-500 text-white font-semibold rounded-lg hover:bg-cyan-600">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var adminLoginUrl = "{{ route('userlogins') }}";
        var adminIndexUrl = "{{ route('user.index') }}";
    </script>
    <script src="{{ asset('assets/js/login.js') }}"></script>

</body>
</html>
