<script setup lang="ts">
import BottomNav from '@/components/BottomNav.vue';
import { type NavItem } from '@/types';
import { LayoutDashboard, PersonStandingIcon, Target, UserRound } from 'lucide-vue-next';

const items: NavItem[] = [
    {
        title: 'Accueil',
        href: route('admin.dashboard'),
        icon: LayoutDashboard,
    },

    {
        title: 'Matchs',
        href: route('admin.games'),
        icon: Target,
    },
    {
        title: 'Utilisateurs',
        href: route('admin.users'),
        icon: UserRound,
    },
    {
        title: 'Groupes',
        href: route('admin.groups'),
        icon: PersonStandingIcon,
    },
];
</script>

<template>
    <div class="min-h-screen pb-20">
        <slot />
    </div>

    <BottomNav class="fixed bottom-0 left-0 right-0 z-50 flex justify-between border-t bg-background/90 p-3 py-2 backdrop-blur-md" :items="items" />
</template>
