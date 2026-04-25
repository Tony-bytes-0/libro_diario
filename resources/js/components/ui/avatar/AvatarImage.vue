<script setup>
import { AvatarImage } from 'reka-ui'

const props = defineProps({
    src: { type: null, required: false },
    alt: { type: null, required: false },
    class: { type: null, required: false },
})
</script>

<template>
  <AvatarImage
    data-slot="avatar-image"
    v-bind="props"
    class="aspect-square size-full"
  > 
    <slot />
  </AvatarImage>
</template>
