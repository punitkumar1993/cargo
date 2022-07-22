<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ $title }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
                    @isset ($currentLinkAdd)
                        <li class="breadcrumb-item"><a href="{{ $url }}">{{ $linkIndex }}</a></li>
                    @else
                        <li class="breadcrumb-item active">{{ $linkIndex }}</li>
                    @endisset
                    @isset($currentLinkAdd)
                        <li class="breadcrumb-item active">{{ $currentLinkAdd }}</li>
                    @endisset
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
