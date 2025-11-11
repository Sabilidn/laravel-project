<div>
    <div class="text-center">
        <h1 class="text-4xl font-bold mb-4">Counter Component</h1>
        <div class="text-6xl font-mono mb-4">{{ $count }}</div>
        <div class="space-x-4">
            <button wire:click="decrement" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                Decrement
            </button>
            <button wire:click="increment" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Increment
            </button>
        </div>
    </div>
</div>