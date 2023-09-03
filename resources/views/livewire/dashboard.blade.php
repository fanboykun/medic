<div>
    <div class="w-full">
        <div class="bg-white dark:bg-slate-700 dark:text-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="dark:bg-slate-800 grid grid-cols-2 py-4 border-spacing-1">
                <div class="flex justify-start px-4 py-2">
                    <div class="block">
                        <div class="flex">
                            <div class="w-4 h-4 rounded-full border p-2">
                                <div class="-my-1 -mx-1 w-2 h-2 bg-indigo-500 rounded-full"></div>
                            </div>
                            <span class="inline-block -mt-0.5 ml-2">Store Status</span>
                        </div>
                        <span class="block text-xs text-gray-600 dark:text-gray-200">The current store status</span>
                    </div>
                </div>
                <div class="flex justify-end px-4 py-2 items-center">
                    <span class="bg-indigo-100 text-indigo-800 text-xs mr-2 px-3 py-0.5 rounded-full dark:bg-gray-700/30 font-bold dark:text-indigo-600 border border-indigo-400">Active</span>
                </div>
            </div>
            <div class="bg-gray-200 dark:bg-slate-600/80 grid sm:grid-cols-2 md:grid-cols-4 border-y border-gray-100 dark:border-gray-500">
                <div class="flex border-r border-white dark:border-gray-500 px-2 py-4">
                    <div>
                        <div class="p-2 rounded-lg bg-white w-fit mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-indigo-600">
                                <path d="M21 6.375c0 2.692-4.03 4.875-9 4.875S3 9.067 3 6.375 7.03 1.5 12 1.5s9 2.183 9 4.875z" />
                                <path d="M12 12.75c2.685 0 5.19-.586 7.078-1.609a8.283 8.283 0 001.897-1.384c.016.121.025.244.025.368C21 12.817 16.97 15 12 15s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.285 8.285 0 001.897 1.384C6.809 12.164 9.315 12.75 12 12.75z" />
                                <path d="M12 16.5c2.685 0 5.19-.586 7.078-1.609a8.282 8.282 0 001.897-1.384c.016.121.025.244.025.368 0 2.692-4.03 4.875-9 4.875s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.284 8.284 0 001.897 1.384C6.809 15.914 9.315 16.5 12 16.5z" />
                                <path d="M12 20.25c2.685 0 5.19-.586 7.078-1.609a8.282 8.282 0 001.897-1.384c.016.121.025.244.025.368 0 2.692-4.03 4.875-9 4.875s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.284 8.284 0 001.897 1.384C6.809 19.664 9.315 20.25 12 20.25z" />
                              </svg>
                        </div>
                        <div class=" font-semibold text-sm text-slate-600 dark:text-slate-200">
                            Total Medicine In Stock
                        </div>
                        <div class="text-3xl leading-loose font-semibold text-slate-700 dark:text-white">
                            {{ $medicine_in_stock }}
                        </div>
                    </div>
                </div>
                <div class="flex border-r border-white dark:border-gray-500 px-2 py-4">
                    <div>
                        <div class="p-2 rounded-lg bg-white w-fit mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-indigo-600">
                                <path d="M21 6.375c0 2.692-4.03 4.875-9 4.875S3 9.067 3 6.375 7.03 1.5 12 1.5s9 2.183 9 4.875z" />
                                <path d="M12 12.75c2.685 0 5.19-.586 7.078-1.609a8.283 8.283 0 001.897-1.384c.016.121.025.244.025.368C21 12.817 16.97 15 12 15s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.285 8.285 0 001.897 1.384C6.809 12.164 9.315 12.75 12 12.75z" />
                                <path d="M12 16.5c2.685 0 5.19-.586 7.078-1.609a8.282 8.282 0 001.897-1.384c.016.121.025.244.025.368 0 2.692-4.03 4.875-9 4.875s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.284 8.284 0 001.897 1.384C6.809 15.914 9.315 16.5 12 16.5z" />
                                <path d="M12 20.25c2.685 0 5.19-.586 7.078-1.609a8.282 8.282 0 001.897-1.384c.016.121.025.244.025.368 0 2.692-4.03 4.875-9 4.875s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.284 8.284 0 001.897 1.384C6.809 19.664 9.315 20.25 12 20.25z" />
                              </svg>
                        </div>
                        <div class=" font-semibold text-sm text-slate-600 dark:text-slate-200">
                            Total Sales
                        </div>
                        <div class="text-3xl leading-loose font-semibold text-slate-700 dark:text-white">
                            {{ $total_sales }}
                        </div>
                    </div>
                </div>
                <div class="flex border-r border-white dark:border-gray-500 px-2 py-4">
                    <div>
                        <div class="p-2 rounded-lg bg-white w-fit mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-indigo-600">
                                <path d="M21 6.375c0 2.692-4.03 4.875-9 4.875S3 9.067 3 6.375 7.03 1.5 12 1.5s9 2.183 9 4.875z" />
                                <path d="M12 12.75c2.685 0 5.19-.586 7.078-1.609a8.283 8.283 0 001.897-1.384c.016.121.025.244.025.368C21 12.817 16.97 15 12 15s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.285 8.285 0 001.897 1.384C6.809 12.164 9.315 12.75 12 12.75z" />
                                <path d="M12 16.5c2.685 0 5.19-.586 7.078-1.609a8.282 8.282 0 001.897-1.384c.016.121.025.244.025.368 0 2.692-4.03 4.875-9 4.875s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.284 8.284 0 001.897 1.384C6.809 15.914 9.315 16.5 12 16.5z" />
                                <path d="M12 20.25c2.685 0 5.19-.586 7.078-1.609a8.282 8.282 0 001.897-1.384c.016.121.025.244.025.368 0 2.692-4.03 4.875-9 4.875s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.284 8.284 0 001.897 1.384C6.809 19.664 9.315 20.25 12 20.25z" />
                              </svg>
                        </div>
                        <div class=" font-semibold text-sm text-slate-600 dark:text-slate-200">
                            Total Purchases
                        </div>
                        <div class="text-3xl leading-loose font-semibold text-slate-700 dark:text-white">
                            {{ $total_purchases }}
                        </div>
                    </div>
                </div>
                <div class="flex border-r border-white dark:border-gray-500 px-2 py-4">
                    <div>
                        <div class="p-2 rounded-lg bg-white w-fit mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-indigo-600">
                                <path d="M21 6.375c0 2.692-4.03 4.875-9 4.875S3 9.067 3 6.375 7.03 1.5 12 1.5s9 2.183 9 4.875z" />
                                <path d="M12 12.75c2.685 0 5.19-.586 7.078-1.609a8.283 8.283 0 001.897-1.384c.016.121.025.244.025.368C21 12.817 16.97 15 12 15s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.285 8.285 0 001.897 1.384C6.809 12.164 9.315 12.75 12 12.75z" />
                                <path d="M12 16.5c2.685 0 5.19-.586 7.078-1.609a8.282 8.282 0 001.897-1.384c.016.121.025.244.025.368 0 2.692-4.03 4.875-9 4.875s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.284 8.284 0 001.897 1.384C6.809 15.914 9.315 16.5 12 16.5z" />
                                <path d="M12 20.25c2.685 0 5.19-.586 7.078-1.609a8.282 8.282 0 001.897-1.384c.016.121.025.244.025.368 0 2.692-4.03 4.875-9 4.875s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.284 8.284 0 001.897 1.384C6.809 19.664 9.315 20.25 12 20.25z" />
                              </svg>
                        </div>
                        <div class=" font-semibold text-sm text-slate-600 dark:text-slate-200">
                            Count of Suppliers
                        </div>
                        <div class="text-3xl leading-loose font-semibold text-slate-700 dark:text-white">
                            {{ $count_of_suppliers }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-200 dark:bg-slate-600/80 grid sm:grid-cols-2 md:grid-cols-4 border-y border-gray-100 dark:border-gray-500">
                <div class="flex border-r border-white dark:border-gray-500 px-2 py-4">
                    <div>
                        <div class="p-2 rounded-lg bg-white w-fit mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-indigo-600">
                                <path d="M21 6.375c0 2.692-4.03 4.875-9 4.875S3 9.067 3 6.375 7.03 1.5 12 1.5s9 2.183 9 4.875z" />
                                <path d="M12 12.75c2.685 0 5.19-.586 7.078-1.609a8.283 8.283 0 001.897-1.384c.016.121.025.244.025.368C21 12.817 16.97 15 12 15s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.285 8.285 0 001.897 1.384C6.809 12.164 9.315 12.75 12 12.75z" />
                                <path d="M12 16.5c2.685 0 5.19-.586 7.078-1.609a8.282 8.282 0 001.897-1.384c.016.121.025.244.025.368 0 2.692-4.03 4.875-9 4.875s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.284 8.284 0 001.897 1.384C6.809 15.914 9.315 16.5 12 16.5z" />
                                <path d="M12 20.25c2.685 0 5.19-.586 7.078-1.609a8.282 8.282 0 001.897-1.384c.016.121.025.244.025.368 0 2.692-4.03 4.875-9 4.875s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.284 8.284 0 001.897 1.384C6.809 19.664 9.315 20.25 12 20.25z" />
                              </svg>
                        </div>
                        <div class=" font-semibold text-sm text-slate-600 dark:text-slate-200">
                            Total Medicine Items
                        </div>
                        <div class="text-3xl leading-loose font-semibold text-slate-700 dark:text-white">
                            {{ $total_medicine_items }}
                        </div>
                    </div>
                </div>
                <div class="flex border-r border-white dark:border-gray-500 px-2 py-4">
                    <div>
                        <div class="p-2 rounded-lg bg-white w-fit mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-indigo-600">
                                <path d="M21 6.375c0 2.692-4.03 4.875-9 4.875S3 9.067 3 6.375 7.03 1.5 12 1.5s9 2.183 9 4.875z" />
                                <path d="M12 12.75c2.685 0 5.19-.586 7.078-1.609a8.283 8.283 0 001.897-1.384c.016.121.025.244.025.368C21 12.817 16.97 15 12 15s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.285 8.285 0 001.897 1.384C6.809 12.164 9.315 12.75 12 12.75z" />
                                <path d="M12 16.5c2.685 0 5.19-.586 7.078-1.609a8.282 8.282 0 001.897-1.384c.016.121.025.244.025.368 0 2.692-4.03 4.875-9 4.875s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.284 8.284 0 001.897 1.384C6.809 15.914 9.315 16.5 12 16.5z" />
                                <path d="M12 20.25c2.685 0 5.19-.586 7.078-1.609a8.282 8.282 0 001.897-1.384c.016.121.025.244.025.368 0 2.692-4.03 4.875-9 4.875s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.284 8.284 0 001.897 1.384C6.809 19.664 9.315 20.25 12 20.25z" />
                              </svg>
                        </div>
                        <div class=" font-semibold text-sm text-slate-600 dark:text-slate-200">
                            Money Receive on Sales
                        </div>
                        <div class="text-3xl leading-loose font-semibold text-slate-700 dark:text-white">
                           Rp {{ number_format($money_receive_on_sales, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
                <div class="flex border-r border-white dark:border-gray-500 px-2 py-4">
                    <div>
                        <div class="p-2 rounded-lg bg-white w-fit mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-indigo-600">
                                <path d="M21 6.375c0 2.692-4.03 4.875-9 4.875S3 9.067 3 6.375 7.03 1.5 12 1.5s9 2.183 9 4.875z" />
                                <path d="M12 12.75c2.685 0 5.19-.586 7.078-1.609a8.283 8.283 0 001.897-1.384c.016.121.025.244.025.368C21 12.817 16.97 15 12 15s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.285 8.285 0 001.897 1.384C6.809 12.164 9.315 12.75 12 12.75z" />
                                <path d="M12 16.5c2.685 0 5.19-.586 7.078-1.609a8.282 8.282 0 001.897-1.384c.016.121.025.244.025.368 0 2.692-4.03 4.875-9 4.875s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.284 8.284 0 001.897 1.384C6.809 15.914 9.315 16.5 12 16.5z" />
                                <path d="M12 20.25c2.685 0 5.19-.586 7.078-1.609a8.282 8.282 0 001.897-1.384c.016.121.025.244.025.368 0 2.692-4.03 4.875-9 4.875s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.284 8.284 0 001.897 1.384C6.809 19.664 9.315 20.25 12 20.25z" />
                              </svg>
                        </div>
                        <div class=" font-semibold text-sm text-slate-600 dark:text-slate-200">
                            Money Spent on Purchases
                        </div>
                        <div class="text-3xl leading-loose font-semibold text-slate-700 dark:text-white">
                            Rp {{ number_format($money_spent_on_purchases, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
                <div class="flex border-r border-white dark:border-gray-500 px-2 py-4">
                    <div>
                        <div class="p-2 rounded-lg bg-white w-fit mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-indigo-600">
                                <path d="M21 6.375c0 2.692-4.03 4.875-9 4.875S3 9.067 3 6.375 7.03 1.5 12 1.5s9 2.183 9 4.875z" />
                                <path d="M12 12.75c2.685 0 5.19-.586 7.078-1.609a8.283 8.283 0 001.897-1.384c.016.121.025.244.025.368C21 12.817 16.97 15 12 15s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.285 8.285 0 001.897 1.384C6.809 12.164 9.315 12.75 12 12.75z" />
                                <path d="M12 16.5c2.685 0 5.19-.586 7.078-1.609a8.282 8.282 0 001.897-1.384c.016.121.025.244.025.368 0 2.692-4.03 4.875-9 4.875s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.284 8.284 0 001.897 1.384C6.809 15.914 9.315 16.5 12 16.5z" />
                                <path d="M12 20.25c2.685 0 5.19-.586 7.078-1.609a8.282 8.282 0 001.897-1.384c.016.121.025.244.025.368 0 2.692-4.03 4.875-9 4.875s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.284 8.284 0 001.897 1.384C6.809 19.664 9.315 20.25 12 20.25z" />
                              </svg>
                        </div>
                        <div class=" font-semibold text-sm text-slate-600 dark:text-slate-200">
                            Total Items Sold
                        </div>
                        <div class="text-3xl leading-loose font-semibold text-slate-700 dark:text-white">
                            {{ $total_items_sold }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
