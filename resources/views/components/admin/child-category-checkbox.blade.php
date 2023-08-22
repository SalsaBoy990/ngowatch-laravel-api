<div class="padding-left-2">
    <label for="categories">
        <input name="categories[]"
               type="checkbox"
               {{ $postExists === true && array_search($childCategory->id, $postCategoryIds) !== false ? ' checked ' : '' }}
               value="{{ $childCategory->id }}"
        >
        {{ $childCategory->name }}
    </label>

    @if( count($childCategory->categories) > 0)
        @foreach($childCategory->categories as $subChildCategory)
            <x-admin.child-category-checkbox
                :postExists="$postExists"
                :childCategory="$subChildCategory"
                :postCategoryIds="$postCategoryIds"
            >
            </x-admin.child-category-checkbox>
        @endforeach
    @endif
</div>
