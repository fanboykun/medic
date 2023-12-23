import './bootstrap';

Alpine.data('resize_window_watcher', () => ({
    mobilemenu: false,
    init() {
        window.addEventListener('resize', () => {
            if(window.innerWidth >= 640) this.mobilemenu = false
        })
    },
}))

