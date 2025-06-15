<div wire:init="updateStatus" wire:poll.2s="updateStatus" class="flex items-center gap-2">
    <!--[if BLOCK]><![endif]--><?php if($isOnline): ?>
        <i class="fas fa-power-off text-green-500 animate-pulse"></i>
        <span class="text-sm text-gray-600">Online</span>
    <?php else: ?>
        <i class="fas fa-power-off text-gray-400"></i>
        <span class="text-sm text-gray-600">Off</span>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</div> <?php /**PATH C:\project-rasya\blogging\resources\views/livewire/user-online-status.blade.php ENDPATH**/ ?>