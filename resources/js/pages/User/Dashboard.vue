<template>
    <div>Page user</div>
    <button @click="logout" class="rounded bg-red-500 px-4 py-2 text-white hover:bg-red-600">Logout</button>
</template>

<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
const form = useForm({});
const logout = () => {
    form.post(route('logout'));
};
</script>
