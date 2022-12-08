<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>

    <title>The Rossi Cinema</title>
</head>
<body>
    <!-- component -->
    <div class="min-h-screen bg-black py-6 flex flex-col justify-center sm:py-12">
        <div class="relative py-3 sm:max-w-xl sm:mx-auto">
            <div
                class="absolute inset-0 bg-[#fca311] shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl">
            </div>
            <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
                <div class="max-w-md mx-auto">
                    <div>
                        <h1 class="text-2xl font-semibold">Accedi</h1>
                    </div>
                    <form action="server/login.php" method="post">
                        <div class="divide-y divide-black-200">
                            <div class="py-8 text-base leading-6 space-y-4 text-black-700 sm:text-lg sm:leading-7">
                                <div class="relative">
                                    <input autocomplete="off" id="identifier" name="identifier" type="text" class="peer placeholder-transparent h-10 w-full border-b-2 border-black-300 text-black-900 focus:outline-none focus:borer-rose-600" placeholder="identifier" />
                                    <label for="identifier" class="absolute left-0 -top-3.5 text-black-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-black-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-black-600 peer-focus:text-sm">Username or email</label>
                                </div>
                                <div class="relative">
                                    <input autocomplete="off" id="password" name="password" type="password" class="peer placeholder-transparent h-10 w-full border-b-2 border-black-300 text-black-900 focus:outline-none focus:borer-rose-600" placeholder="Password" />
                                    <label for="password" class="absolute left-0 -top-3.5 text-black-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-black-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-black-600 peer-focus:text-sm">Password</label>
                                </div>
                                <div class="relative">
                                    <input type="submit" name="submit" value="Invia" class="bg-[#fca311] text-black rounded-md px-2 py-1">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>