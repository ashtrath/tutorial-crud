<div 
    x-data="{ show: false }" 
    x-init="window.addEventListener('scroll', () => { 
        show = window.scrollY > document.querySelector('#home').offsetHeight - 170; 
    })"
>
    <div
        x-show="show"
        x-transition
        class="fixed size-16 bg-[--gray-color] right-12 bottom-12 top-auto left-auto cursor-pointer rounded z-[599]"
    >
        <button
            @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
            class="flex items-center justify-center size-full filter invert-[4%] group"
        >
            <x-heroicon-o-chevron-up class="size-6 opacity-40 text-[--main-text-color] group-hover:opacity-100" />
        </button>
    </div>
</div>
