<script setup lang="ts">
import { useAppearance } from '@/composables/useAppearance';
import { Monitor, Moon, Palette, Sun } from 'lucide-vue-next';

const { appearance, updateAppearance } = useAppearance();

const tabs = [
    { value: 'light', Icon: Sun, label: 'Claro' },
    { value: 'dark', Icon: Moon, label: 'Oscuro' },
    { value: 'grey', Icon: Palette, label: 'Gris' },
    { value: 'system', Icon: Monitor, label: 'Sistema' },

] as const;
</script>

<template>
    <div
        class="inline-flex gap-4 rounded-md bg-neutral-200 pa-2 my-5 dark:bg-neutral-600 grey:bg-neutral-600"
    >
        <button
            v-for="{ value, Icon, label } in tabs"
            :key="value"
            @click="updateAppearance(value)"
            :class="[
                'flex items-center rounded-md transition-colors',
                appearance === value

            ]"
        >
            <component :is="Icon" class="-ml-1 h-4 w-4" />
            <span class="ml-1.5 text-md">{{ label }}</span>
        </button>
    </div>
</template>
