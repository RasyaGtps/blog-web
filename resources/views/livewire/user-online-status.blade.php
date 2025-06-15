<div wire:init="updateStatus" wire:poll.2s="updateStatus" class="flex items-center gap-2">
    @if($isOnline)
        <i class="fas fa-power-off text-green-500 animate-pulse"></i>
        <span class="text-sm text-gray-600">Online</span>
    @else
        <i class="fas fa-power-off text-gray-400"></i>
        <span class="text-sm text-gray-600">Off</span>
    @endif
</div> 