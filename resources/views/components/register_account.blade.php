<x-auth-card>
    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{ route('account.create') }}">
        @csrf
        <div class="col-span-6 sm:col-span-4 py-2">
            <x-label for="icon" :value="__('アイコン')" />
            <div class="w-12 h-12 border rounded-full border-gray-900 text-2xl flex justify-center items-center m-4">
                +</div>
        </div>
        <div class="col-span-6 sm:col-span-4 py-2">
            <x-label for="name" :value="__('ニックネーム')" />
            <x-input id="name" class="block mt-1 w-full" type="text" name="name" required autocomplete="name" />
        </div>
        <div class="col-span-6 sm:col-span-4 py-2">
            <x-label for="birthday" :value="__('誕生日')" />
            <x-input id="birthday" class="block mt-1 w-full" type="date" name="birthday" required />
        </div>
        <div class="flex items-start pt-1 pb-0">
            <div class="flex h-5 items-center">
                <x-check-box id="show_age_obscure" name="show_age_obscure" />
            </div>
            <div class="flex-col ml-3 text-sm">
                <label for="show_age_obscure" class="font-medium text-gray-700">年齢をあいまいに表示する</label>
            </div>
        </div>
        <small class="font-light text-gray-700">※チェックすると「10 ~ 20歳」のように表示されます</small>

        <div class="flex items-start pt-1 pb-0 mt-3">
            <div class="flex h-5 items-center">
                <x-check-box id="not_show_age" name="not_show_age" />
            </div>
            <div class="flex-col ml-3 text-sm">
                <label for="not_show_age" class="font-medium text-gray-700">年齢を表示しない</label>
            </div>
        </div>

        <div class="px-4 py-3 text-right sm:p-6">
            <x-button class="ml-3">
                {{ __('登録') }}
            </x-button>
        </div>

        <div class="px-4 text-right">
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button class="text-sm text-gray-500 hover:text-gray-800"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    最初からやり直す
                </button>
            </form>
        </div>
    </form>

    <script>
        const show_age_obscure = document.getElementById('show_age_obscure');
        const not_show_age = document.getElementById('not_show_age');

        show_age_obscure.addEventListener('click', () => {
            if (show_age_obscure.checked) not_show_age.checked = false;
        });

        not_show_age.addEventListener('click', () => {
            if (not_show_age.checked) show_age_obscure.checked = false;
        });
    </script>
</x-auth-card>
