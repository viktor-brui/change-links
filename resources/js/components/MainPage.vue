<template>
  <div class="container">
    <div class="main__text">
      Insert your link for further conversion
    </div>
    <div class="main__input-block">
      <div class="input__container">
        <input
          v-model="linkInput"
          :class="{ input: true, 'error-text': errors }"
          placeholder="Enter the link"
        />
      </div>
    </div>
    <div class="main__button-block">
      <button type="button" class="btn" @click="convertLink">
        Get short link
      </button>
    </div>
    <div v-if="shortLink" class="main__result-block">
      <div class="input__container">
        <div class="output">{{ shortLink }}</div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      linkInput: null,
      shortLink: null,
      errors: null,
    }
  },
  methods: {
    convertLink() {
      if (!this.linkInput) {
        this.errors = 'error';

        return;
      }

      this.errors = null;

      axios.post('api/link', { link: this.linkInput })
        .then(res => {
          this.shortLink = window.location.href + res.data.hash;
        });
    },
  },
}
</script>
<style scoped lang="sass">
  .container
    display: flex
    flex-direction: column
    align-items: center
    justify-content: center
    margin-top: 20vh
    .main__text
      font-size: 20px
      font-weight: 500
    .main__input-block
      width: 100%
      margin-top: 24px
      .input__container
        display: flex
        justify-content: center
        .input
          width: 50%
          padding: 8px 24px
          border-radius: 8px
          border: 1px solid #0b5ed7
        .error-text
          border-color: darkred
    .main__button-block
      margin: 16px 0
      .btn
        padding: 10px 35px
        background-color: #0d6efd
        border-radius: 12px
        border: none
        color: white
        &:hover
          cursor: pointer
          background-color: #3e5cce
    .main__result-block
      width: 100%
      .input__container
        display: flex
        justify-content: center
        .output
          width: 50%
          padding: 8px 24px
          border-radius: 8px
          border: 1px solid #0b5ed7
</style>
