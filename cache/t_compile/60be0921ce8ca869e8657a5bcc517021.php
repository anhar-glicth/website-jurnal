
<?php
    $svgIcons = \PKP\template\PKPTemplateManager::getManager()->getSvgIcons();
?>

<?php $__currentLoopData = $svgIcons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iconName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if (! $__env->hasRenderedOnce("icon-{$iconName}")): $__env->markAsRenderedOnce("icon-{$iconName}");
$__env->startPush('svg-icons'); ?>
    <?php
        $iconContent = trim(view("frontend.icons.{$iconName}")->render());
        // Strip <svg> wrapper tags if present (performant single-pass regex)
        $iconContent = preg_replace('/<\/?svg[^>]*>/i', '', $iconContent);
    ?>
    <symbol id="icon-<?php echo \PKP\template\ViewHelper::vueEscape($iconName); ?>" viewBox="0 0 24 24">
    <?php echo $iconContent; ?>

    </symbol>
    <?php $__env->stopPush(); endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<svg xmlns="http://www.w3.org/2000/svg" style="display:none">
    <?php echo $__env->yieldPushContent('svg-icons'); ?>
</svg>
<?php /**PATH C:\xampp\htdocs\ojs\lib\pkp\templates/frontend/components/svg-icon-sprite.blade ENDPATH**/ ?>