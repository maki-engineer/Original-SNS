<p class="text-2xl">アカウント登録</p>
<form action="{{ route('account.create') }}" method="post">
    @csrf
    <div class="col-span-6 sm:col-span-4 py-2">
        <label for="icon" class="block text-sm font-medium text-gray-700">アイコン</label>
        <div class="w-12 h-12 border rounded-full border-gray-900 text-2xl flex justify-center items-center m-4">
            +</div>
    </div>
    <div class="col-span-6 sm:col-span-4 py-2">
        <label for="name" class="block text-sm font-medium text-gray-700">ニックネーム</label>
        <input type="text" name="name" id="name" autocomplete="name"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
    </div>
    <div class="col-span-6 sm:col-span-4 py-2">
        <label for="birthday" class="block text-sm font-medium text-gray-700">誕生日</label>
        <input type="date" name="birthday" id="birthday"
            class="mt-1 block w- rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
    </div>
    <div class="flex items-start pt-1 pb-0">
        <div class="flex h-5 items-center">
            <input id="show_age_obscure" name="show_age_obscure" type="checkbox"
                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
        </div>
        <div class="flex-col ml-3 text-sm">
            <label for="show_age_obscure" class="font-medium text-gray-700">年齢をあいまいに表示する</label>
        </div>
    </div>
    <small class="font-light text-gray-700">※チェックすると「10 ~ 20歳」のように表示されます</small>
    <div class="bg-gray-50 px-4 py-3 text-right sm:p-6">
        @method('POST')
        @csrf
        <button type="submit"
            class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">登録</button>
    </div>
</form>
