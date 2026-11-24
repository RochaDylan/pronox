<script setup lang="ts">
import BottomNav from '@/components/BottomNav.vue';
import { type NavItem } from '@/types';
import { PhSoccerBall, PhSquaresFour, PhUser, PhUsersThree } from '@phosphor-icons/vue';

const items: NavItem[] = [
    {
        title: 'Accueil',
        href: route('admin.dashboard'),
        icon: PhSquaresFour,
    },

    {
        title: 'Matchs',
        href: route('admin.games'),
        icon: PhSoccerBall,
    },
    {
        title: 'Utilisateurs',
        href: route('admin.users'),
        icon: PhUser,
    },
    {
        title: 'Groupes',
        href: route('admin.groups'),
        icon: PhUsersThree,
    },
];
</script>

<template>
    <div class="min-h-screen pb-20">
        <slot />
    </div>

    <BottomNav class="fixed bottom-0 left-0 right-0 z-50 flex justify-between border-t bg-background/90 p-3 py-2 backdrop-blur-md" :items="items" />
</template>
