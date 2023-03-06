<template>

  <q-dialog v-model="dataDisconnected.signInModal">
    <q-card>
      <q-card-section>
        <div class="text-black text-center">
          <div class="text-h4">Sign In</div>
          <q-input v-model="dataConnexion.username" label="Username" />
          <q-input v-model="dataConnexion.password" label="Password" />
          <q-btn
            class="q-ma-md"
            label="Sign in"
            @click="this.login"
          />
        </div>
      </q-card-section>
    </q-card>
  </q-dialog>

  <q-dialog v-model="dataDisconnected.signUpModal">
    <q-card>
      <q-card-section>
        <div class="text-black text-center">
          <div class="text-h4">Sign Up</div>
          <q-input v-model="dataInscription.username" label="Username" />
          <q-input v-model="dataInscription.password" label="Password" />
          <q-input v-model="dataInscription.passwordConfirm" label="Confirm password" />
          <div class="text-red" v-if="dataInscription.passwordConfirm !== dataInscription.password">
            <q-icon name="warning" color="red" />
            Password aren't the same
          </div>
          <q-btn
            class="q-ma-md"
            :disabled="dataInscription.passwordConfirm !== dataInscription.password || dataInscription.password === '' || dataInscription.username === ''"
            label="Sign up"
            @click="this.inscription"
          />
        </div>
      </q-card-section>
    </q-card>
  </q-dialog>

  <div class="row">
    <div class="q-ml-auto">
      <q-btn
        label="Sign in"
        class="q-mr-lg q-ml-auto"
        color="blue"
        @click="this.dataDisconnected.signInModal = true"
      />
      <q-btn
        label="Sign up"
        color="green-4"
        @click="this.dataDisconnected.signUpModal = true"
      />
    </div>
  </div>
  <h1 class="text-center">Welcome to <span class="rasta">Rasta Routes</span></h1>
</template>

<script>

import {defineComponent} from "vue"
import { api } from 'boot/axios'

export default defineComponent({
  name: 'DisconnectedHeader',
  components: {},
  data() {
    return {
      dataDisconnected: {
        signInModal: false,
        signUpModal: false
      },
      dataConnexion: {
        username: '',
        password: ''
      },
      dataInscription: {
        username: "",
        password: "",
        passwordConfirm: ""
      }
    }
  },
  methods: {
    login() {
      api.post('/api/session/login', {
        username: this.dataConnexion.username,
        password: this.dataConnexion.password
      })
        .then(response => {
          if (response.data === 200) {
            this.$q.localStorage.set('connected', true)
          }
        })
        .catch(error => {
          console.log(error);
        })
        .finally(() => {
          // Refresh the page
          window.location.reload()
        });
    },
    inscription() {
      api.post('/api/user/create', {
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

<style>
body {
  background-color: #bbbbbb;
  color: white;
  font-family: Arial, sans-serif;
}
.rasta {
  background: linear-gradient(to right, #FF0000, #FFFF00, #008000);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  font-weight: bold;
}
</style>
