<template>
  <q-page>
    <q-input v-model="dataAccueil.search" label="Recherche" class="q-mt-lg" color="primary" style="max-width: 300px; ">
      <template v-slot:prepend>
        <q-icon name="search" />
      </template>
    </q-input>
  </q-page>
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'AccueilPage',
  data() {
    return {
      dataAccueil: {
        search: ""
      }
    }
  }
})
</script>

