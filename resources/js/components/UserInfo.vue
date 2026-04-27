<script setup>
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';

const props = defineProps(['user']);

function getInitials(fullName) {
    if (!fullName) return '';

    const names = fullName.trim().split(' ');

    if (names.length === 0) return '';
    if (names.length === 1) return names[0].charAt(0).toUpperCase();

    return `${names[0].charAt(0)}${names[names.length - 1].charAt(0)}`.toUpperCase();
}

</script>

<template>
    <Avatar class="h-8 w-8 overflow-hidden rounded-lg">
        <AvatarImage v-if="props.user.avatar" :src="props.user.avatar" :alt="props.user.name" />
        <AvatarFallback class="rounded-lg text-black dark:text-white">
            {{ getInitials(props.user.name) }}
        </AvatarFallback>
    </Avatar>

    <div class="grid flex-1 text-left text-sm leading-tight">
        <span class="truncate font-medium">{{ user.name }}</span>
        <!-- <span v-if="showEmail" class="truncate text-xs text-muted-foreground">{{
            user.email
            }}</span> -->
    </div>
</template>
