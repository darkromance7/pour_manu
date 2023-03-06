<template>
  <div class="row">
    <div class="q-ml-auto">
      <div class="row">
        <q-btn
          label="Disconnect"
          color="green-4"
          @click="this.disconnect"
          />
      </div>
    </div>
  </div>
  <div class="text-center">
    <h1 class="text-center">Welcome to <span class="rasta">Rasta Routes</span></h1>
  </div>
</template>

<script>

import {defineComponent} from "vue";

export default defineComponent({
  name: 'ConnectedHeader',
  methods: {
    disconnect() {
      this.$q.localStorage.set('connected', false)
      location.reload()
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
