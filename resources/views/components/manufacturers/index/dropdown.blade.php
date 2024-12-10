<div
    class="position-relative"
    x-data="{
        open: false,
        toggle() {
            this.open = this.open ? this.close() : true
        },
        close() {
            this.open = false
        }
    }"
    @keydown.escape.prevent.stop="toggle"
    @click="toggle"
>
    <div>
        <x-icon.ellipsis-horizontal />
    </div>

    <div
        class="position-absolute end-0 right-0 border border-dark rounded z-3 bg-white"
        x-show="open"
        style="display: none"
        @click.outside="close"
    >
        {{ $slot }}
    </div>
</div>
