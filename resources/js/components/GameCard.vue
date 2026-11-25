<script setup lang="ts">
import { Game } from '@/types';
import { Link } from '@inertiajs/vue3';
import { PhCaretRight } from '@phosphor-icons/vue';
import { computed } from 'vue';

const props = defineProps<{
    game: Game;
}>();

const statusStyles = {
    scheduled: {
        border: 'border-[#262626]',
        badge: 'border border-[#8C8C8C] text-[#8C8C8C]',
        label: '',
    },
    live: {
        border: 'border-[#C8F25C]',
        badge: 'text-[#C8F25C]',
        label: '● En direct',
    },
    finished: {
        border: 'border-[#262626]',
        badge: 'border border-[#C8F25C] text-[#C8F25C]',
        label: 'Terminé',
    },
    postponed: {
        border: 'border-[#FF8A3D]',
        badge: 'border border-[#FF8A3D] text-[#FF8A3D]',
        label: 'Reporté',
    },
    cancelled: {
        border: 'border-[#262626]',
        badge: 'border border-[#8C8C8C] text-[#8C8C8C]',
        label: 'Annulé',
    },
};

const style = computed(() => statusStyles[props.game.status]);

const hasScore = computed(() => props.game.home_score !== null && props.game.away_score !== null);

const formatDate = (dateString: string) => {
    const date = new Date(dateString);

    const day = date.toLocaleDateString('fr-CH', {
        day: '2-digit',
        month: '2-digit',
        timeZone: 'Europe/Zurich',
    });

    return `${day} · ${formatTime(dateString)}`;
};

const formatTime = (dateString: string) => {
    return new Date(dateString).toLocaleTimeString('fr-CH', {
        hour: '2-digit',
        minute: '2-digit',
        timeZone: 'Europe/Zurich',
    });
};
</script>

<template>
    <div class="flex flex-col gap-[14px] rounded-[19px] border bg-[#131313] p-4 text-[#F2F2F2]" :class="style.border">
        <div class="flex items-center justify-between">
            <span class="font-['Doto'] text-[11.5px] font-bold uppercase tracking-[0.46px] text-[#8C8C8C]">{{ game.competition?.name }}</span>
            <span
                class="rounded-[4px] px-2 py-[3px] font-['Barlow_Condensed'] text-[12.5px] font-bold uppercase tracking-[0.75px]"
                :class="style.badge"
            >
                {{ style.label || formatDate(game.kickoff_at) }}
            </span>
        </div>

        <div class="flex items-center gap-2">
            <div class="flex min-w-0 flex-1 flex-col items-center gap-1.5 text-center">
                <div class="flex size-11 items-center justify-center rounded-full bg-[#1F1F1F] font-['Barlow_Condensed'] text-[13px] font-bold">
                    {{ game.home_team_logo }}
                </div>
                <span class="font-['Barlow_Condensed'] text-[15px] font-semibold">{{ game.home_team }}</span>
            </div>

            <div v-if="hasScore" class="flex items-center gap-2">
                <div class="flex h-14 w-12 items-center justify-center rounded-[6px] bg-[#0A0A0A] font-['Doto'] text-[26px] font-black">
                    {{ game.home_score }}
                </div>
                <span class="font-['Barlow_Condensed'] text-xl font-bold text-[#8C8C8C]">–</span>
                <div class="flex h-14 w-12 items-center justify-center rounded-[6px] bg-[#0A0A0A] font-['Doto'] text-[26px] font-black">
                    {{ game.away_score }}
                </div>
            </div>

            <div v-else class="flex flex-col items-center gap-0.5">
                <span class="font-['Doto'] text-[22px] font-black text-[#8C8C8C]">VS</span>
                <span class="font-['Barlow_Condensed'] text-[15px] font-bold">{{ formatTime(game.kickoff_at) }}</span>
            </div>

            <div class="flex min-w-0 flex-1 flex-col items-center gap-1.5 text-center">
                <div class="flex size-11 items-center justify-center rounded-full bg-[#1F1F1F] font-['Barlow_Condensed'] text-[13px] font-bold">
                    {{ game.away_team_logo }}
                </div>
                <span class="font-['Barlow_Condensed'] text-[15px] font-semibold">{{ game.away_team }}</span>
            </div>
        </div>

        <div class="flex items-center justify-between font-['Barlow_Condensed'] text-[13.5px]">
            <span class="font-medium text-[#8C8C8C]">{{ game.prediction_count ?? 0 }} pronostics</span>

            <Link :href="route('admin.games.show', { game: game.id })" class="flex items-center gap-0.5 font-semibold text-[#C8F25C]">
                Détails
                <PhCaretRight :size="16" weight="bold" />
            </Link>
        </div>
    </div>
</template>
