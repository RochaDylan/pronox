<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <AuthBase title="Créer un compte" description="Entrez votre pseudo, votre adresse e-mail et votre mot de passe pour créer un compte">
        <Head title="Créer un compte" />

        <form @submit.prevent="submit" class="flex flex-col gap-6">
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="name">Pseudo</Label>
                    <Input
                        class="focus-visible:ring-[#C8F25C]"
                        id="name"
                        type="text"
                        required
                        autofocus
                        tabindex="1"
                        autocomplete="name"
                        v-model="form.name"
                        placeholder="Pseudonyme"
                    />
                    <InputError :message="form.errors.name" />
                </div>

                <div class="grid gap-2">
                    <Label for="email">Adresse email</Label>
                    <Input
                        class="focus-visible:ring-[#C8F25C]"
                        id="email"
                        type="email"
                        required
                        tabindex="2"
                        autocomplete="email"
                        v-model="form.email"
                        placeholder="email@exemple.com"
                    />
                    <InputError :message="form.errors.email" />
                </div>

                <div class="grid gap-2">
                    <Label for="password">Mot de passe</Label>
                    <Input
                        class="focus-visible:ring-[#C8F25C]"
                        id="password"
                        type="password"
                        required
                        tabindex="3"
                        autocomplete="new-password"
                        v-model="form.password"
                        placeholder="Mot de passe"
                    />
                    <InputError :message="form.errors.password" />
                </div>

                <div class="grid gap-2">
                    <Label for="password_confirmation">Confirmer le mot de passe</Label>
                    <Input
                        class="focus-visible:ring-[#C8F25C]"
                        id="password_confirmation"
                        type="password"
                        required
                        tabindex="4"
                        autocomplete="new-password"
                        v-model="form.password_confirmation"
                        placeholder="Confirmer le mot de passe"
                    />
                    <InputError :message="form.errors.password_confirmation" />
                </div>

                <Button type="submit" class="text-bold mt-2 w-full text-black hover:bg-[#C8F25C]" tabindex="5" :disabled="form.processing">
                    <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                    Créer un compte
                </Button>
            </div>

            <div class="text-center text-sm text-muted-foreground">
                Possèdez-vous déjà un compte ?
                <TextLink :href="route('login')" class="underline underline-offset-4 hover:text-[#C8F25C]" :tabindex="6">Se connecter</TextLink>
            </div>
        </form>
    </AuthBase>
</template>
