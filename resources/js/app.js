import './bootstrap'
import Vue from 'vue'

window.Vue = Vue

import FormButton from './components/form/FormButton'
import SocialLogin from './components/auth/SocialLogin'
import SocialCallback from './components/auth/SocialCallback'

Vue.component('form-button', FormButton)
Vue.component('social-login', SocialLogin)
Vue.component('social-callback', SocialCallback)


const app = new Vue({
    el: '#app',
})
