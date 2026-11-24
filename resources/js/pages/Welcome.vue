<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';

const page = usePage<{
    auth: {
        user: unknown;
    };
}>();
</script>

<template>
    <Head title="Bienvenue"> </Head>

    <div
        class="flex min-h-screen flex-col items-center justify-center gap-12 bg-[#0A0A0A] p-6 text-[#F2F2F2]"
        style="font-family: 'Barlow Condensed', sans-serif"
    >
        <AppLogoIcon class="size-20 fill-current text-[#C8F25C]" />
        <div class="flex w-full max-w-xs flex-col items-center gap-4">
            <Link
                :href="page.props.auth.user ? route('dashboard') : route('register')"
                class="w-full rounded-md bg-[#C8F25C] py-3.5 text-center text-lg font-bold uppercase tracking-wider text-[#0A0A0A] transition hover:brightness-95 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#C8F25C] focus-visible:ring-offset-2 focus-visible:ring-offset-[#0A0A0A]"
            >
                Commencer
            </Link>

            <Link v-if="!page.props.auth.user" :href="route('login')" class="text-base font-medium text-[#8C8C8C] transition hover:text-[#F2F2F2]">
                J'ai déjà un compte
            </Link>
        </div>
    </div>
</template>
