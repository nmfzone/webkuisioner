<template>
  <div class="social-login container">
    <div class="row">
      <div
        ref="grid"
        :style="gridStyle"
        class="grid">
        <form-button
          :disabled="isBtnDisabled('Facebook')"
          :loading="isBtnDisabled('Facebook')"
          :adjust-width="false"
          class="btn-social-login facebook"
          @click.native="openSocialWindow('/auth/social/facebook', 'Facebook', 900, 600)">
          <i
            class="fa fa-facebook-official social-icon"
            aria-hidden="true" /> Facebook
        </form-button>
      </div>
      <div
        :style="gridStyle"
        class="grid">
        <form-button
          :disabled="isBtnDisabled('Google')"
          :loading="isBtnDisabled('Google')"
          :adjust-width="false"
          class="btn-social-login google"
          @click.native="openSocialWindow('/auth/social/google', 'Google', 900, 600)">
          <i
            class="fa fa-google social-icon"
            aria-hidden="true" /> Google
        </form-button>
      </div>
      <div
        :style="gridStyle"
        class="grid">
        <form-button
          :disabled="isBtnDisabled('Twitter')"
          :loading="isBtnDisabled('Twitter')"
          :adjust-width="false"
          class="btn-social-login twitter"
          @click.native="openSocialWindow('/auth/social/twitter', 'Twitter', 900, 600)">
          <i
            class="fa fa-twitter social-icon"
            aria-hidden="true" /> Twitter
        </form-button>
      </div>
    </div>
    <div
      v-if="isError"
      class="row error-message">
      Gagal melakukan autentikasi menggunakan {{ errorProvider }}.
    </div>
  </div>
</template>

<script>
import _ from 'lodash'
// import { route } from '~/common/utils'

const route = (x) => {
  return x
}

export default {
  props: {
    usePopup: {
      type: Boolean,
      default: true
    }
  },
  data () {
    return {
      processing: null,
      isError: false,
      errorProvider: null,
      gridStyle: {
        flex: '0 0 100%',
        paddingLeft: '5px',
        paddingRight: '5px'
      }
    }
  },
  mounted () {
    this.syncGridStyle()
    window.addEventListener('resize', this.syncGridStyle)
  },
  methods: {
    isBtnDisabled (provider) {
      return _.toLower(provider) === _.toLower(this.processing)
    },
    openSocialWindow (url, provider, width = null, height = null) {
      this.isError = false
      this.processing = this.errorProvider = provider

      if (this.usePopup) {
        let options = ''

        const dualScreenLeft = window.screenLeft !== undefined ? window.screenLeft : window.screenX,
          dualScreenTop = window.screenTop !== undefined ? window.screenTop : window.screenY,
          w = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width,
          h = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height,
          systemZoom = w / window.screen.availWidth

        if (height > 0) {
          options += `, height=${height/systemZoom}, top=${(h - height) / 2 / systemZoom + dualScreenTop}`
        }

        if (width > 0) {
          options += `, width=${width/systemZoom}, left=${(w - width) / 2 / systemZoom + dualScreenLeft}`
        }

        document.domain = window.App.appDomain
        const popup = window.open(route(url), `Log in With ${provider}`, `toolbar=no, location=no, directories=no, status=no, menubar=no, resizable=no, copyhistory=no${options}`)

        if (popup) popup.focus()

        const pooling = setInterval(() => {
          try {
            if (!popup || popup.closed || popup.closed === undefined || popup.FINISH) {
              clearInterval(pooling)

              if (popup && popup.SOCIAL_LOGIN_STATUS) {
                const prevHref = window.location.href
                const redirectPath = popup.SOCIAL_LOGIN_REDIRECT_PATH

                if (popup.closed === false) {
                  popup.close()
                }

                window.location.href = redirectPath

                if (prevHref === window.location.href) {
                  window.location.reload()
                }
              } else {
                this.isError = true
                this.processing = null
              }
            }
          } catch (e) {}
        }, 250)
      } else {
        window.location.href = route(url)
      }
    },
    syncGridStyle () {
      const elWidth = _.get(this.$refs.grid, 'parentNode.clientWidth', 388)

      this.gridStyle.flex = elWidth >= 388 ? '0 0 33.3%' : '0 0 100%'
      this.gridStyle.paddingLeft = this.gridStyle.paddingRight = elWidth >= 388 ? '5px' : '0px'
    }
  }
}
</script>

<style lang="scss" scoped>
  .social-login {
    margin-top: 30px;

    .error-message {
      color: #ff0000;
      margin-top: 20px;
      font-size: 12px;
    }

    .grid {
      button {
        width: 100%;
      }
    }

    .row {
      display: flex;
    }

    .btn-social-login {
      font-family: Roboto, Verdana, sans-serif;
      font-size: 16px;
      line-height: 1.2;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 40px;
      border-radius: 5px;
      border: 1px solid #e6e6e6;
      background-color: #fff;
      transition: all 0.4s;
      width: 100%;
      opacity: 1;

      .social-icon {
        padding-right: 10px;
      }

      &.facebook {
        background: #3d5c98;
        color: #fff;
      }

      &.google {
        background: #bf3f3e;
        color: #fff;
      }

      &.twitter {
        background: #4fa5eb;
        color: #fff;
      }

      &:hover {
        cursor: pointer;
        opacity: 0.8;
      }

      &:disabled {
        opacity: 0.8;
      }
    }
  }
</style>
