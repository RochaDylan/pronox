<script setup lang="ts">
import type { HTMLAttributes } from 'vue';

defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
}

defineProps<Props>();
</script>

<template>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="18 9.5 70 78.5" :class="className" v-bind="$attrs">
        <rect x="20" y="16" width="15" height="70" rx="7.5" fill="#C8F25C" />
        <circle cx="57" cy="40" r="21" fill="none" stroke="#C8F25C" stroke-width="15" />
        <circle cx="57" cy="40" r="6.5" fill="white" />
    </svg>
</template>
