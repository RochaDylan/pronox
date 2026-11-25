<script setup lang="ts">
import FilterTabs from '@/components/FilterTabs.vue';
import GameCard from '@/components/GameCard.vue';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { Game } from '@/types';
import { router } from '@inertiajs/vue3';
import { PhMagnifyingGlass } from '@phosphor-icons/vue';
import { watchDebounced } from '@vueuse/core';
import { ref } from 'vue';

const props = defineProps<{
    games: Game[];
    upcomingGames: number;
    status: string;
    search: string | null;
}>();

const searchQuery = ref(props.search ?? '');

const filters = [
    {
        key: 'upcoming',
        label: 'À venir',
    },
    {
        key: 'today',
        label: "Aujourd'hui",
    },
    {
        key: 'finished',
        label: 'Terminés',
    },
    {
        key: 'postponed',
        label: 'Reportés',
    },
];

const submitSearch = () => {
    router.get(
        route('admin.games'),
        { search: searchQuery.value, status: props.status },
        { preserveState: true, preserveScroll: true, replace: true },
    );
};

watchDebounced(searchQuery, submitSearch, {});
</script>

<template>
    <AdminLayout>
        <div class="flex flex-col gap-[14px] px-[15px] pb-4 pt-12">
            <div class="flex flex-col gap-0.5">
                <h1 class="font-['Barlow_Condensed'] text-[27.5px] font-bold uppercase tracking-[0.55px] text-[#F2F2F2]">Matchs</h1>
                <p class="font-['Doto'] text-[11.5px] font-bold tracking-[0.46px] text-[#8C8C8C]">{{ upcomingGames }} à venir</p>
            </div>

            <div class="flex items-center gap-2.5 rounded-[6px] border border-[#262626] bg-[#131313] px-3.5 py-[13px]">
                <PhMagnifyingGlass :size="18" class="shrink-0 text-[#8C8C8C]" />
                <input
                    type="text"
                    placeholder="Rechercher une équipe"
                    class="w-full bg-transparent font-['Barlow_Condensed'] text-[15px] font-medium text-[#F2F2F2] outline-none placeholder:text-[#8C8C8C]"
                    v-model="searchQuery"
                />
            </div>

            <FilterTabs :active="status" route-name="admin.games" :params="{ search }" :tabs="filters" />

            <div class="flex flex-col gap-[14px]">
                <GameCard v-for="game in games" :key="game.id" :game="game"> </GameCard>
            </div>
        </div>
    </AdminLayout>
</template>
