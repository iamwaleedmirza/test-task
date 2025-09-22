<template>
  <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-100 to-blue-100">
    <div class="bg-white rounded-xl shadow-lg p-8 w-full max-w-lg">
      <h2 class="text-2xl font-bold mb-6 text-blue-700 text-center">{{ poll.question }}</h2>
      <form @submit.prevent="submitVote" class="flex flex-col gap-4">
        <div v-for="(option, idx) in options" :key="idx" class="flex items-center gap-2">
          <input type="radio" :id="`option${idx}`" :value="idx" v-model="selected" class="accent-blue-500" />
          <label :for="`option${idx}`" class="text-lg">{{ option }}</label>
        </div>
        <span v-if="errors && errors.option" class="text-red-500 text-sm">{{ errors.option }}</span>
        <button type="submit" class="bg-gradient-to-r from-blue-500 to-green-500 text-white px-6 py-2 rounded-lg font-semibold shadow hover:scale-105 transition">Vote</button>
      </form>
      <div v-if="error" class="mt-4 text-red-600 text-center">{{ error }}</div>
      <div v-if="success" class="mt-4 text-green-600 text-center">{{ success }}</div>
    </div>
  </div>
</template>

<script>
import { router } from '@inertiajs/vue3';
export default {
  props: {
    poll: Object,
    errors: Object,
    error: String,
    success: String
  },
  data() {
    return {
      selected: null,
      options: this.poll ? JSON.parse(this.poll.options) : []
    }
  },
  methods: {
    submitVote() {
      if (this.selected === null) return;
      router.post(`/poll/vote/${this.poll.token}`, { option: this.options[this.selected] });
    }
  }
}
</script>

<style scoped>
</style>
