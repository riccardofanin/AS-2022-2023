<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Rossi Cinema</title>
    <script src="https://cdn.tailwindcss.com"></script>
	<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">  
</head>
<body class="">
    <div class="flex justify-center items-center min-h-screen bg-black">
        <div class="h-auto w-80 bg-white p-3 rounded-lg">
            <p class="text-xl font-semibold">Dettagli di pagamento</p>
            <div class="input_text mt-6 relative"> <input type="text" class="h-12 pl-7 outline-none px-2 focus:border-blue-900 transition-all w-full border-b " placeholder="John Row" /> <span class="absolute left-0 text-sm -top-4">Intestatario</span> <i class="absolute left-2 top-4 text-gray-400 fa fa-user"></i> </div>
            <div class="input_text mt-8 relative"> <input type="text" class="h-12 pl-7 outline-none px-2 focus:border-blue-900 transition-all w-full border-b " placeholder="0000 0000 0000 0000" data-slots="0" data-accept="\d" size="19" /> <span class="absolute left-0 text-sm -top-4">Numero della carta</span> <i class="absolute left-2 top-[14px] text-gray-400 text-sm fa fa-credit-card"></i> </div>
            <div class="mt-8 flex gap-5 ">
                <div class="input_text relative w-full"> <input type="text" class="h-12 pl-7 outline-none px-2 focus:border-blue-900 transition-all w-full border-b " placeholder="mm/yyyy" data-slots="my" /> <span class="absolute left-0 text-sm -top-4">Scadenza</span> <i class="absolute left-2 top-4 text-gray-400 fa fa-calendar-o"></i> </div>
                <div class="input_text relative w-full"> <input type="text" class="h-12 pl-7 outline-none px-2 focus:border-blue-900 transition-all w-full border-b " placeholder="000" data-slots="0" data-accept="\d" size="3" /> <span class="absolute left-0 text-sm -top-4">CVV</span> <i class="absolute left-2 top-4 text-gray-400 fa fa-lock"></i> </div>
            </div>
            <p class="text-lg text-center mt-4 text-gray-600 font-semibold">Totale : </p>
            <div class="flex justify-center mt-4"> <button class="outline-none pay h-12 bg-orange-600 text-white mb-3 hover:bg-orange-700 rounded-lg w-1/2 cursor-pointer transition-all">Pay</button> </div>
        </div>
    </div>
</body>
</html>