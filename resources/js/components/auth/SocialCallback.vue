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
    async mounted() {
      window.SOCIAL_LOGIN_STATUS = true
      window.SOCIAL_LOGIN_REDIRECT_PATH = this.redirectPath

      await this.delay(5000)

      if (window.opener && window.opener !== window) {
        window.close()
      } else {
        window.location.href = this.redirectPath
      }
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
