<template>
    <div class="interested">

        <div class="interested__option--primary">
            <i class="interested__option-icon fas fa-thumbs-up fa-fw"></i>
            <template v-if="interested">
                <div class="interested__option-question">You are interested</div>
                <div class="interested__option-choices">
                    <button type="button" class="button--failure button--large">
                        <i class="button__icon fas fa-times fa-fw"></i>
                        I'm no longer interested
                    </button>
                </div>
            </template>
            <template v-else>
                <div class="interested__option-question">Are you interested?</div>
                <div class="interested__option-choices">
                    <button type="button" class="button--success button--large" @click.prevent="registerInterest">
                        <i class="button__icon fas fa-check fa-fw"></i>
                        Yes I'm interested
                    </button>
                </div>
            </template>
        </div>

        <div class="interested__option">
            <i class="interested__option-icon fas fa-cash-register fa-fw"></i>
            <template v-if="wouldPay">
                <div class="interested__option-question">You would pay</div>
                <div class="interested__option-choices">
                    <button type="button" class="button--failure button--large">
                        <i class="button__icon fas fa-times fa-fw"></i>
                        I would no longer pay
                    </button>
                </div>
            </template>
            <template v-else>
                <div class="interested__option-question">Would you pay?</div>
                <div class="interested__option-choices">
                    <button type="button" class="button--success button--large" @click.prevent="registerWouldPay">
                        <i class="button__icon fas fa-check fa-fw"></i>
                        Yes
                    </button>
                </div>
            </template>
        </div>

        <div class="interested__option">
            <i class="interested__option-icon fas fa-newspaper fa-fw"></i>
            <template v-if="wouldNewsletter">
                <div class="interested__option-question">You would like updates</div>
                <div class="interested__option-choices">
                    <button type="button" class="button--failure button--large">
                        <i class="button__icon fas fa-times fa-fw"></i>
                        I wouldn't like updates
                    </button>
                </div>
            </template>
            <template v-else>
                <div class="interested__option-question">Would you like updates?</div>
                <div class="interested__option-choices">
                    <button type="button" class="button--success button--large"
                            @click.prevent="registerWouldNewsletter">
                        <i class="button__icon fas fa-check fa-fw"></i>
                        Yes
                    </button>
                </div>
            </template>
        </div>

    </div>
</template>

<script>
  export default {
    name: 'IdeaInterest',

    props: {
      loggedIn:        {
        default: false,
        type:    Boolean,
      },
      currentInterest: {},
      idea:            {
        required: true,
      },
    },

    data () {
      return {
        interested:      false,
        wouldPay:        false,
        wouldNewsletter: false,
      }
    },

    created () {
      if (this.currentInterest) {
        this.interested = this.currentInterest.interested
        this.wouldPay = this.currentInterest.wouldPay
        this.wouldNewsletter = this.currentInterest.wouldNewsletter
      }
    },

    methods: {
      registerInterest () {
        if (!this.interested) {
          window.axios
                .post('/idea/' + this.idea + '/interest/add', {})
                .then((response) => {
                  if (response.status === 200) {
                    this.interested = true
                  }
                })
        }
      },

      registerWouldPay () {
        if (this.interested && !this.wouldPay) {
          window.axios
                .post('/idea/' + this.idea + '/interest/add', {
                  would_pay: true,
                })
                .then((response) => {
                  if (response.status === 200) {
                    this.wouldPay = true
                  }
                })
        }
      },

      registerWouldNewsletter () {
        if (this.interested && !this.wouldNewsletter) {
          window.axios
                .post('/idea/' + this.idea + '/interest/add', {
                  would_newsletter: true,
                })
                .then((response) => {
                  if (response.status === 200) {
                    this.wouldNewsletter = true
                  }
                })
        }
      },
    },
  }
</script>

<style scoped>

</style>