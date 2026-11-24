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
            class="flex flex-col items-center justify-center gap-1 rounded-lg px-2 py-1 text-sm font-medium text-muted-foreground hover:bg-accent hover:text-accent-foreground"
            :class="{ 'bg-accent text-accent-foreground': isActive(item) }"
        >
            <component :is="item.icon" class="size-5" />
            <span>{{ item.title }}</span>
        </Link>
    </nav>
</template>
