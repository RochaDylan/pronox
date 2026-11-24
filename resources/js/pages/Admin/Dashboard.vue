<template>
    <AdminLayout> </AdminLayout>
</template>

<script setup lang="ts">
import AdminLayout from '@/layouts/AdminLayout.vue';
import { useForm } from '@inertiajs/vue3';
const form = useForm({});

const logout = () => {
    form.post(route('logout'));
};
</script>
