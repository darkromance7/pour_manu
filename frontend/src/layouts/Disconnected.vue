<template>
  <q-layout view="lHh Lpr lFf">
    <q-header>

      <q-dialog
        v-model="dataDisconnected.loginModal"
        >
        <q-card>
          <q-card-section>
            <div class="text-black text-center text-h4">Log In</div>
          </q-card-section>
          <q-card-actions>
            <div class="col">
            <q-input
              v-model="dataLogin.username"
              label="Username"
              filled
            />
            <q-input
              v-model="dataLogin.password"
              label="Password"
              :type="dataLogin.seePassword ? 'text' : 'password'"
              class="q-mt-md q-mb-md"
              filled>
              <template v-slot:append>
                <q-icon
                  :name="dataLogin.seePassword ? 'visibility_off' : 'visibility'"
                  class="cursor-pointer"
                  @click="dataLogin.seePassword = !dataLogin.seePassword"
                />
              </template>
            </q-input>
            <q-btn
              color="grey-4"
              text-color="black"
              label="Log In"
              @click="login"
            />
            </div>
          </q-card-actions>
        </q-card>
      </q-dialog>

      <q-dialog
        v-model="dataDisconnected.signupModal"
      >
        <q-card>
          <q-card-section>
            <div class="text-black text-center text-h4">Sign Up</div>
          </q-card-section>
          <q-card-actions>
            <div class="col">
              <q-input
                v-model="dataSignup.username"
                label="Username"
                filled
              />
              <q-input
                v-model="dataSignup.password"
                label="Password"
                :type="dataSignup.seePassword ? 'text' : 'password'"
                class="q-mt-md q-mb-md"
                filled>
                <template v-slot:append>
                  <q-icon
                    :name="dataSignup.seePassword ? 'visibility_off' : 'visibility'"
                    class="cursor-pointer"
                    @click="dataSignup.seePassword = !dataSignup.seePassword"
                  />
                </template>
              </q-input>
              <q-input
                v-model="dataSignup.passwordConfirm"
                label="Confirm Password"
                :type="dataSignup.seePasswordConfirm ? 'text' : 'password'"
                class="q-mt-md q-mb-md"
                filled
              >
                <template v-slot:append>
                  <q-icon
                    :name="dataSignup.seePasswordConfirm ? 'visibility_off' : 'visibility'"
                    class="cursor-pointer"
                    @click="dataSignup.seePasswordConfirm = !dataSignup.seePasswordConfirm"
                  />
                </template>
              </q-input>
              <q-btn
                color="grey-4"
                text-color="black"
                label="Sign Up"
                @click="signup"
              />
            </div>
          </q-card-actions>
        </q-card>
      </q-dialog>

      <div class="text-right q-ma-lg">
          <q-btn
          class="q-mr-lg"
          color="grey-4"
          text-color="black"
          label="Log In"
          @click="this.dataDisconnected.loginModal = true"
        />
        <q-btn
          class=""
          color="grey-4"
          text-color="black"
          label="Sign Up"
          @click="this.dataDisconnected.signupModal = true"
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
import { api } from 'boot/axios'
import {Notify} from "quasar";

export default defineComponent({
  name: 'DisconnectedLayout',
  data() {
    return {
      dataDisconnected: {
        loginModal: false,
        signupModal: false
      },
      dataLogin: {
        username: '',
        password: '',
        seePassword: false
      },
      dataSignup: {
        username: '',
        password: '',
        passwordConfirm: '',
        seePassword: false,
        seePasswordConfirm: false
      }
    }
  },
  methods: {
    login() {
      api.post('/session/login', {
        username: this.dataLogin.username,
        password: this.dataLogin.password
      })
        .then(response => {
          this.$router.push({ name: 'AccueilConnected' })
          localStorage.setItem('connected', true)
        })
        .catch((xhr) => {
          this.$store.dispatch('notifyNegative', xhr.response.data)
        })
        .finally(() => {
          this.dataDisconnected.loginModal = false
        })

    },
    signup() {
      api.post('/user/create', {
        username: this.dataSignup.username,
        password: this.dataSignup.password,
        passwordConfirm: this.dataSignup.passwordConfirm
      })
        .then(response => {
          this.$store.dispatch('notifyPositive', 'Votre compte a bien été créé, vous pouvez maintenant vous connecter')
        })
        .catch((xhr) => {
          this.$store.dispatch('notifyNegative', xhr.response.data)
        })
        .finally(() => {
          this.dataDisconnected.signupModal = false
        })
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
