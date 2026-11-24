<script setup lang="ts">
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';

defineProps<{
    items: NavItem[];
}>();

const page = usePage();

const toPath = (url: string): string => new URL(url, window.location.origin).pathname;

const isActive = (item: NavItem): boolean => {
    const current = toPath(page.url);
    const target = toPath(item.href);

    return current === target || current.startsWith(`${target}/`);
};
</script>

<template>
    <nav class="flex flex-row">
        <Link
            v-for="item in items"
            :key="item.title"
            :href="item.href"
            class="flex flex-col items-center justify-center gap-1 rounded-lg px-2 py-1 text-sm font-medium transition-colors"
            :class="isActive(item) ? 'text-[#C8F25C]' : 'text-muted-foreground hover:bg-accent hover:text-accent-foreground'"
        >
            <component :is="item.icon" :size="20" :weight="isActive(item) ? 'fill' : 'regular'" />
            <span>{{ item.title }}</span>
        </Link>
    </nav>
</template>
