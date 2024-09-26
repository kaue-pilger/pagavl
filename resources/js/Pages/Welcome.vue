<script setup>
import { Head, Link } from '@inertiajs/vue3';

import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import DashboardScreen from '@/Components/DashboardScreen.vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});
</script>

<template>
    <Head title="Welcome" />
    <div class="bg-daintree text-black/50 dark:bg-black dark:text-white/50">
        <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full px-5">
                <header class="flex flex-row justify-between items-start gap-2 pt-10">
                    <div class="flex lg:justify-center lg:col-start-2">
                      <a href="/">
                        <ApplicationLogo />
                      </a>
                    </div>
                    <nav v-if="canLogin" class="flex justify-end gap-3 p-3.5 rounded-full bg-white">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="bg-algae-gree rounded-full px-3 py-2 text-daintree hover:opacity-90 transition"
                        >
                            Dashboard
                        </Link>

                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="bg-black-haze rounded-full px-3 py-2 text-daintree hover:opacity-90 transition"
                            >
                                Log In
                            </Link>

                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="bg-algae-gree rounded-full px-3 py-2 text-daintree hover:opacity-90 transition"
                            >
                                Register
                            </Link>
                        </template>
                    </nav>
                </header>

                <main class="flex flex-row bg-daintree mt-6 gap-12">
                    <div class="flex flex-col w-1/2 gap-6">
                        <div>
                            <span class="inline-block py-1.5 px-3 rounded-full bg-te-papa-green text-algae-gree">
                                Send and receive
                            </span>
                        </div>
                        <h1 class="text-6xl text-white">
                            Transfer and receive global payments.
                        </h1>
                        <p>
                            Replace the hassle of traditional banking with our Payment Accounts to make, receive and manage global payments in the blink of an eye.
                        </p>
                    </div>
                    <DashboardScreen class="block h-4 w-1/2 -mt-12" />
                </main>
            </div>
        </div>
    </div>
</template>
