<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-red-700">
    <div class="flex gap-x-4 p-4 h-lvh">
        <div class="flex-grow">
            <div class="flex justify-center items-center h-full">
                <div class="bg-white rounded-md shadow-lg p-4">
                    <h3 class="font-semibold text-2xl mb-4">Our Newsletter</h3>
                    <form method="POST" action="{{ route('addContact') }}" class="[&_div]:mb-4 [&_input]:flex [&_input]:w-full [&_input]:px-2 [&_input]:py-1 [&_input]:mt-1 [&_input]:border [&_input]:rounded">
                        @csrf
                        <div class="inputbox">
                            <label for="f-name">Full Name:</label>
                            <input id="f-name" type="text" name="FNAME" class="form-control" required="required">
                        </div>
                        <div class="inputbox">
                            <label for="mail">Email:</label>
                            <input id="mail" type="text" name="EMAIL" class="form-control" required="required">
                        </div>
                        <div class="inputbox">
                            <label for="phone">Phone:</label>
                            <input id="phone" type="phone" name="PHONE" class="form-control" required="required">
                        </div>
                        <div class="inputbox">
                            <label for="f-name" class="flex justify-between">List Id:<a class="text-red-700" href="{{ route('audiance_list')}}" target="_blank">Get from here</a></label>
                            <input id="f-name" type="text" name="list_id" class="form-control" required="required">
                            
                        </div>
                        <button type="submit" class="w-full bg-red-800 text-white hover:bg-red-600 px-4 py-1 rounded">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
