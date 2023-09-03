<header class="bg-white/80 dark:bg-gray-900 backdrop-blur border-b dark:border-gray-700 sticky top-0 z-20 w-full h-[3.3rem] flex-none">
    <div class="max-w-[90rem] px-4 sm:px-6 md:px-8 mx-auto h-[3.3rem]">
        <div class="flex items-center h-[3.3rem] gap-4">
            <button type="button" @click="mobilemenu = ! mobilemenu"
                class="md:hidden text-gray-600 dark:text-gray-400"><span class="sr-only">Navigation</span><svg
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" aria-hidden="true" class="flex-shrink-0 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
                </svg>
            </button>
            <div style="position:fixed;top:1;left:1;width:1;height:0;padding:0;margin:-1;overflow:hidden;clip:rect(0, 0, 0, 0);white-space:nowrap;border-width:0;display:none;">
            </div>
            <a href="{{ route('dashboard') }}" wire:navigate class="flex-shrink-0 h-[24px] text-gray-600 dark:text-white"
                alt="Pharmacy App">
                Pharmacy App
                {{-- <img class="flex-shrink-0 h-[24px] text-gray-500 dark:text-white block dark:hidden" alt="logo" src="/docs/logo.svg">
                <img class="flex-shrink-0 h-[24px] text-gray-500 dark:text-white hidden dark:block" alt="logo" src="/docs/logo-dark.svg"> --}}
            </a>
            @if(isset($header))
                <div class="items-start hidden sm:flex ml-28 text-gray-600 dark:text-gray-200 font-semibold text-lg">
                    {{ $header }}
                </div>
            @endif
            <div class="ml-auto md:flex items-center justify-between md:divide-x md:divide-gray-200 md:dark:divide-gray-700">
                <div class="flex items-center ml-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-2 py-1.5 border border-transparent text-sm leading-4 font-medium rounded-md text-slate-600 dark:text-gray-500  bg-gray-200 dark:bg-white hover:bg-gray-400/20 dark:hover:bg-gray-100 dark:hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
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

