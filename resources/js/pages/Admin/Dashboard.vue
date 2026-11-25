<script setup lang="ts">
import StatTile from '@/components/StatTile.vue';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { Link } from '@inertiajs/vue3';
import { PhCaretRight, PhClock, PhSignOut, PhSoccerBall, PhTrophy, PhUsers, PhUsersThree, PhWarning } from '@phosphor-icons/vue';
import { computed } from 'vue';

const props = defineProps<{
    users: number;
    upcomingGames: number;
    todayGame: number;
    groups: number;
    groupsThisWeek: number;
    competitions: number;
    missingScore: number;
    postponed: number;
}>();

const todoCount = computed(() => props.missingScore + props.postponed);
</script>

<template>
    <AdminLayout>
        <div>
            <header class="flex items-center gap-3 p-5">
                <div class="flex min-w-0 flex-1 flex-col gap-0.5 py-5">
                    <h1 class="text-[27.5px] font-[Barlow_Condensed] font-bold uppercase leading-tight tracking-[0.55px] text-[#f2f2f2]">
                        Administration
                    </h1>
                    <p class="tracking font-[Doto] text-[11.5px] font-bold text-[#C4C4C4]">Connecté en tant qu'admin</p>
                </div>
                <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    aria-label="Se déconnecter"
                    class="flex size-[49px] shrink-0 items-center justify-center rounded-full bg-[#131313] text-[#f2f2f2] transition-colors hover:bg-[#1f1f1f] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#c8f25c]"
                >
                    <PhSignOut :size="24" />
                </Link>
            </header>

            <section class="mx-4 rounded-[19px] border border-[#262626] bg-[#131313] px-4 pb-1 pt-3.5">
                <div class="flex items-center justify-between pb-2">
                    <h2 class="font-[Doto] text-[11.5px] font-bold uppercase tracking-[0.46px] text-[#8c8c8c]">À traiter</h2>
                    <span
                        v-if="todoCount > 0"
                        class="rounded px-2 py-0.5 font-[Doto] text-[11px] font-bold text-[#0a0a0a]"
                        style="background-color: #ff8a3d"
                    >
                        {{ todoCount }}
                    </span>
                </div>

                <!-- Matchs sans score final -->
                <Link
                    v-if="missingScore > 0"
                    :href="route('admin.games', { status: 'finished' })"
                    class="flex items-center gap-3 border-t border-[#1f1f1f] py-3"
                >
                    <span class="flex size-9 shrink-0 items-center justify-center rounded-md bg-[#1f1f1f]">
                        <PhWarning :size="18" class="text-[#ff8a3d]" />
                    </span>
                    <span class="flex min-w-0 flex-1 flex-col gap-0.5 font-[Barlow_Condensed]">
                        <span class="text-base font-semibold text-[#f2f2f2]">
                            {{ missingScore }} {{ missingScore > 1 ? 'matchs sans score final' : 'match sans score final' }}
                        </span>
                    </span>
                    <PhCaretRight :size="18" class="shrink-0 text-[#8c8c8c]" />
                </Link>

                <!-- Matchs reportés -->
                <Link
                    v-if="postponed > 0"
                    :href="route('admin.games', { status: 'postponed' })"
                    class="flex items-center gap-3 border-t border-[#1f1f1f] py-3"
                >
                    <span class="flex size-9 shrink-0 items-center justify-center rounded-md bg-[#1f1f1f]">
                        <PhClock :size="18" class="text-[#f2f2f2]" />
                    </span>
                    <span class="flex min-w-0 flex-1 flex-col gap-0.5 font-[Barlow_Condensed]">
                        <span class="text-base font-semibold text-[#f2f2f2]">
                            {{ postponed }} {{ postponed > 1 ? 'matchs reportés' : 'match reporté' }}
                        </span>
                    </span>
                    <PhCaretRight :size="18" class="shrink-0 text-[#8c8c8c]" />
                </Link>

                <!-- Rien à traiter -->
                <p v-if="todoCount === 0" class="border-t border-[#1f1f1f] py-3 text-[13.5px] font-[Barlow_Condensed] font-medium text-[#8c8c8c]">
                    Rien à traiter pour le moment.
                </p>
            </section>

            <div class="mt-5 px-5 font-[Doto] text-[#C4C4C4]">Gestion</div>
            <div class="grid grid-cols-2 gap-3.5 p-4">
                <StatTile label="Joueurs" :value="users" :icon="PhUsers" :href="route('admin.users')" />
                <StatTile
                    label="Matchs à venir"
                    :value="upcomingGames"
                    :hint="`${todayGame} aujourd'hui`"
                    :icon="PhSoccerBall"
                    :href="route('admin.games')"
                />
                <StatTile
                    label="Groupes"
                    :value="groups"
                    :hint="`${groupsThisWeek} créés cette semaine`"
                    :icon="PhUsersThree"
                    :href="route('admin.groups')"
                />
                <StatTile label="Competitions" :value="competitions" hint="Importé via l'API" :icon="PhTrophy" href="" />
            </div>
        </div>
    </AdminLayout>
</template>
