@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' :
'back-end.master')

@push('stylesheets')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<style>
.wt-select:after {
    content: '' !important;
}
</style>
@endpush
@section('content')
<section class="wt-haslayout wt-dbsectionspace wt-insightuser" id="services">
    <div class="row">
        <div class="col-md-8">
            <div class="wt-dashboardbox wt-dashboardservcies">
                <div class="wt-dashboardboxtitle wt-titlewithsearch">
                    <h2>Booking Overview Calendar</h2>
                </div>
                <div class="wt-dashboardboxcontent wt-categoriescontentholder">
                    @if(!empty(request('category')))
                    <example-component category_id="{{request('category')}}"></example-component>
                    @else
                    <h5 style="padding: 30px;">Select A package category to make days markoff and markon for your avalability</h5>
                    @endif


                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="wt-dashboardbox wt-dashboardservcies">
                <div class="wt-dashboardboxtitle wt-titlewithsearch">
                    <h2>Select Package</h2>
                </div>
                <div class="wt-dashboardboxcontent wt-categoriescontentholder">
                    <div class="wt-jobcategories wt-tabsinfo">
                        <div class="wt-tabscontenttitle">
                            <h2>Package Name</h2>
                        </div>
                        <div class="wt-divtheme wt-userform wt-userformvtwo">
                            <form action="" method="get" id="categroy-form">
                                <div class="form-group">
                                    <span class="wt-select">
                                        <select class="js-example-basic-single" name="category" id="overview_category" >
                                            <option disabled selected>Select A Package</option>
                                            @foreach ($services as $service)
                                            <option value="{{ $service->id }}"
                                                {{ request('category') == $service->id ? 'selected' :'' }}>
                                                {{ $service->title }}</option>
                                            @endforeach
                                        </select>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();

        $('.js-example-basic-single').on('select2:select', function (e) {

            $('#categroy-form').submit();
        });
    });
</script>
@endpush