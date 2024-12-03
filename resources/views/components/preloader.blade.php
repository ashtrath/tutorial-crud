<div
    x-data="{ show: true }"
    x-init="setTimeout(() => show = false, 1700)"
    x-show="show"
    x-transition.opacity.duration.500ms
    class="fixed flex flex-wrap items-center justify-center bg-white z-[3000] h-screen w-screen overflow-hidden"
>
    <div class="jumping-dots">
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>
