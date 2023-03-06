<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <div class="text-right q-ma-lg">
        <q-btn
          color="grey-4"
          text-color="black"
          label="Log Out"
          @click="logout"
        />
      </div>
      <div class="text-center">
        <h1 class="text-center">Welcome to <span class="rasta">Rasta Routes</span></h1>
      </div>
    </q-header>
    <q-page-container class="q-ma-lg">
      <router-view />
    </q-page-container>

  </q-layout>
</template>

<script>
import { defineComponent, ref } from 'vue'

export default defineComponent({
  name: 'ConnectedLayout',
  methods: {
    logout() {
      this.$router.push({ name: 'AccueilDisconnected' })
      localStorage.setItem('connected', false)
    }
  }
})
</script>

<style>
body {
  background-color: #bbbbbb;
  color: white;
  font-family: Arial, sans-serif;
}
h1 {
  font-size: 4rem;
  text-shadow: 5px 5px #000000;
}
.rasta {
  background: linear-gradient(to right, #FF0000, #FFFF00, #008000);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  font-weight: bold;
}
</style>
