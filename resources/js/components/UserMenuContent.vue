<script setup>
import UserInfo from '@/components/UserInfo.vue';
import {
    DropdownMenuGroup,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
} from '@/components/ui/dropdown-menu';
import { router } from '@inertiajs/vue3';
import { LogOut, Settings } from 'lucide-vue-next';

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
});

const handleLogout = () => {
    router.post('/logout', {}, {
        onSuccess: () => {
            router.visit('/login');
        },
    });
};

const goToSettings = () => {
    router.visit('/settings/profile');
};
</script>

<template>
    <DropdownMenuLabel class="p-0 font-normal">
        <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
            <UserInfo :user="props.user" :show-email="true" />
        </div>
    </DropdownMenuLabel>
    <DropdownMenuSeparator />
    <DropdownMenuGroup>
        <DropdownMenuItem :as-child="true">
            <button class="flex w-full items-center gap-2 px-2 py-1.5 text-sm" @click="goToSettings">
                <Settings class="h-4 w-4" />
                Configuración
            </button>
        </DropdownMenuItem>
    </DropdownMenuGroup>
    <DropdownMenuSeparator />
    <DropdownMenuItem :as-child="true">
        <button
            class="flex w-full items-center gap-2 px-2 py-1.5 text-sm"
            data-test="logout-button"
            @click="handleLogout"
        >
            <LogOut class="h-4 w-4" />
            Salir
        </button>
    </DropdownMenuItem>
</template>
