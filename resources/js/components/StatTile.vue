<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { PhCaretRight } from '@phosphor-icons/vue';
import type { Component } from 'vue';

defineProps<{
    label: string;
    value: number;
    icon: Component;
    href: string;
    hint?: string;
}>();

const format = (n: number) => new Intl.NumberFormat('fr-FR').format(n);
</script>

<template>
    <Link
        :href="href"
        class="flex min-h-[152px] flex-col gap-1 rounded-[19px] border border-[#262626] bg-[#131313] p-4 transition hover:border-[#3a3a3a]"
    >
        <div class="flex items-center justify-between pb-2">
            <span class="flex size-[34px] items-center justify-center rounded-md bg-[#1f1f1f] text-[#f2f2f2]">
                <component :is="icon" :size="18" />
            </span>
            <PhCaretRight :size="18" class="text-[#8c8c8c]" />
        </div>

        <p class="font-['Doto'] text-[29px] font-black text-[#f2f2f2]">
            {{ format(value) }}
        </p>
        <p class="font-['Barlow_Condensed'] text-base font-semibold text-[#f2f2f2]">
            {{ label }}
        </p>
        <p v-if="hint" class="font-['Barlow_Condensed'] text-[13.5px] font-medium text-[#8c8c8c]">
            {{ hint }}
        </p>
    </Link>
</template>
