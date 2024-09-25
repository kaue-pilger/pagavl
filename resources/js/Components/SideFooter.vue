<script setup>
  import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
  import Dropdown from '@/Components/Dropdown.vue';
  import DropdownLink from '@/Components/DropdownLink.vue';
</script>

<template>
  <div class="flex flex-row w-full gap-4 mt-4">
    <div class="flex flex-col justify-center">
      <img 
        class="w-10 h-10 rounded-full"
        src="https://avatars.githubusercontent.com/u/95877362?s=400&u=0d0c3cd952473c347f1c7408c3be94a24516a417&v=4" 
        alt="Profile Image"
      >
    </div>
    <div class="flex flex-col gap-1">
      <Dropdown align="bottom" width="48">
        <template #trigger>
          <span class="inline-flex rounded-xl">
            <button type="button"
              class="inline-flex items-center text-sm leading-4 font-medium rounded-xl text-white focus:outline-none transition ease-in-out duration-150"
            >
              {{ $page.props.auth.user.name }}
  
              <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
              </svg>
            </button>
          </span>
        </template>
  
        <template #content>
          <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
          <DropdownLink :href="route('logout')" method="post" as="button"> Log Out </DropdownLink>
        </template>
      </Dropdown>
      <span class="text-xs text-oslo-gray">Stehp</span>
    </div>
  </div>
</template>