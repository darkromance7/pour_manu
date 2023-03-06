<template>
  <q-page class="q-ma-lg">
    <q-input v-model="dataInscription.username" label="Username" />
    <q-input v-model="dataInscription.password" label="Password" />
    <q-btn color="primary" label="Inscription" @click="inscription" />
  </q-page>
</template>

<script>

import { defineComponent } from "vue";
import { api } from 'boot/axios';

export default defineComponent({
  name: 'InscriptionPage',
  data() {
    return {
      dataInscription: {
        username: "",
        password: ""
      }
    }
  },
  methods: {
    inscription() {
      api.post('/user/create', {
        username: this.dataInscription.username,
        password: this.dataInscription.password
      })
      .then(response => {
        console.log(response);
      })
      .catch(error => {
        console.log(error);
      });
    }
  }
})

</script>
