<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Document</title>

</head>
<body>
<div class="w-4/5 mx-auto">
    <div class="text-center pt-5">
        <h1 class="text-3xl text-gray-700">
            Edit: {{ $post->title }}
        </h1>
        <hr class="border border-1 border-gray-300 mt-5">
    </div>
    <div class="pb-4">
        @if($errors->any())
            <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                Something went wrong...
            </div>
            <ul class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                @foreach($errors->all() as $error)
                    <li>*{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>
    <div class="m-auto pt-4">
        <form
            action="{{ route('blog.update',$post->id) }}"
            method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <label for="is_published" class="text-gray-500">
                Is Published
            </label>
            <input
                type="checkbox"
                class="bg-transparent block border-b-2 inline  outline-none"
                name="is_published"
                checked="{{ $post->is_published}}"

            >

            <input
                type="text"
                name="title"
                class="bg-transparent block border-b-2 w-full h-10 my-5  text-lg outline-none"
                value="{{ $post->title }}"
            >

            <input
                type="text"
                name="excerpt"
                class="bg-transparent block border-b-2 w-full h-10 my-10  text-lg outline-none"
                value="{{ $post->excerpt }}"

            >

            <input
                type="number"
                name="min_to_read"
                class="bg-transparent block border-b-2 w-full h-10 my-10  text-lg outline-none"
                value="{{ $post->min_to_read }}"
            >

            <textarea
                name="body"
                class="py-20 bg-transparent block border-b-2 w-full h-10 my-5  text-lg outline-none"
                value="{{ $post->body }}"


            >
            {{ $post->body }}
            </textarea>

            <div class="bg-grey-lighter  flex gap-10">
                <label class="w-44 flex flex-col items-center px-2 py-3 bg-white-rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer">
                    <span class="text-base leading-normal">
                        Select a file
                    </span>
                    <input
                        type="file"
                        name="image_url"
                        class="hidden"
                        value="{{$post->image_url}}"
                    >
                </label>
                <button
                    type="submit"
                    class="uppercase  bg-blue-500 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">
                    Submit Post
                </button>
            </div>

        </form>
    </div>
</body>
</html>
