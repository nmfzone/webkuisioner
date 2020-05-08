import './bootstrap'
import './container-screen'
import Vue from 'vue'

window.Vue = Vue

import Alert from './components/Alert'
import FormInput from './components/form/FormInput'
import FormButton from './components/form/FormButton'
import SocialLogin from './components/auth/SocialLogin'
import SocialCallback from './components/auth/SocialCallback'

Vue.component('alert', Alert)
Vue.component('form-input', FormInput)
Vue.component('form-button', FormButton)
Vue.component('social-login', SocialLogin)
Vue.component('social-callback', SocialCallback)


const app = new Vue({
    el: '#app',
})
