<template>
  <div class="container-full">
    <img
      src="@images/loading.gif"
      width="15%">
  </div>
</template>

<script>
  export default {
    props: {
      redirectPath: {
        type: String,
        default: '/'
      }
    },
    mounted() {
      document.domain = window.App.appDomain
      window.SOCIAL_LOGIN_STATUS = true
      window.SOCIAL_LOGIN_REDIRECT_PATH = this.redirectPath

      this.delay(5000).then(() => {
        if (window.opener && window.opener !== window) {
          window.FINISH = true
        } else {
          window.location.href = this.redirectPath
        }
      })
    },
    methods: {
      delay(t, v) {
        return new Promise((resolve) => {
          setTimeout(resolve.bind(null, v), t)
        });
      }
    }
  }
</script>
