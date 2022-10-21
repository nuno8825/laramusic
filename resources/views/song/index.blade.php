<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('あなたの楽曲を一覧表示') }}
      </h2>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <table class="text-left w-full border-collapse">

                <thead>
                    <tr>
                    <th class="py-3 px-6 bg-grey-lightest font-bold text-lg text-grey-dark border-b border-grey-light">ここに検索機能もってくる</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($songs as $index => $song)
                    <tr class="hover:bg-grey-lighter">
                    <td class="py-4 px-6 border-b border-grey-light">

                        {{-- 曲の情報の表示 --}}
                        <form action="{{ route('song.destroy',$song->id) }}" method="POST">
                            @method('delete')
                            @csrf
                            <div class="flex container">
                                <div class="w-1/6">
                                <img class="w-16 h-16" src={{$song->image_url}}>
                                </div>
                                <div class="w-1/3">
                                <h3 class="text-left font-bold text-lg text-grey-dark" name="song" id="song">{{$song->song}}</h3>
                                <h3 class="text-left font-bold text-lg text-grey-dark">{{$song->artist}}</h3>
                                </div>
                                <div class="w-5/12">
                                <audio controls src={{$song->music_url}}></audio>
                                </div>
                                <div class="w-1/12">
                                <button type="submit" class="rounded-md mt-2 px-2 py-2 font-medium tracking-widest text-white bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                                    削除
                                </button>
                                </div>
                            </div>
                        </form>

                        {{-- 登録するタグの表示 --}}
                        <div class="mt-2">
                            <form class="flex" action="{{ route('categorized.store') }}" method = "POST">
                                @csrf
                                <select class="hidden" name="song">
                                    <option>{{$song->song}}</option>
                                </select>
                                <select name="tag_title">
                                @foreach ($tag_units[$index] as $tag)
                                    <option>{{$tag->tag_title}}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="ml-2 rounded-md px-1 py-1 text-xs font-light tracking-widest text-white bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                                    追加
                                </button>
                            </form>
                        </div>

                        {{-- 登録済みタグの表示 --}}
                        <div class="flex">
                            @foreach($song->tags as $tag)
                            <form action="{{ route('untags', ['song' => $song->id ,'tag' => $tag->id]) }}" method="POST">
                                @method('get')
                                @csrf
                                <div class="tag">
                                    {{$tag->tag_title}}
                                    <button type="submit" class="rounded-md px-1 py-1 text-xs font-light tracking-widest text-white bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                                        解除
                                    </button>
                                </div>
                            </form>
                            @endforeach
                        </div>

                    </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
</x-app-layout>


<style>
    .container {
        justify-content : space-between;
    }
    .tag {
        display: inline-block;
        margin: .5em .5em 0 0;
        padding: .4em;
        line-height: 1;
        text-decoration: none;
        color: black;
        background-color: #fff;
        border: 1px solid black;
        border-left: 5px solid black;
    }
</style>
