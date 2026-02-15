<button <?php echo e($attributes->class(['expansion'])); ?> type="button">
    <span x-text="charCount"></span>
    <span x-show="max > 0" x-text="'/' + max" :class="{'text-pink-400': isWarning}"></span>
</button>

<?php /**PATH /var/www/html/vendor/lee-to/moonshine-input-extension-char-count/src/Providers/../../resources/views/input-extensions/char-count.blade.php ENDPATH**/ ?>