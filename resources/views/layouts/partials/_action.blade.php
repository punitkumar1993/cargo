<div class="btn-group btn-group-sm">
    @isset($edit_url)
        <a href="{{ $edit_url }}" class="btn btn-warning link-edit" data-model="{{ $model }}"><i class="fas fa-pencil-alt"></i></a>
    @endisset
    @isset($del_url)
        <button type="button" class="btn btn-danger delete" data-url="{{ $del_url }}" data-table="{{ $table }}"><i class="far fa-trash-alt"></i></button>
    @endisset
</div>
