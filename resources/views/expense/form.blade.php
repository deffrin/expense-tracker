<div class="space-y-6 pb-6 md:pb-0">
    <div>
        <label for="amount" class="font-sans antialiased text-sm text-stone-800  font-semibold">
            Amount
        </label>

        <div class="relative w-full">
            <input id="amount" name="amount" placeholder="Amount" type="number" step="any"
                value="{{ old('amount', $expense->amount ?? '') }}"
                class="w-full aria-disabled:cursor-not-allowed outline-none focus:outline-none text-stone-800  placeholder:text-stone-600/60 ring-transparent border border-stone-200 transition-all ease-in disabled:opacity-50 disabled:pointer-events-none select-none text-sm py-2 px-2.5 ring shadow-sm bg-white rounded-lg duration-100  hover:ring-none
                                    focus:ring-none peer
                                    @error('amount') border-red-300 focus:border-red-400 @enderror " />
            <span
                class="pointer-events-none absolute top-1/2 -translate-y-1/2 right-2.5 text-stone-600/70 peer-focus:text-stone-800 peer-focus:text-stone-800   transition-all duration-300 ease-in overflow-hidden w-5 h-5">

                <svg width="1em" height="1em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-indian-rupee-icon lucide-indian-rupee">
                    <path d="M6 3h12" />
                    <path d="M6 8h12" />
                    <path d="m6 13 8.5 8" />
                    <path d="M6 13h3" />
                    <path d="M9 13c6.667 0 6.667-10 0-10" />
                </svg>
            </span>
        </div>
        @error('amount')
            <small class="font-sans antialiased text-sm text-red-500 mt-1 block">
                {{ $message }}
            </small>
        @enderror
    </div>
    <div>
        <label for="description" class="font-sans antialiased text-sm text-stone-800  font-semibold">
            Description
        </label>

        <div class="relative w-full">
            <textarea name="description" id="description" placeholder="Description" rows="4"
                class="w-full aria-disabled:cursor-not-allowed outline-none focus:outline-none text-stone-800  placeholder:text-stone-600/60 ring-transparent border border-stone-200 transition-all ease-in disabled:opacity-50 disabled:pointer-events-none select-none text-sm py-2 px-2.5 ring shadow-sm bg-white rounded-lg duration-100  hover:ring-none focus:ring-none peer @error('description') border-red-300 focus:border-red-400 @enderror">{{ old('description', $expense->description ?? '') }}</textarea>
        </div>
        <div class="flex gap-1.5 text-stone-600">
            <svg width="1.5em" height="1.5em" stroke-width="1.5" viewBox="0 0 24 24" fill="none"
                xmlns="http://www.w3.org/2000/svg" color="currentColor"
                class="h-3.5 w-3.5 shrink-0 translate-y-[3px] stroke-2">
                <path d="M12 11.5V16.5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M12 7.51L12.01 7.49889" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                </path>
                <path
                    d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
            <small class="font-sans antialiased text-sm text-current">
                Optional
            </small>
        </div>
    </div>

</div>
<div class="space-y-6">
    <div class="">
        <label for="category" class="font-sans antialiased text-sm text-stone-800  font-semibold">
            Category
        </label>

        <div class="relative w-full">
            <select id="category" name="category"
                class="w-full aria-disabled:cursor-not-allowed outline-none focus:outline-none text-stone-800  placeholder:text-stone-600/60 ring-transparent border border-stone-200 transition-all ease-in disabled:opacity-50 disabled:pointer-events-none select-none text-sm py-2 px-2.5 ring shadow-sm bg-white rounded-lg duration-100 hover:border-stone-300 hover:ring-none focus:border-stone-400 focus:ring-none peer @error('category') border-red-300 focus:border-red-400 @enderror">
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if ($category->id == old('category', $expense->category_id ?? '')) selected @endif>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category')
                <small class="font-sans antialiased text-sm text-red-500 mt-1 block">
                    {{ $message }}
                </small>
            @enderror
        </div>
    </div>
    <div>
        <label for="date" class="font-sans antialiased text-sm text-stone-800  font-semibold">
            Date
        </label>

        <div class="space-y-2">
            <div class="relative w-full">
                <input id="date" name="date" type="date" value="{{ old('date', isset($expense) ? $expense->added_date->format('Y-m-d') : '') }}"
                    class="w-full aria-disabled:cursor-not-allowed outline-none focus:outline-none text-stone-800  placeholder:text-stone-600/60 ring-transparent border border-stone-200 transition-all ease-in disabled:opacity-50 disabled:pointer-events-none select-none text-sm py-2 px-2.5 ring shadow-sm bg-white rounded-lg duration-100 hover:border-stone-300 hover:ring-none focus:border-stone-400 focus:ring-none peer @error('date') border-red-300 focus:border-red-400 @enderror" />
            </div>
            @error('date')
                <small class="font-sans antialiased text-sm text-red-500 mt-1 block">
                    {{ $message }}
                </small>
            @enderror

        </div>
    </div>
</div>
