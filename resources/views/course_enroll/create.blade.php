<script src="https://cdn.tailwindcss.com"></script>

<x-layout>
    <x-slot:heading>
        Payment
    </x-slot:heading>

    <!-- Page background -->
    <div class="min-h-[calc(100vh-120px)] bg-gradient-to-b from-slate-50 via-white to-slate-50 dark:from-gray-950 dark:via-gray-950 dark:to-gray-900">
        <div class="mx-auto max-w-7xl px-4 py-10 sm:py-14">
            <!-- Header -->
            <div class="mx-auto max-w-5xl">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <h1 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Secure checkout</h1>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                            Choose your payment method and complete your enrollment in seconds.
                        </p>
                    </div>

                    <div class="mt-4 inline-flex items-center gap-2 rounded-full border border-gray-200 bg-white/70 px-4 py-2 text-xs font-medium text-gray-700 shadow-sm backdrop-blur dark:border-gray-800 dark:bg-gray-900/60 dark:text-gray-200 sm:mt-0">
                        <span class="inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
                        SSL Secured • PCI-style UI
                    </div>
                </div>

                <div class="mt-8 grid grid-cols-1 gap-8 lg:grid-cols-12">
                    <!-- Left: Payment methods + form -->
                    <div class="lg:col-span-7">
                        <div class="rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">
                            <!-- Tabs -->
                            <div class="border-b border-gray-200 px-6 py-5 dark:border-gray-800">
                                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="grid h-10 w-10 place-items-center rounded-xl bg-gradient-to-br from-indigo-600 to-fuchsia-600 text-white shadow">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 01.88 7.903A5 5 0 1115 8.05M16 7V3m0 4h4" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-900 dark:text-white">Payment method</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Card, Mobile Banking, or PayPal</p>
                                        </div>
                                    </div>

                                    <div class="flex flex-wrap items-center gap-2 text-xs">
                                        <span class="rounded-full bg-emerald-50 px-3 py-1 font-medium text-emerald-700 dark:bg-emerald-950/50 dark:text-emerald-300">Instant confirmation</span>
                                        <span class="rounded-full bg-slate-100 px-3 py-1 font-medium text-slate-700 dark:bg-gray-800 dark:text-gray-200">24/7 support</span>
                                    </div>
                                </div>

                                <!-- Method selector (UI only; backend unchanged) -->
                                <div class="mt-5 grid grid-cols-2 gap-3 sm:grid-cols-3">
                                    <!-- Mobile payments -->
                                    <button type="button" class="group flex items-center justify-between rounded-xl border border-gray-200 bg-white px-4 py-3 text-left shadow-sm transition hover:-translate-y-0.5 hover:border-indigo-300 hover:shadow-md dark:border-gray-800 dark:bg-gray-950 dark:hover:border-indigo-700">
                                        <div class="flex items-center gap-3">
                                            <span class="grid h-9 w-9 place-items-center rounded-lg bg-pink-50 text-pink-600 dark:bg-pink-950/40 dark:text-pink-300">
                                                <!-- phone icon -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M7 2a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H7Zm5 19a1.25 1.25 0 1 1 0-2.5A1.25 1.25 0 0 1 12 21Z"/>
                                                </svg>
                                            </span>
                                            <div>
                                                <p class="text-sm font-semibold text-gray-900 dark:text-white">Mobile</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">bKash • Rocket • Nagad</p>
                                            </div>
                                        </div>
                                        <svg class="h-4 w-4 text-gray-400 transition group-hover:translate-x-0.5 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </button>

                                    <!-- PayPal -->
                                    <button type="button" class="group flex items-center justify-between rounded-xl border border-gray-200 bg-white px-4 py-3 text-left shadow-sm transition hover:-translate-y-0.5 hover:border-indigo-300 hover:shadow-md dark:border-gray-800 dark:bg-gray-950 dark:hover:border-indigo-700">
                                        <div class="flex items-center gap-3">
                                            <span class="grid h-9 w-9 place-items-center rounded-lg bg-blue-50 text-blue-600 dark:bg-blue-950/40 dark:text-blue-300">
                                                <!-- paypal-ish icon -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M7.5 3h9a4.5 4.5 0 0 1 0 9H13l-1 7H7.5L9.3 6.5A4.5 4.5 0 0 1 7.5 3Z"/>
                                                </svg>
                                            </span>
                                            <div>
                                                <p class="text-sm font-semibold text-gray-900 dark:text-white">PayPal</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">Pay with your balance</p>
                                            </div>
                                        </div>
                                        <svg class="h-4 w-4 text-gray-400 transition group-hover:translate-x-0.5 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </button>

                                    <!-- Card -->
                                    <button type="button" class="group flex items-center justify-between rounded-xl border border-indigo-200 bg-indigo-50/60 px-4 py-3 text-left shadow-sm transition hover:-translate-y-0.5 hover:border-indigo-300 hover:shadow-md dark:border-indigo-900/60 dark:bg-indigo-950/30">
                                        <div class="flex items-center gap-3">
                                            <span class="grid h-9 w-9 place-items-center rounded-lg bg-indigo-600 text-white shadow">
                                                <!-- card icon -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M4 6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v2H4V6Zm0 5h18v7a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-7Zm4 4a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H8Z"/>
                                                </svg>
                                            </span>
                                            <div>
                                                <p class="text-sm font-semibold text-gray-900 dark:text-white">Card</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">Credit / Debit</p>
                                            </div>
                                        </div>
                                        <span class="rounded-full bg-white px-2.5 py-1 text-[11px] font-semibold text-indigo-700 shadow-sm dark:bg-gray-950 dark:text-indigo-300">Selected</span>
                                    </button>
                                </div>

                                <!-- Logos row -->
                                <div class="mt-5 flex flex-wrap items-center gap-4">
                                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Accepted:</span>

                                    <!-- bKash / Rocket / Nagad as text badges (no external deps) -->
                                    <span class="rounded-full border border-gray-200 bg-white px-3 py-1 text-xs font-semibold text-gray-700 dark:border-gray-800 dark:bg-gray-950 dark:text-gray-200">bKash</span>
                                    <span class="rounded-full border border-gray-200 bg-white px-3 py-1 text-xs font-semibold text-gray-700 dark:border-gray-800 dark:bg-gray-950 dark:text-gray-200">Rocket</span>
                                    <span class="rounded-full border border-gray-200 bg-white px-3 py-1 text-xs font-semibold text-gray-700 dark:border-gray-800 dark:bg-gray-950 dark:text-gray-200">Nagad</span>

                                    <span class="h-4 w-px bg-gray-200 dark:bg-gray-800"></span>

                                    <img class="h-6 w-auto dark:hidden" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/brand-logos/paypal.svg" alt="PayPal" />
                                    <img class="hidden h-6 w-auto dark:flex" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/brand-logos/paypal-dark.svg" alt="PayPal" />
                                    <img class="h-6 w-auto dark:hidden" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/brand-logos/visa.svg" alt="Visa" />
                                    <img class="hidden h-6 w-auto dark:flex" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/brand-logos/visa-dark.svg" alt="Visa" />
                                    <img class="h-6 w-auto dark:hidden" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/brand-logos/mastercard.svg" alt="Mastercard" />
                                    <img class="hidden h-6 w-auto dark:flex" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/brand-logos/mastercard-dark.svg" alt="Mastercard" />
                                </div>
                            </div>

                            <!-- Form (backend unchanged: same action, method, names) -->
                            <form action="{{ route('course-enroll.store', $course->id) }}" method="post" class="px-6 py-6">
                                @csrf

                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                    <div class="sm:col-span-2">
                                        <label for="full_name" class="mb-2 block text-sm font-semibold text-gray-900 dark:text-white">
                                            Full name <span class="font-normal text-gray-500 dark:text-gray-400">(as displayed on card)</span> *
                                        </label>
                                        <div class="relative">
                                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                                <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5Zm-8 9a8 8 0 0 1 16 0Z"/>
                                                </svg>
                                            </div>
                                            <input
                                                type="text"
                                                name="full_name"
                                                class="block w-full rounded-xl border border-gray-200 bg-gray-50/70 py-3 pl-10 pr-3 text-sm text-gray-900 shadow-sm outline-none transition focus:border-indigo-400 focus:ring-4 focus:ring-indigo-100 dark:border-gray-800 dark:bg-gray-950 dark:text-white dark:placeholder:text-gray-500 dark:focus:border-indigo-700 dark:focus:ring-indigo-900/30"
                                                placeholder="Bonnie Green"
                                                required
                                            />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="card-number-input" class="mb-2 block text-sm font-semibold text-gray-900 dark:text-white">
                                            Card number *
                                        </label>
                                        <div class="relative">
                                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                                <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M4 6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v2H4V6Zm0 5h18v7a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-7Z"/>
                                                </svg>
                                            </div>
                                            <input
                                                type="text"
                                                name="cardNumber"
                                                class="block w-full rounded-xl border border-gray-200 bg-gray-50/70 py-3 pl-10 pr-24 text-sm text-gray-900 shadow-sm outline-none transition focus:border-indigo-400 focus:ring-4 focus:ring-indigo-100 dark:border-gray-800 dark:bg-gray-950 dark:text-white dark:placeholder:text-gray-500 dark:focus:border-indigo-700 dark:focus:ring-indigo-900/30"
                                                placeholder="xxxx-xxxx-xxxx-xxxx"
                                                required
                                            />
                                            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center gap-2">
                                                <span class="rounded-md border border-gray-200 bg-white px-2 py-1 text-[10px] font-semibold text-gray-600 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-200">VISA</span>
                                                <span class="rounded-md border border-gray-200 bg-white px-2 py-1 text-[10px] font-semibold text-gray-600 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-200">MC</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <label for="card-expiration-input" class="mb-2 block text-sm font-semibold text-gray-900 dark:text-white">
                                            Expiration *
                                        </label>
                                        <div class="relative">
                                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                                <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd" d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                            <input
                                                datepicker
                                                name="cardExpiration"
                                                type="text"
                                                class="block w-full rounded-xl border border-gray-200 bg-gray-50/70 py-3 pl-10 pr-3 text-sm text-gray-900 shadow-sm outline-none transition focus:border-indigo-400 focus:ring-4 focus:ring-indigo-100 dark:border-gray-800 dark:bg-gray-950 dark:text-white dark:placeholder:text-gray-500 dark:focus:border-indigo-700 dark:focus:ring-indigo-900/30"
                                                placeholder="MM/YY"
                                                required
                                            />
                                        </div>
                                    </div>

                                    <div>
                                        <label for="cvv-input" class="mb-2 flex items-center gap-2 text-sm font-semibold text-gray-900 dark:text-white">
                                            CVV *
                                            <span class="inline-flex items-center rounded-full bg-gray-100 px-2 py-0.5 text-[11px] font-medium text-gray-600 dark:bg-gray-800 dark:text-gray-300">
                                                3 digits
                                            </span>
                                        </label>
                                        <div class="relative">
                                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                                <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M12 1a5 5 0 0 0-5 5v4H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2h-1V6a5 5 0 0 0-5-5Zm-3 9V6a3 3 0 0 1 6 0v4H9Z"/>
                                                </svg>
                                            </div>
                                            <input
                                                type="number"
                                                name="cvv"
                                                aria-describedby="helper-text-explanation"
                                                class="block w-full rounded-xl border border-gray-200 bg-gray-50/70 py-3 pl-10 pr-3 text-sm text-gray-900 shadow-sm outline-none transition focus:border-indigo-400 focus:ring-4 focus:ring-indigo-100 dark:border-gray-800 dark:bg-gray-950 dark:text-white dark:placeholder:text-gray-500 dark:focus:border-indigo-700 dark:focus:ring-indigo-900/30"
                                                placeholder="•••"
                                                required
                                            />
                                        </div>
                                    </div>
                                </div>

                                <!-- Small helper row -->
                                <div class="mt-5 flex flex-col gap-3 rounded-xl border border-gray-200 bg-gray-50 px-4 py-4 text-sm text-gray-700 dark:border-gray-800 dark:bg-gray-950 dark:text-gray-200 sm:flex-row sm:items-center sm:justify-between">
                                    <div class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-100 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                                <path fill-rule="evenodd" d="M12 1a11 11 0 1 0 11 11A11.012 11.012 0 0 0 12 1Zm-1.25 15.25-3.5-3.5a1 1 0 0 1 1.414-1.414l2.086 2.086 4.836-6.45a1 1 0 1 1 1.6 1.2l-5.5 7.333a1 1 0 0 1-.736.395Z" clip-rule="evenodd"/>
                                            </svg>
                                        </span>
                                        <div>
                                            <p class="font-semibold">Your payment is protected</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">We don’t store your card details on our server.</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 2a7 7 0 0 0-7 7v4a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V9a7 7 0 0 0-7-7Zm-5 7a5 5 0 0 1 10 0v1H7V9Z"/>
                                            <path d="M7 19a3 3 0 0 0 3 3h4a3 3 0 0 0 3-3v-2H7v2Z"/>
                                        </svg>
                                        Secure checkout
                                    </div>
                                </div>

                                <!-- Submit -->
                                <button
                                    type="submit"
                                    class="mt-6 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-fuchsia-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-200 transition hover:brightness-110 focus:outline-none focus:ring-4 focus:ring-indigo-200 dark:shadow-none dark:focus:ring-indigo-900/40"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 1a5 5 0 0 0-5 5v4H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2h-1V6a5 5 0 0 0-5-5Z"/>
                                    </svg>
                                    Pay now
                                    <span class="rounded-lg bg-white/15 px-2 py-1 text-xs font-bold">৳ {{ $course->payment }}</span>
                                </button>

                                <!-- Fine print -->
                                <p class="mt-4 text-center text-xs text-gray-500 dark:text-gray-400">
                                    By clicking “Pay now”, you agree to our terms and confirm your purchase.
                                </p>
                            </form>
                        </div>
                    </div>

                    <!-- Right: Order summary -->
                    <div class="lg:col-span-5">
                        <div class="sticky top-6 space-y-6">
                            <div class="rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">
                                <div class="border-b border-gray-200 px-6 py-5 dark:border-gray-800">
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">Order summary</p>
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Review the amount before paying.</p>
                                </div>

                                <div class="space-y-4 px-6 py-6">
                                    <div class="space-y-2">
                                        <dl class="flex items-center justify-between gap-4">
                                            <dt class="text-sm text-gray-600 dark:text-gray-300">Original price</dt>
                                            <dd class="text-sm font-semibold text-gray-900 dark:text-white">
                                                {{ intval($course->payment) + 1200 }}
                                            </dd>
                                        </dl>

                                        <dl class="flex items-center justify-between gap-4">
                                            <dt class="text-sm text-gray-600 dark:text-gray-300">Savings</dt>
                                            <dd class="text-sm font-semibold text-emerald-600 dark:text-emerald-400">-1500</dd>
                                        </dl>

                                        <dl class="flex items-center justify-between gap-4">
                                            <dt class="text-sm text-gray-600 dark:text-gray-300">Tax</dt>
                                            <dd class="text-sm font-semibold text-gray-900 dark:text-white">300</dd>
                                        </dl>
                                    </div>

                                    <div class="rounded-xl bg-gradient-to-r from-slate-50 to-white p-4 dark:from-gray-950 dark:to-gray-900">
                                        <dl class="flex items-center justify-between gap-4">
                                            <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                                            <dd class="text-base font-extrabold tracking-tight text-gray-900 dark:text-white">
                                                {{ $course->payment }}
                                            </dd>
                                        </dl>
                                        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Includes applicable taxes and discounts.</p>
                                    </div>

                                    <div class="grid grid-cols-3 gap-3">
                                        <div class="rounded-xl border border-gray-200 bg-white p-3 text-center text-xs text-gray-600 shadow-sm dark:border-gray-800 dark:bg-gray-950 dark:text-gray-300">
                                            <p class="font-semibold text-gray-900 dark:text-white">Instant</p>
                                            <p class="mt-1">Access</p>
                                        </div>
                                        <div class="rounded-xl border border-gray-200 bg-white p-3 text-center text-xs text-gray-600 shadow-sm dark:border-gray-800 dark:bg-gray-950 dark:text-gray-300">
                                            <p class="font-semibold text-gray-900 dark:text-white">Secure</p>
                                            <p class="mt-1">Checkout</p>
                                        </div>
                                        <div class="rounded-xl border border-gray-200 bg-white p-3 text-center text-xs text-gray-600 shadow-sm dark:border-gray-800 dark:bg-gray-950 dark:text-gray-300">
                                            <p class="font-semibold text-gray-900 dark:text-white">Support</p>
                                            <p class="mt-1">24/7</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Help card -->
                            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-800 dark:bg-gray-900">
                                <div class="flex items-start gap-3">
                                    <span class="grid h-10 w-10 place-items-center rounded-xl bg-slate-100 text-slate-700 dark:bg-gray-800 dark:text-gray-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 2a10 10 0 1 0 10 10A10.011 10.011 0 0 0 12 2Zm0 18a8 8 0 1 1 8-8 8.009 8.009 0 0 1-8 8Z"/>
                                            <path d="M12 6a1.25 1.25 0 1 0 1.25 1.25A1.25 1.25 0 0 0 12 6Zm1.5 11h-3a1 1 0 0 1 0-2h1v-4h-1a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v7h0Z"/>
                                        </svg>
                                    </span>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white">Having trouble paying?</p>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                            You can also pay via bKash/Rocket/Nagad and confirm instantly from support.
                                        </p>
                                        <div class="mt-4 flex flex-wrap gap-2">
                                            <span class="rounded-full border border-gray-200 bg-white px-3 py-1 text-xs font-semibold text-gray-700 dark:border-gray-800 dark:bg-gray-950 dark:text-gray-200">bKash</span>
                                            <span class="rounded-full border border-gray-200 bg-white px-3 py-1 text-xs font-semibold text-gray-700 dark:border-gray-800 dark:bg-gray-950 dark:text-gray-200">Rocket</span>
                                            <span class="rounded-full border border-gray-200 bg-white px-3 py-1 text-xs font-semibold text-gray-700 dark:border-gray-800 dark:bg-gray-950 dark:text-gray-200">Nagad</span>
                                            <span class="rounded-full border border-gray-200 bg-white px-3 py-1 text-xs font-semibold text-gray-700 dark:border-gray-800 dark:bg-gray-950 dark:text-gray-200">PayPal</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /Right -->
                </div>
            </div>
        </div>
    </div>
</x-layout>
