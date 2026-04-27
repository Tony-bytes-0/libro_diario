<script setup>
import {
    SidebarGroup,
    SidebarGroupLabel,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
    SidebarMenuSub,
    SidebarMenuSubButton,
    SidebarMenuSubItem,
} from '@/components/ui/sidebar';
import { urlIsActive } from '@/lib/utils';
import { Link, usePage } from '@inertiajs/vue3';
import { ChevronDown } from 'lucide-vue-next';
import { ref } from 'vue';

const props = defineProps({
    items: {
        type: Array,
        required: true,
    },
});

const page = usePage();

// Track which collapsible groups are open
const openGroups = ref({});

function toggleGroup(title) {
    openGroups.value[title] = !openGroups.value[title];
}

function isGroupOpen(title) {
    return !!openGroups.value[title];
}

function hasSubItems(item) {
    return Array.isArray(item.items) && item.items.length > 0;
}
</script>

<template>
    <SidebarGroup class="px-2 py-0">
        <SidebarGroupLabel>Navegación</SidebarGroupLabel>
        <SidebarMenu>
            <template v-for="item in items" :key="item.title">

                <!-- Simple link item (no sub-items) -->
                <SidebarMenuItem v-if="!hasSubItems(item)">
                    <SidebarMenuButton
                        as-child
                        :is-active="urlIsActive(item.href, page.url)"
                        :tooltip="item.title"
                    >
                        <Link :href="item.href">
                            <component :is="item.icon" />
                            <span>{{ item.title }}</span>
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>

                <!-- Collapsible group (has sub-items) -->
                <SidebarMenuItem v-else>
                    <SidebarMenuButton
                        :tooltip="item.title"
                        @click="toggleGroup(item.title)"
                        :is-active="item.items.some(sub => urlIsActive(sub.href, page.url))"
                    >
                        <component :is="item.icon" />
                        <span>{{ item.title }}</span>
                        <ChevronDown
                            class="ml-auto transition-transform duration-200"
                            :class="{ 'rotate-180': isGroupOpen(item.title) }"
                        />
                    </SidebarMenuButton>

                    <SidebarMenuSub v-show="isGroupOpen(item.title)">
                        <SidebarMenuSubItem v-for="sub in item.items" :key="sub.title">
                            <SidebarMenuSubButton
                                as-child
                                :is-active="urlIsActive(sub.href, page.url)"
                            >
                                <Link :href="sub.href">
                                    <component v-if="sub.icon" :is="sub.icon" />
                                    <span>{{ sub.title }}</span>
                                </Link>
                            </SidebarMenuSubButton>
                        </SidebarMenuSubItem>
                    </SidebarMenuSub>
                </SidebarMenuItem>

            </template>
        </SidebarMenu>
    </SidebarGroup>
</template>
