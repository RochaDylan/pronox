<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

type Tab = {
    key: string;
    label: string;
};

const props = defineProps<{
    tabs: Tab[];
    active: string;
    routeName: string;
    params?: Record<string, string | null>;
}>();

const styles = {
    active: 'bg-[#C8F25C] text-[#0A0A0A] border-[#C8F25C]',
    inactive: 'bg-[#0A0A0A] text-[#F2F2F2] border-[#2E2E2E]',
};

const href = (key: string) => route(props.routeName, { ...props.params, status: key });
</script>

<template>
    <div class="flex gap-2.5 overflow-x-auto">
        <Link
            v-for="tab in tabs"
            :key="tab.key"
            :href="href(tab.key)"
            preserve-scroll
            class="rounded-[6px] border p-3 font-['Barlow_Condensed'] text-[15px] font-bold"
            :class="styles[tab.key === active ? 'active' : 'inactive']"
        >
            {{ tab.label }}
        </Link>
    </div>
</template>
