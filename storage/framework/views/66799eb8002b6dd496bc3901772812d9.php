<div class="flex flex-col h-[600px]" wire:poll.2s="loadMessages">
    <!-- Chat Header -->
    <div class="p-4 border-b bg-white flex items-center justify-between">
        <div class="flex items-center gap-4">
            <!--[if BLOCK]><![endif]--><?php if($receiver->avatar): ?>
                <img src="<?php echo e(asset('avatars/' . $receiver->avatar)); ?>" 
                     alt="<?php echo e($receiver->username); ?>" 
                     class="w-12 h-12 rounded-full object-cover border-2 border-blue-100">
            <?php else: ?>
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-lg font-semibold text-white uppercase border-2 border-blue-100">
                    <?php echo e(Str::substr($receiver->username, 0, 2)); ?>

                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            <div>
                <h3 class="font-bold text-gray-800"><?php echo e($receiver->name); ?></h3>
                <div class="flex items-center gap-2">
                    <span class="text-sm text-gray-500"><?php echo e('@' . $receiver->username); ?></span>
                    <!--[if BLOCK]><![endif]--><?php if($receiver->role === 'verified'): ?>
                        <span class="text-blue-500">
                            <i class="fas fa-check-circle text-sm"></i>
                        </span>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>
            </div>
        </div>
        <button class="text-gray-400 hover:text-gray-600 transition-colors">
            <i class="fas fa-ellipsis-v"></i>
        </button>
    </div>

    <!-- Messages -->
    <div class="flex-1 p-4 overflow-y-auto space-y-4 bg-gray-50" id="chat-messages" wire:key="messages-<?php echo e(count($messages)); ?>">
        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="flex <?php echo e($msg->from_user_id === auth()->id() ? 'justify-end' : 'justify-start'); ?> items-end gap-2">
                <!--[if BLOCK]><![endif]--><?php if($msg->from_user_id !== auth()->id()): ?>
                    <!--[if BLOCK]><![endif]--><?php if($receiver->avatar): ?>
                        <img src="<?php echo e(asset('avatars/' . $receiver->avatar)); ?>" 
                             alt="<?php echo e($receiver->username); ?>" 
                             class="w-6 h-6 rounded-full object-cover">
                    <?php else: ?>
                        <div class="w-6 h-6 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-[10px] font-semibold text-white uppercase">
                            <?php echo e(Str::substr($receiver->username, 0, 2)); ?>

                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                <div class="max-w-[70%] group relative">
                    <div class="<?php echo e($msg->from_user_id === auth()->id() 
                        ? 'bg-blue-600 text-white rounded-t-xl rounded-l-xl' 
                        : 'bg-white text-gray-800 rounded-t-xl rounded-r-xl'); ?> 
                        shadow-sm px-4 py-2">
                        <p class="text-sm"><?php echo e($msg->message); ?></p>
                    </div>
                    <span class="text-[10px] text-gray-400 mt-1 <?php echo e($msg->from_user_id === auth()->id() ? 'text-right' : 'text-left'); ?> block">
                        <?php echo e($msg->created_at->format('H:i')); ?>

                    </span>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->

        <!--[if BLOCK]><![endif]--><?php if(count($messages) === 0): ?>
            <div class="flex flex-col items-center justify-center h-full text-gray-400">
                <i class="fas fa-comments text-4xl mb-2"></i>
                <p>Belum ada pesan. Mulai chat sekarang!</p>
            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </div>

    <!-- Message Input -->
    <div class="p-4 bg-white border-t">
        <form wire:submit.prevent="sendMessage" class="flex gap-2">
            <div class="flex-1 relative">
                <input type="text" 
                       wire:model="message" 
                       placeholder="Ketik pesan..." 
                       class="w-full border border-gray-200 rounded-full px-6 py-3 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-100 transition-all pr-12">
                <button type="button" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                    <i class="fas fa-smile"></i>
                </button>
            </div>
            <button type="submit" 
                    class="bg-blue-600 text-white rounded-full w-12 h-12 flex items-center justify-center hover:bg-blue-700 transition-colors focus:outline-none focus:ring focus:ring-blue-100">
                <i class="fas fa-paper-plane"></i>
            </button>
        </form>
    </div>

    <script>
        // Auto-scroll to bottom on new messages
        document.addEventListener('livewire:initialized', () => {
            const messagesContainer = document.getElementById('chat-messages');
            messagesContainer.scrollTop = messagesContainer.scrollHeight;

            Livewire.on('messageReceived', () => {
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            });
        });
    </script>
</div> <?php /**PATH C:\project-rasya\blogging\resources\views/livewire/chat.blade.php ENDPATH**/ ?>