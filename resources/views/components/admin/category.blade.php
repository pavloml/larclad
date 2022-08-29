@props(['category'])
<div class="card">
    <div class="card-header" id="{{ 'heading' . $category->id}}">
        <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left"
                    type="button"
                    data-toggle="collapse"
                    data-target="{{ '#collapse' . $category->id}}"
                    aria-expanded="true"
                    aria-controls="{{'collapse' . $category->id}}">
                {{ $category->name }}
            </button>
        </h2>
    </div>

    <div id="{{'collapse' . $category->id}}"
         class="collapse"
         aria-labelledby="{{ 'heading' . $category->id}}" data-parent="#categories">
        <div class="card-body">
            <div class="d-flex justify-content-center mb-3">
                <a class="btn btn-success mx-1" href="{{ @route('admin.subcategories.create', ['category_id' => $category->id]) }}"><i class="fas fa-plus"></i> Add a subcategory</a>
                <a class="btn btn-info mx-1" href="{{ route('admin.categories.edit', ['id' => $category->id]) }}">
                    <i class="fas fa-edit"></i> Edit category
                </a>
                <button class="btn btn-danger mx-1" aria-label="Delete"
                        data-toggle="modal"
                        data-target="#deleteCategoryModal"
                        data-action-link="{{ route('admin.categories.delete', ['id' => $category->id]) }}">
                    <i class="fas fa-trash"></i> Delete category
                </button>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($category->subcategories as $subcategory)
                    <tr>
                        <td>
                            {{ $subcategory->id }}
                        </td>
                        <td>
                            {{ $subcategory->name }}
                        </td>
                        <td>
                            {{ $subcategory->slug }}
                        </td>
                        <td>
                            <a class="btn btn-info" href="{{ route('admin.subcategories.edit', ['id' => $subcategory->id]) }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-danger" aria-label="Delete"
                                    data-toggle="modal"
                                    data-target="#deleteSubcategoryModal"
                                    data-action-link="{{ route('admin.subcategories.delete', ['id' => $subcategory->id]) }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">
                            No subcategories
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
