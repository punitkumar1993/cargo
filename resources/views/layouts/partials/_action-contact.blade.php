<div class="btn-group btn-group-sm">
    <a href="{{ $show_url }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
    @isset($del_url)
        <button type="button" class="btn btn-danger delete" data-url="{{ $del_url }}" data-table="{{ $table }}"><i class="far fa-trash-alt"></i></button>
    @endisset
</div>
