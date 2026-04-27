<script setup>
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Form, Head } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import { useAppearance } from '@/composables/useAppearance';


useAppearance();
</script>

<template>
    <AuthBase title="¡Inicia sesión!" description="Ingrese su correo y contraseña">

        <Head title="Log in" />

        <Form action="/login" method="post" :reset-on-success="['password']" v-slot="{ errors, processing }"
            class="flex flex-col gap-6">
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <v-label>Correo electronico</v-label>
                    <Input id="email" type="email" name="email" required autofocus :tabindex="1" autocomplete="email"
                        placeholder="correo@ejemplo.com" />
                    <InputError :message="errors.email" />
                </div>

                <div class="grid gap-2">
                    <div class="flex items-center justify-between">
                        <v-label>Contraseña</v-label>
                        <TextLink href="/forgot-password" class="text-sm" :tabindex="5">
                            ¿Olvidaste tu contraseña?
                        </TextLink>
                    </div>
                    <Input id="password" type="password" name="password" required :tabindex="2"
                        autocomplete="current-password" placeholder="Contraseña" />
                    <InputError :message="errors.password" />
                </div>

                <div class="flex items-center justify-between">
                    <Label for="remember" class="flex items-center space-x-3">
                        <Checkbox id="remember" name="remember" :tabindex="3" />
                        <span>Recordar</span>
                    </Label>
                </div>

                <Button type="submit" class="mt-4 w-full" :tabindex="4" :disabled="processing" data-test="login-button">
                    <LoaderCircle v-if="processing" class="h-4 w-4 animate-spin" />
                    Iniciar sesión
                </Button>
            </div>
            <div class="text-center text-sm text-muted-foreground">
                ¿No tiene una cuenta?
                <TextLink href="/register" :tabindex="5">Registrarse</TextLink>
            </div>
        </Form>
    </AuthBase>
</template>
