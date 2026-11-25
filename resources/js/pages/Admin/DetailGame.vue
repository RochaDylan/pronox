<script setup lang="ts">
import { Game } from '@/types';

const props = defineProps<{
    game: Game;
}>();
</script>

<template>
    <div>
        {{ game.home_team }}
    </div>
</template>
