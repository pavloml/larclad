<x-admin.layout  :title="$title">
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Categories</h1>
            <div class="btn-toolbar">
            <a class="btn btn-success mr-3" href="{{ route('admin.categories.create') }}"><i class="fas fa-plus"></i> Add a category</a>
            </div>
        </div>
        <x-session-alerts />
        <p class="text-center">Click on a category name to view subcategories</p>
        <div class="col-12">
            <div class="accordion" id="categories">
                @forelse($categories as $category)
                    <x-admin.category :category="$category" />
                @empty
                    <p class="text-danger text-center">No categories found</p>
                @endforelse
            </div>
        </div>
    </main>
    <x-admin.modal.delete-category-modal />
    <x-admin.modal.delete-subcategory-modal />
    @push('scripts')
        <script>
            $('#deleteCategoryModal').on('show.bs.modal', function (event) {
                let button = $(event.relatedTarget)
                document.querySelector('#deleteCategoryModalForm').setAttribute('action', button.data('action-link'));
            })
            $('#deleteSubcategoryModal').on('show.bs.modal', function (event) {
                let button = $(event.relatedTarget)
                document.querySelector('#deleteSubcategoryModalForm').setAttribute('action', button.data('action-link'));
            })
        </script>
    @endpush
</x-admin.layout>
