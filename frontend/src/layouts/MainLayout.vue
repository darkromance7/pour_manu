<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <div class="q-mt-md q-mr-md">
      <div v-if="this.$q.localStorage.getItem('connected')">
        <Connected />
      </div>
      <div v-else>
        <Disconnected />
      </div>
      </div>
    </q-header>


    <q-page-container class="q-ma-lg">
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import { defineComponent, ref } from 'vue'
import Connected from 'src/layouts/headers/Connected.vue'
import Disconnected from "layouts/headers/Disconnected";

export default defineComponent({
  name: 'MainLayout',
  components: {
    Disconnected,
    Connected
  }
})
</script>
