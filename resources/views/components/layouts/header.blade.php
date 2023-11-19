<header
    class="bg-white/80 dark:bg-gray-900 backdrop-blur border-b dark:border-gray-700 sticky top-0 z-20 w-full h-[3.3rem] flex-none">
    <div class="max-w-[90rem] px-4 sm:px-6 md:px-8 mx-auto h-[3.3rem]">
        <div class="flex items-center h-[3.3rem] gap-4">
            <button type="button" @click="mobilemenu = ! mobilemenu"
                class="sm:hidden text-gray-600 dark:text-gray-400"><span class="sr-only">Navigation</span><svg
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" aria-hidden="true" class="flex-shrink-0 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
                </svg>
            </button>
            <div
                style="position:fixed;top:1;left:1;width:1;height:0;padding:0;margin:-1;overflow:hidden;clip:rect(0, 0, 0, 0);white-space:nowrap;border-width:0;display:none;">
            </div>
            <a href="{{ route('dashboard') }}" wire:navigate
                class="flex-shrink-0 h-[24px] text-gray-600 dark:text-white" alt="Pharmacy App">
                Pharmacy App
                {{-- <img class="flex-shrink-0 h-[24px] text-gray-500 dark:text-white block dark:hidden" alt="logo" src="/docs/logo.svg">
                <img class="flex-shrink-0 h-[24px] text-gray-500 dark:text-white hidden dark:block" alt="logo" src="/docs/logo-dark.svg"> --}}
            </a>
            @if (isset($header))
                <div class="items-start hidden sm:flex ml-28 text-gray-600 dark:text-gray-200 font-semibold text-lg">
                    {{ $header }}
                </div>
            @endif
            <div x-data="{
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
                    get theme() { return this.currentMode }
                }"
                class="ml-auto md:flex items-center justify-between md:divide-x md:divide-gray-200 md:dark:divide-gray-700">
                <div data-headlessui-state="" class="relative inline-block text-left items-center mt-2 md:mt-0">
                    <div x-transition>
                        <button x-cloak x-on:click="toggle = !toggle" id="headlessui-menu-button-238" type="button" aria-haspopup="menu" aria-expanded="false" data-headlessui-state="" class="flex items-center">
                            <svg x-cloak xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" x-show="currentMode == 'light'" class="w-5 h-5 text-teal-500">
                                <path d="M10 2a.75.75 0 01.75.75v1.5a.75.75 0 01-1.5 0v-1.5A.75.75 0 0110 2zM10 15a.75.75 0 01.75.75v1.5a.75.75 0 01-1.5 0v-1.5A.75.75 0 0110 15zM10 7a3 3 0 100 6 3 3 0 000-6zM15.657 5.404a.75.75 0 10-1.06-1.06l-1.061 1.06a.75.75 0 001.06 1.06l1.06-1.06zM6.464 14.596a.75.75 0 10-1.06-1.06l-1.06 1.06a.75.75 0 001.06 1.06l1.06-1.06zM18 10a.75.75 0 01-.75.75h-1.5a.75.75 0 010-1.5h1.5A.75.75 0 0118 10zM5 10a.75.75 0 01-.75.75h-1.5a.75.75 0 010-1.5h1.5A.75.75 0 015 10zM14.596 15.657a.75.75 0 001.06-1.06l-1.06-1.061a.75.75 0 10-1.06 1.06l1.06 1.06zM5.404 6.464a.75.75 0 001.06-1.06l-1.06-1.06a.75.75 0 10-1.061 1.06l1.06 1.06z"></path>
                            </svg>
                            <svg x-cloak xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" x-show="currentMode == 'dark'" class="flex-shrink-0 w-5 h-5 text-gray-500">
                                <path fill-rule="evenodd" d="M7.455 2.004a.75.75 0 01.26.77 7 7 0 009.958 7.967.75.75 0 011.067.853A8.5 8.5 0 116.647 1.921a.75.75 0 01.808.083z"clip-rule="evenodd"></path>
                            </svg>
                            <svg x-cloak xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" x-show="currentMode == undefined" class="flex-shrink-0 w-5 h-5 text-gray-400 dark:text-gray-600">
                                <path fill-rule="evenodd" d="M2 4.25A2.25 2.25 0 014.25 2h11.5A2.25 2.25 0 0118 4.25v8.5A2.25 2.25 0 0115.75 15h-3.105a3.501 3.501 0 001.1 1.677A.75.75 0 0113.26 18H6.74a.75.75 0 01-.484-1.323A3.501 3.501 0 007.355 15H4.25A2.25 2.25 0 012 12.75v-8.5zm1.5 0a.75.75 0 01.75-.75h11.5a.75.75 0 01.75.75v7.5a.75.75 0 01-.75.75H4.25a.75.75 0 01-.75-.75v-7.5z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <div x-show="toggle" x-cloak  @click.outside="toggle = false" aria-labelledby="headlessui-menu-button-238" id="headlessui-menu-items-5" role="menu" class="absolute right-0 z-10 mt-2 py-2 px-1.5 w-32 origin-top-right rounded-md bg-white dark:bg-gray-950 shadow-lg ring-1 ring-black dark:ring-white ring-opacity-5 dark:ring-opacity-5 focus:outline-none">
                            <div class="py-1" role="none">
                                <button type="button" x-on:click="change('light')"  class="flex items-center gap-3 w-full font-semibold text-left px-3 py-1 text-sm text-teal-500 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-900" id="headlessui-menu-item-7" role="menuitem" tabindex="-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="flex-shrink-0 w-5 h-5">
                                        <path d="M10 2a.75.75 0 01.75.75v1.5a.75.75 0 01-1.5 0v-1.5A.75.75 0 0110 2zM10 15a.75.75 0 01.75.75v1.5a.75.75 0 01-1.5 0v-1.5A.75.75 0 0110 15zM10 7a3 3 0 100 6 3 3 0 000-6zM15.657 5.404a.75.75 0 10-1.06-1.06l-1.061 1.06a.75.75 0 001.06 1.06l1.06-1.06zM6.464 14.596a.75.75 0 10-1.06-1.06l-1.06 1.06a.75.75 0 001.06 1.06l1.06-1.06zM18 10a.75.75 0 01-.75.75h-1.5a.75.75 0 010-1.5h1.5A.75.75 0 0118 10zM5 10a.75.75 0 01-.75.75h-1.5a.75.75 0 010-1.5h1.5A.75.75 0 015 10zM14.596 15.657a.75.75 0 001.06-1.06l-1.06-1.061a.75.75 0 10-1.06 1.06l1.06 1.06zM5.404 6.464a.75.75 0 001.06-1.06l-1.06-1.06a.75.75 0 10-1.061 1.06l1.06 1.06z"></path>
                                    </svg>
                                    Light
                                </button>
                                <button x-on:click="change('dark')" type="button" class="flex items-center gap-3 w-full font-semibold text-left px-3 py-1 text-sm text-gray-700 dark:text-teal-500 hover:bg-gray-50 dark:hover:bg-gray-900" id="headlessui-menu-item-8" role="menuitem" tabindex="-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="flex-shrink-0 w-5 h-5">
                                        <path fill-rule="evenodd" d="M7.455 2.004a.75.75 0 01.26.77 7 7 0 009.958 7.967.75.75 0 011.067.853A8.5 8.5 0 116.647 1.921a.75.75 0 01.808.083z"clip-rule="evenodd"></path>
                                    </svg>
                                    Dark
                                </button>
                                {{-- <button type="button" x-on:click="change('system')" class="flex items-center gap-3 w-full font-semibold text-gray-700 dark:text-gray-200 text-left px-3 py-1 text-sm hover:bg-gray-50 dark:hover:bg-gray-900 !text-primary-500" id="headlessui-menu-item-9" role="menuitem" tabindex="-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-gray-400 dark:text-gray-600">
                                        <path fill-rule="evenodd" d="M2 4.25A2.25 2.25 0 014.25 2h11.5A2.25 2.25 0 0118 4.25v8.5A2.25 2.25 0 0115.75 15h-3.105a3.501 3.501 0 001.1 1.677A.75.75 0 0113.26 18H6.74a.75.75 0 01-.484-1.323A3.501 3.501 0 007.355 15H4.25A2.25 2.25 0 012 12.75v-8.5zm1.5 0a.75.75 0 01.75-.75h11.5a.75.75 0 01.75.75v7.5a.75.75 0 01-.75.75H4.25a.75.75 0 01-.75-.75v-7.5z" clip-rule="evenodd"></path>
                                    </svg>
                                    System
                                </button> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center ml-6 md:mt-0 -mt-10">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-2 py-1.5 border border-transparent text-sm leading-4 font-medium rounded-md text-slate-600 dark:text-gray-500  bg-gray-200 dark:bg-white hover:bg-gray-400/20 dark:hover:bg-gray-100 dark:hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div class="hidden sm:flex">{{ Auth::user()->name }}</div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 flex sm:hidden">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')" wire:navigate>
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </div>
    </div>
</header>
@include('components.layouts.mobile-sidebar')
