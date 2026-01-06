 <title><?php echo e($meta['title'] ?? 'Repair Center'); ?></title>
 <meta name="description" content="<?php echo e($meta['description'] ?? ''); ?>">
 <meta name="keywords" content="<?php echo e($meta['keywords'] ?? ''); ?>">

 <?php if(!empty($meta['json_ld'])): ?>
     <script type="application/ld+json">
        <?php echo json_encode($meta['json_ld'], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT); ?>

    </script>
 <?php endif; ?>
<?php /**PATH /var/www/html/resources/views/partials/seo-meta.blade.php ENDPATH**/ ?>