Alpine.data('dark_mode_switcher', () => ({
    toggle : false,
    currentMode : localStorage.theme,
    change(mode){
        this.toggle = false
        this.currentMode = mode
        if(localStorage.theme == mode) {
            toggle = false
            return
        }
        if (mode === 'light') {
            localStorage.theme = 'light';
            document.documentElement.classList.remove('dark');
        } else if(mode === 'dark') {
            localStorage.theme = 'dark';
            document.documentElement.classList.add('dark');
        }else{
            localStorage.removeItem('theme')
        }
    },
    openToggle() {
        this.toggle = ! this.toggle
    },
    closeToggle() {
        this.toggle = false
    },
    get theme() { return this.currentMode }
}))
