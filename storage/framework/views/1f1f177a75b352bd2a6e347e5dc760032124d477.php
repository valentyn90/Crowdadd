<?php $__env->startPush('stylesheets'); ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<style>
.wt-select:after {
    content: '' !important;
}
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<section class="wt-haslayout wt-dbsectionspace wt-insightuser" id="services">
    <div class="row">
        <div class="col-md-8">
            <div class="wt-dashboardbox wt-dashboardservcies">
                <div class="wt-dashboardboxtitle wt-titlewithsearch">
                    <h2>Booking Overview Calendar</h2>
                </div>
                <div class="wt-dashboardboxcontent wt-categoriescontentholder">
                    <?php if(!empty(request('category'))): ?>
                    <example-component category_id="<?php echo e(request('category')); ?>"></example-component>
                    <?php else: ?>
                    <h5 style="padding: 30px;">Select A package category to make days markoff and markon for your avalability</h5>
                    <?php endif; ?>


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
                                            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($service->id); ?>"
                                                <?php echo e(request('category') == $service->id ? 'selected' :''); ?>>
                                                <?php echo e($service->title); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();

        $('.js-example-basic-single').on('select2:select', function (e) {

            $('#categroy-form').submit();
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' :
'back-end.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>