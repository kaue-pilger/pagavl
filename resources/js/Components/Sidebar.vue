<script setup>
  import SideNavLink from '@/Components/SideNavLink.vue';
  import SideFooter from '@/Components/SideFooter.vue';
  import ApplicationLogo from '@/Components/ApplicationLogo.vue';
  import { Link } from '@inertiajs/vue3';

  defineProps({
      links: {
        type: Object,
        required: true
      },
  });

</script>

<template>
  <aside class="flex flex-col h-full p-8 bg-daintree">
    <div class="shrink-0 flex items-center">
      <Link :href="route('dashboard')">
        <ApplicationLogo class="block h-9 w-auto" />
      </Link>
    </div>
    <ul class="flex flex-col flex-grow mt-8 gap-4">
      <li class="flex items-center hover:bg-te-papa-green hover:text-white h-10 w-full rounded-xl" v-for="link in links" :key="link.id">
        <SideNavLink :href="route(link.url)" :active=false>
          {{ link.name }}
        </SideNavLink>
      </li>
    </ul>
    <SideFooter />
  </aside>
</template>
